<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

use App\Models\Refil;

use App\Models\Product;

use App\Models\Supplier;

use App\Models\Category;

use Auth;

use DB;

class RefillController extends Controller
{
    //

     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){

        $category = Category::all();

        $suppliers = Supplier::all();

        $search = $request->get('search', '');

        $products = Product::where('name', 'like', '%'.$search.'%')
        ->with('user')->with('category')->with('supplier')->paginate(10);

        return view('layouts.refill.index', compact('products','suppliers','category'));
    }


    public function edit(Request $request, $id){
        
        $product = Product::find($id);

        $categories = Category::all();

        return view('layouts.refill.edit', compact('product', 'categories'));
    
    }

    public function store(Request $request){

        $this->validate($request, [

            'product_id' => 'required|string|max:255',
            'old_stock' => 'required|string|max:255',
            'quantity'=>'required|string|max:255',
            'total_stock' => 'required|string|max:255',
        ]);

        DB::transaction(function() use ($request)
        {
            $product = Product::find($request->product_id);
            
            $refill = Refil::create([
              'product_id'=> $request['product_id'],
              'created_by'=> Auth::user()->id,
              'old_stock'=>$request['old_stock'],
              'quantity'=>$request['quantity'],
              'total_stock'=> $request['total_stock'],
            ]);

            $update_quantity = $product->fill([
                'quantity' =>$request->total_stock ? $request->total_stock : $product->quantity,
             ])->save();
        
        });

        Alert::success('Success', 'You\'ve Successfully restock Product');
        
        return redirect()->route('refill')->with('success','Product restocked successfully');
    }
}

