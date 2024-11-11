<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class UserpageController extends Controller
{
    //

    public function index2(){
        
        return view('auth.cards' );
    }

    public function store(Request $request)
    {
        $request->validate([
            'productId' => 'required',
        ]);

        $userId = Auth::user()->id;

        $cartItem = ProductUser::where('user_id', $userId)
            ->where('product_id', $request->productId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            ProductUser::create([
                "product_id" => $request->productId,
                "user_id" => $userId,
                "quantity" => 1
            ]);
        }

        return back();
    }

    public function destroy(User $user)
    {
        //
        $user->delete();
        return back();
    }

    

    public function decrementQuantity(Request $request, $productId)
    {
        $user = Auth::user();
        $cartItem = $user->products()->where('product_id', $productId)->first();

        if ($cartItem) {
            if ($cartItem->pivot->quantity > 1) {
                $cartItem->pivot->quantity -= 1;
                $cartItem->pivot->save();
            } else {
                $productId->delete();
            }
        }

        return back();
    }

}
