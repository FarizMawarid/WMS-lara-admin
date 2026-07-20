<?php

namespace App\Http\Controllers;

use App\Models\FinishGoodsTransaction;
use App\Models\ProductType;
use App\Models\Rack;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinishGoodsTransactionController extends Controller
{
    public function indexIn()
    {
        $productTypes = ProductType::orderBy('po')->get();
        $racks = Rack::orderBy('rack_code')->get();

        return view('pages.user.transaction.finishgoods.transactionIn', compact('productTypes', 'racks'));
    }

    public function storeIn(Request $request)
    {
        $validated = $request->validate([
            'po' => 'required|string',
            'style' => 'required|string',
            'destination' => 'required|string',
            'qty_carton' => 'required|integer|min:1',
            'qty_garment' => 'required|integer|min:1',
            'rack_code' => 'required|string',
        ]);

        FinishGoodsTransaction::create(array_merge($validated, ['action_type' => 'in']));

        return redirect()->back()->with('success', 'Transaction In berhasil disimpan.');
    }

    public function indexOut()
    {
        $productTypes = ProductType::orderBy('po')->get();
        $racks = Rack::orderBy('rack_code')->get();

        // Hitung sisa stok per PO + Rack (IN - OUT)
        $rackStock = FinishGoodsTransaction::select('po', 'rack_code')
            ->selectRaw('SUM(CASE WHEN action_type = "in" THEN qty_carton ELSE -qty_carton END) as remaining_carton')
            ->selectRaw('SUM(CASE WHEN action_type = "in" THEN qty_garment ELSE -qty_garment END) as remaining_garment')
            ->groupBy('po', 'rack_code')
            ->havingRaw('SUM(CASE WHEN action_type = "in" THEN qty_carton ELSE -qty_carton END) > 0')
            ->get()
            ->groupBy('po');

        return view('pages.user.transaction.finishgoods.transactionOut', compact(
            'productTypes',
            'racks',
            'rackStock'
        ));
    }

    public function storeOut(Request $request)
    {
        $validated = $request->validate([
            'po' => 'required|string',
            'style' => 'required|string',
            'destination' => 'required|string',
            'qty_carton' => 'required|integer|min:1',
            'qty_garment' => 'required|integer|min:1',
            'rack_code' => 'required|string',
        ]);

        // Hitung sisa stok untuk PO + Rack yang dipilih (IN - OUT)
        $remaining = FinishGoodsTransaction::where('po', $validated['po'])
            ->where('rack_code', $validated['rack_code'])
            ->selectRaw('
                SUM(CASE WHEN action_type = "in" THEN qty_carton ELSE -qty_carton END) as remaining_carton,
                SUM(CASE WHEN action_type = "in" THEN qty_garment ELSE -qty_garment END) as remaining_garment
            ')
            ->first();

        $remainingCarton = (int) ($remaining->remaining_carton ?? 0);
        $remainingGarment = (int) ($remaining->remaining_garment ?? 0);

        if ($validated['qty_carton'] > $remainingCarton || $validated['qty_garment'] > $remainingGarment) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Jumlah melebihi stok tersedia di rack {$validated['rack_code']}. Sisa stok: {$remainingCarton} carton / {$remainingGarment} garment.");
        }

        FinishGoodsTransaction::create(array_merge($validated, ['action_type' => 'out']));

        return redirect()->back()->with('success', 'Transaction Out berhasil disimpan.');
    }

    public function reportIn(Request $request)
    {
        $query = FinishGoodsTransaction::where('action_type', 'in');

        if ($request->filled('po')) {
            $query->where('po', $request->po);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();
        $productTypes = ProductType::orderBy('po')->get();

        return view('pages.user.report.finishgoods.finishGoodsReportIn', compact(
            'transactions',
            'productTypes'
        ));
    }

    public function reportOut(Request $request)
    {
        $query = FinishGoodsTransaction::where('action_type', 'out');

        if ($request->filled('po')) {
            $query->where('po', $request->po);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();
        $productTypes = ProductType::orderBy('po')->get();

        return view('pages.user.report.finishgoods.finishGoodsReportOut', compact(
            'transactions',
            'productTypes'
        ));
    }

    public function reportSummary(Request $request)
    {
        $summary = FinishGoodsTransaction::select([
            'po',
            'style',
            'destination',
            'rack_code',
            DB::raw('SUM(CASE WHEN action_type = "in" THEN qty_garment ELSE 0 END) as total_garment_in'),
            DB::raw('SUM(CASE WHEN action_type = "out" THEN qty_garment ELSE 0 END) as total_garment_out'),
            DB::raw('SUM(CASE WHEN action_type = "in" THEN qty_carton ELSE 0 END) as total_carton_in'),
            DB::raw('SUM(CASE WHEN action_type = "out" THEN qty_carton ELSE 0 END) as total_carton_out'),
        ])
        ->groupBy('po', 'style', 'destination', 'rack_code');

        if ($request->filled('po')) {
            $summary->where('po', $request->po);
        }

        if ($request->filled('start_date')) {
            $summary->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $summary->whereDate('created_at', '<=', $request->end_date);
        }

        $summaries = $summary->orderBy('po')->get();
        $productTypes = ProductType::orderBy('po')->get();

        return view('pages.user.report.finishgoods.finishGoodsReportSummary', compact(
            'summaries',
            'productTypes'
        ));
    }

    public function adminIndex()
    {
        $transactions = FinishGoodsTransaction::orderBy('created_at', 'desc')->get();
        $productTypes = ProductType::orderBy('po')->get();
        $racks = Rack::orderBy('rack_code')->get();
        $editTransaction = null;

        return view('pages.admin.transactionInOutLog', compact('transactions', 'productTypes', 'racks', 'editTransaction'));
    }

    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'po' => 'required|string',
            'style' => 'required|string',
            'destination' => 'required|string',
            'qty_carton' => 'required|integer|min:1',
            'qty_garment' => 'required|integer|min:1',
            'rack_code' => 'required|string',
            'action_type' => 'required|in:in,out',
        ]);

        FinishGoodsTransaction::create($validated);

        return redirect()->route('admin.transaction-log.index')->with('success', 'Transaction berhasil disimpan.');
    }

    public function adminEdit($id)
    {
        $transactions = FinishGoodsTransaction::orderBy('created_at', 'desc')->get();
        $productTypes = ProductType::orderBy('po')->get();
        $racks = Rack::orderBy('rack_code')->get();
        $editTransaction = FinishGoodsTransaction::findOrFail($id);

        return view('pages.admin.transactionInOutLog', compact('transactions', 'productTypes', 'racks', 'editTransaction'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $transaction = FinishGoodsTransaction::findOrFail($id);
        $validated = $request->validate([
            'po' => 'required|string',
            'style' => 'required|string',
            'destination' => 'required|string',
            'qty_carton' => 'required|integer|min:1',
            'qty_garment' => 'required|integer|min:1',
            'rack_code' => 'required|string',
            'action_type' => 'required|in:in,out',
        ]);

        $transaction->update($validated);

        return redirect()->route('admin.transaction-log.index')->with('success', 'Transaction berhasil diperbarui.');
    }

    public function adminDestroy($id)
    {
        $transaction = FinishGoodsTransaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('admin.transaction-log.index')->with('success', 'Transaction berhasil dihapus.');
    }

    public function dashboard(Request $request)
    {
        $selectedDate = $request->filled('date') ? $request->date : now()->toDateString();
        $user = Auth::user();
        $factoryOptions = ['Finish Goods 1', 'Finish Goods 2'];
        $userDepartment = $user?->department;

        $selectedFactory = $request->filled('factory') && in_array($request->factory, $factoryOptions, true)
            ? $request->factory
            : ($userDepartment ?? $factoryOptions[0]);

        $factoryName = $selectedFactory;
        $factoryRacks = Rack::where('department', $factoryName)->orderBy('rack_code')->get();
        $baseQuery = FinishGoodsTransaction::query();
        $rackCodes = $factoryRacks->pluck('rack_code')->all();

        if (!empty($rackCodes)) {
            $baseQuery->whereIn('rack_code', $rackCodes);
        } else {
            $baseQuery->whereRaw('1 = 0');
        }

        // Statistik pergerakan HARI INI (tetap berbasis tanggal yang dipilih)
        $dateQuery = (clone $baseQuery)->whereDate('created_at', $selectedDate);

        $totalKarton = (clone $dateQuery)->sum('qty_carton');
        $incomingToday = (clone $dateQuery)->where('action_type', 'in')->sum('qty_carton');
        $incomingCount = (clone $dateQuery)->where('action_type', 'in')->count();
        $outgoingToday = (clone $dateQuery)->where('action_type', 'out')->sum('qty_carton');
        $outgoingCount = (clone $dateQuery)->where('action_type', 'out')->count();

        $yesterday = Carbon::parse($selectedDate)->subDay()->toDateString();
        $incomingYesterday = (clone $baseQuery)->whereDate('created_at', $yesterday)
            ->where('action_type', 'in')
            ->sum('qty_carton');

        $percentageChange = $incomingYesterday > 0
            ? round((($incomingToday - $incomingYesterday) / $incomingYesterday) * 100, 1)
            : 0;

        // ==========================================================
        // LAYOUT RACK — harus berdasarkan stok KUMULATIF (IN - OUT)
        // sampai tanggal yang dipilih, bukan hanya transaksi hari itu.
        // Supaya rack yang terisi dari transaksi kemarin/lalu tetap
        // terbaca "Filled" walau hari ini tidak ada pergerakan.
        // ==========================================================
        $rackStatus = [];
        $filledRacks = 0;

        foreach ($factoryRacks as $rack) {

            $cumulativeQuery = (clone $baseQuery)
                ->where('rack_code', $rack->rack_code)
                ->whereDate('created_at', '<=', $selectedDate);

            $totalIn = (clone $cumulativeQuery)->where('action_type', 'in')->sum('qty_carton');
            $totalOut = (clone $cumulativeQuery)->where('action_type', 'out')->sum('qty_carton');
            $cartons = max(0, (int) $totalIn - (int) $totalOut);

            // Transaksi terakhir (apapun jenisnya) sampai tanggal yang dipilih,
            // dipakai untuk menampilkan PO yang lagi menempati rack ini.
            $latestTransaction = (clone $cumulativeQuery)
                ->orderByDesc('created_at')
                ->first();

            if ($cartons > 0) {
                $filledRacks++;
            }

            $rackStatus[] = [
                'rack_code' => $rack->rack_code,
                'cartons' => $cartons,
                'capacity' => 10,
                'filled' => $cartons > 0 ? 100 : 0,
                'status' => $cartons > 0 ? 'filled' : 'available',
                'po' => $cartons > 0 ? ($latestTransaction?->po ?? '-') : '-',
                'action_type' => $latestTransaction?->action_type ?? null,
            ];
        }

        $totalRacks = count($rackStatus);
        $emptyRacks = $totalRacks - $filledRacks;
        $utilization = $totalRacks > 0 ? ($filledRacks / $totalRacks) * 100 : 0;

        $latestIn = (clone $dateQuery)->where('action_type', 'in')->latest('created_at')->first();
        $latestOut = (clone $dateQuery)->where('action_type', 'out')->latest('created_at')->first();

        $liveActivity = collect([
            [
                'rack_code' => $latestIn?->rack_code ?? '-',
                'action_type' => 'in',
                'po' => $latestIn?->po ?? '-',
                'qty_carton' => $latestIn?->qty_carton ?? 0,
                'time' => $latestIn?->created_at ? Carbon::parse($latestIn->created_at)->format('H:i') : '--:--',
                'timestamp' => $latestIn?->created_at?->timestamp ?? 0,
                'empty' => ! $latestIn,
            ],
            [
                'rack_code' => $latestOut?->rack_code ?? '-',
                'action_type' => 'out',
                'po' => $latestOut?->po ?? '-',
                'qty_carton' => $latestOut?->qty_carton ?? 0,
                'time' => $latestOut?->created_at ? Carbon::parse($latestOut->created_at)->format('H:i') : '--:--',
                'timestamp' => $latestOut?->created_at?->timestamp ?? 0,
                'empty' => ! $latestOut,
            ],
        ])->sortBy('timestamp')->values();

        return view('pages.user.dashboard.dashboardFinishGoods', compact(
            'totalKarton',
            'incomingToday',
            'incomingCount',
            'outgoingToday',
            'outgoingCount',
            'percentageChange',
            'rackStatus',
            'totalRacks',
            'filledRacks',
            'emptyRacks',
            'utilization',
            'liveActivity',
            'selectedDate',
            'factoryName',
            'selectedFactory',
            'factoryOptions'
        ));
    }
}

