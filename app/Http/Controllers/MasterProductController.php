<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterProductController extends Controller
{
    //

    public function index(Request $request)
    {
        return view('pages.pages-master-product');
    }

    public function add(Request $request)
    {
        return view('pages.pages-master-product-add');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'nama' => 'required',
                'harga' => 'required',
                'jenis' => 'required',
                'deskripsi' => 'nullable',

            ]);
            $productImages = [];
            foreach ($request->file('images') as $image) {
                $imageName = uniqid()  . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);
                $productImages[] = $imageName;
            }
            $produk = ProductModel::create([
                'nama' => $request->input('nama'),
                'harga' => $request->input('harga'),
                'jenis' => $request->input('jenis'),
                'deskripsi' => $request->input('deskripsi'),
            ]);

            file_put_contents('test.txt', $productImages);
            foreach ($productImages as $value) {
                $produk->images()->create([
                    'nama' => $value
                ]);
            }
            DB::commit();
            return $this->successResponse('sukses save');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorResponse($th->getMessage());
        }
    }
}
