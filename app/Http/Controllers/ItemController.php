<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Validator;

class ItemController extends Controller
{
    // GET semua data
    public function index()
    {
        $items = Item::all();

        return response()->json([
            'status' => 'success',
            'data' => $items
        ]);
    }

    // GET berdasarkan ID
    public function show($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $item
        ]);
    }

    // POST tambah data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric',
            'category_id' => 'required'
        ], [
            'name.required' => 'Nama item wajib diisi.',
            'quantity.min' => 'Jumlah minimal 0.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $item = Item::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'category_id' => $request->category_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil ditambahkan',
            'data' => $item
        ]);
    }

    // PUT update data
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $item->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'category_id' => $request->category_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diupdate',
            'data' => $item
        ]);
    }

    // DELETE data
    public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}