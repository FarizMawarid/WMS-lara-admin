<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index()
    {
        $products = ProductType::latest()->get();

        return view(
            'pages.user.master-data.product-type',
            compact('products')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'po' => 'required',
            'kp' => 'required',
            'season' => 'required',
            'style' => 'required',
            'style' => 'required',
        ]);

        ProductType::create($request->all());

        return back()->with('success','Product Type berhasil ditambahkan');
    }

    public function update(Request $request,$id)
    {
        ProductType::findOrFail($id)
            ->update($request->all());

        return back()->with('success','Product Type berhasil diupdate');
    }

    public function destroy($id)
    {
        ProductType::findOrFail($id)->delete();

        return back()->with('success','Product Type berhasil dihapus');
    }
}