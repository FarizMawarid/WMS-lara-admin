<?php

namespace App\Http\Controllers;

use App\Models\FinishGoodsTransaction;
use App\Models\ProductType;
use App\Models\Rack;
use Illuminate\Http\Request;
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
}
