<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\Supplier;

use App\Models\Category;

use Auth;

class ProductController extends Controller
{
    
     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){

        $search = $request->get('search', '');

        $products = Product::where('name', 'like', '%'.$search.'%')
        ->with('user')->with('category')->with('supplier')->paginate(10);

        return view('layouts.product.index', compact('products'));
    }

    public function create(Request $request){

        $categories = Category::all();

        $suppliers = Supplier::all();
        
        return view('layouts.product.create', compact('suppliers','categories'));

    }

    public function store(Request $request){
         $this->validate($request, [
            'name' => 'required|string|max:255|unique:products',
            'logo'  => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'quantity'=>'required|string|max:255',
            'cost_price' => 'required|string|max:255',
            'selling_price' => 'required|string|max:255',
            'low_stock' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',

        ]);

        if($request->hasFile('logo')){

            $file = $request->file('logo');
            // Define upload path
            $destinationPath = public_path('/product_images/'); // upload path
            // Upload Orginal Image           
            $img = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $img);

            Product::create([
                'name' => $request['name'],
                'logo' => $img,
                'quantity' => $request['quantity'],
                'cost_price' => $request['cost_price'],
                'selling_price' => $request['selling_price'],
                'low_stock' => $request['low_stock'],
                'category_id' => $request['category'],
                'supplier_id' => $request['supplier'],
                'created_by' => Auth::user()->id,
            ]);
            
            Alert::success('Success', 'You\'ve Successfully added Product');

            return redirect()->route('product')->with('success','Product added successfully');

        }

        Alert::error('Error', 'Sorry Unable to add Product Please try again ');

    }

    public function edit(Request $request, $id){
        $product = Product::find($id);

        $categories = Category::all();

        return view('layouts.product.edit', compact('product', 'categories'));
    }


    public function update(Request $request, $id){

        $product = Product::find($id);

        $this->validate($request, [
            'name' => 'nullable|string|max:255|unique:products,name,'.$product->id,
            'logo'  => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'quantity' => 'nullable|string|max:255',
            'cost_price' => 'nullable|string|max:255',
            'selling_price' => 'nullable|string|max:255',
            'low_stock' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'supplier' => 'nullable|string|max:255',
        ]);

        if($request->hasFile('logo')){
            
            $file = $request->file('logo');
            // Define upload path
            $destinationPath = public_path('/product_images/'); // upload path
            // Upload Orginal Image           
            $img = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $img);
            unlink(public_path('/product_images/'.$product->logo));
        }else{
            $img = $product->logo;
        }

        $product->fill([
            'name'=>$request->name ? $request->name : $product->name,
            'updated_at'=> Auth::user()->id,
            'logo'=> $img ? $img : $product->logo,
            'quantity' =>$request->quantity ? $request->quantity : $product->quantity,
            'cost_price' => $request->cost_price ? $request->cost_price : $product->cost_price,
            'selling_price' => $request->selling_price ? $request->selling_price : $product->selling_price,
            'low_stock' => $request->low_stock ? $request->low_stock : $product->low_stock,
            'category_id' => $request->category ? $request->category : $product->category_id,
            'supplier_id' => $request->supplier_id ? $request->supplier : $product->supplier_id,
         ])->save();
        
        Alert::success('Success', 'You\'ve Successfully updated Product');

        return redirect()->route('product')->with('success','Product updated successfully');

    }

    public function destroy(Request $request, $id){
        $product = Product::find($id);

        $product->delete();

        Alert::success('Success', 'You\'ve Successfully deleted Product');
        
        return redirect()->route('product')->with('success','Product deleted successfully');
        
    }
}
