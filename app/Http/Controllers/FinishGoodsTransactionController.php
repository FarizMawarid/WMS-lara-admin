<?php

namespace App\Http\Controllers;

use App\Models\FinishGoodsTransaction;
use App\Models\ProductType;
use App\Models\Rack;
use Illuminate\Http\Request;

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
}
