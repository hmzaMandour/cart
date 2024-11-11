<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(8);
        return view('auth.useroage', compact('products'));
    }
    public function showusers()
    {
        $users = User::withTrashed()->where('id', '!=', 1)->paginate(8); 
        return view('auth.showClients', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('auth.crreateProduct');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'desc'=>'required',
            'image'=>'required',
        ]);

        $file = file_get_contents($request->image);
        $fileName = hash("sha256", $file) . "." . $request->image->getClientOriginalExtension();
        Storage::disk("public")->put("images/" . $fileName, $file);


       $product= Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'desc'=>$request->desc,
            'image'=> $fileName,
        ]);
        




        return back()->with('success', 'Product created successfully.');


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        
 
    }
}
