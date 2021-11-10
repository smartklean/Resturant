<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use App\Models\Product;

use App\Models\Sale;

use RealRashid\SweetAlert\Facades\Alert;

use Auth;

use DB;

use Response;

class SaleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request){

    }

    public function search(Request $request){

        if($request['query']) {

            $search = $request['query'];

            $products = Product::where('name', 'like', '%'.$search.'%')->get();

             $output = '';
               
            if (count($products)>0) {
              
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
              
                foreach ($products as $row){
                   
                    $output .= '<li class="list-group-item">'.$row->name.'</li>';
                }
              
                $output .= '</ul>';
            }
            else {
             
                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
       
            return $output;

        }
    }


    public function getProduct(Request $request, $name){

        $product = Product::where('name', $name)->first();

        return $product;
    }
    

    public function show(Request $request){

        $products = Product::all();


        return view('layouts.sales.index', compact('products'));
    }


    public function store(Request $request){


        $sale = Sale::latest('created_at')->first();

        if($sale){
         
         $sale_id = (int)$sale->invoice_id; 
        
        }else{

            $sale_id = (int)1000000;
        }

        $invoice_id = $sale_id+1;

        echo $invoice_id;

       foreach($request->data as $data){
        $qty = $data[4]/$data[2];
        $prod_id = $data[0];
        $user_id = Auth::user()->id;
        $total = $data[4];

        Sale::create([
              'invoice_id'=> $invoice_id,
              'user_id'=> Auth::user()->id,
              'product_id'=>$prod_id,
              'quantity'=>$qty,
              'total'=> $total,
            ]);

       $product = Product::find($prod_id);

       $product->fill([
            'quantity' =>(int)$product->quantity-(int)$qty,
         ])->save();
       }
        
        Alert::success('Congrats', 'You\'ve Successfully made Sales');
        
        return redirect()->route('sales')->with('success','sales made successfully');
        
    }
}