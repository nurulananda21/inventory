<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ItemController extends Controller
{
    // GET ALL ITEMS
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Item::all()
        ], 200);
    }

    // CREATE ITEM
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|integer'
            ]);

            $item = Item::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Item created successfully',
                'data' => $item
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // GET ITEM BY ID
    public function show($id)
    {
        try {

            $item = Item::findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => $item
            ], 200);

        } catch (ModelNotFoundException $e) {

            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    // UPDATE ITEM
    public function update(Request $request, $id)
    {
        try {

            $item = Item::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|integer'
            ]);

            $item->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Item updated successfully',
                'data' => $item
            ], 200);

        } catch (ModelNotFoundException $e) {

            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $e->getMessage()
            ], 404);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // DELETE ITEM
    public function destroy($id)
    {
        try {

            $item = Item::findOrFail($id);

            $item->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Item deleted successfully'
            ], 200);

        } catch (ModelNotFoundException $e) {

            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}