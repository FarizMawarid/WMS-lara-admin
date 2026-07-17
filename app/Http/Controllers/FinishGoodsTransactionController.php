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

        return view('pages.user.transaction.finishgoods.transactionOut', compact('productTypes', 'racks'));
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

    public function dashboard(Request $request)
    {
        $selectedDate = $request->filled('date') ? $request->date : now()->toDateString();
        $user = Auth::user();
        $factoryName = $user?->factory ?? 'ALL';

        $factoryRacks = Rack::where('factory', $factoryName)->pluck('rack_code')->all();
        $baseQuery = FinishGoodsTransaction::query();

        if (!empty($factoryRacks)) {
            $baseQuery->whereIn('rack_code', $factoryRacks);
        } else {
            $baseQuery->whereRaw('1 = 0');
        }

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

        $rackPositions = [];
        for ($row = 'A'; $row <= 'E'; $row++) {
            for ($number = 1; $number <= 5; $number++) {
                $rackPositions[] = $row . $number;
            }
        }

        $rackStatus = [];
        $filledRacks = 0;

        foreach ($rackPositions as $rackCode) {
            $rackTransactions = (clone $dateQuery)->where('rack_code', $rackCode)->get();
            $latestTransaction = $rackTransactions->sortByDesc('created_at')->first();
            $cartons = (int) $rackTransactions->sum('qty_carton');

            if ($cartons > 0) {
                $filledRacks++;
            }

            $rackStatus[] = [
                'rack_code' => $rackCode,
                'cartons' => $cartons,
                'capacity' => 10,
                'filled' => $cartons > 0 ? 100 : 0,
                'status' => $cartons > 0 ? 'filled' : 'available',
                'po' => $latestTransaction?->po ?? '-',
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
            'factoryName'
        ));
    }
}
