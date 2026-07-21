<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Services\ProductTypeImportService;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProductTypeController extends Controller
{
    protected $importService;

    public function __construct(ProductTypeImportService $importService)
    {
        $this->importService = $importService;
    }

    /**
     * Menampilkan halaman Product Type
     */
    public function index()
    {
        $products = ProductType::latest()->get();

        return view(
            'pages.user.master-data.product-type',
            compact('products')
        );
    }

    /**
     * Simpan Product Type
     */
    public function store(Request $request)
    {
        $request->validate([
            'po' => 'required',
            'kp' => 'required',
            'season' => 'required',
            'style' => 'required',
            'destination' => 'required',
        ]);

        ProductType::create([
            'po' => $request->po,
            'kp' => $request->kp,
            'season' => $request->season,
            'style' => $request->style,
            'destination' => $request->destination,
        ]);

        return back()->with(
            'success',
            'Product Type berhasil ditambahkan.'
        );
    }

    /**
     * Update Product Type
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'po' => 'required',
            'kp' => 'required',
            'season' => 'required',
            'style' => 'required',
            'destination' => 'required',
        ]);

        $product = ProductType::findOrFail($id);

        $product->update([
            'po' => $request->po,
            'kp' => $request->kp,
            'season' => $request->season,
            'style' => $request->style,
            'destination' => $request->destination,
        ]);

        return back()->with(
            'success',
            'Product Type berhasil diupdate.'
        );
    }

    /**
     * Hapus Product Type
     */
    public function destroy($id)
    {
        ProductType::findOrFail($id)->delete();

        return back()->with(
            'success',
            'Product Type berhasil dihapus.'
        );
    }

    /**
     * Import CSV / Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls|max:5120'
        ]);

        try {
            $result = $this->importService->import(
                $request->file('file')
            );

            return back()->with(
                'success',
                "Import berhasil. Insert : {$result['insert']} | Update : {$result['update']}"
            );
        } catch (\Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'PO',
            'KP',
            'Season',
            'Style',
            'Destination',
        ];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($headers, null, 'A1');

        $writer = new Xlsx($spreadsheet);

        $callback = function () use ($writer) {
            $writer->save('php://output');
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="product_type_template.xlsx"',
        ]);
    }
}
