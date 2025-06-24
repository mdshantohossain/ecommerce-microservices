<?php

namespace App\Http\Controllers;

use App\Models\Website\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        return view('website.wishlist.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' =>  'required|exists:users,id',
            'product_id' =>  'required|exists:products,id',
        ]);

        try {
            Wishlist::create($request->all());

            return response()->json(['success' => 'Wishlist created successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(int $id)
    {
        try {
            $wishlist = Wishlist::findOrFail($id);
            $wishlist->delete();

            return response()->json(['success' => 'Wishlist deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
