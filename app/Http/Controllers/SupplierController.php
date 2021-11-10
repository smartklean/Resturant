<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

use App\Models\Supplier;

use Illuminate\Support\Str;

class SupplierController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){

        $search = $request->get('search', '');

        $suppliers = Supplier::where('name', 'like', '%'.$search.'%')->orwhere('code', 'like', '%'.$search.'%')->orwhere('phone', 'like', '%'.$search.'%')->paginate(10);

        return view('layouts.supplier.index', compact('suppliers'));

    }

    public function create(Request $request){
        return view('layouts.supplier.create');
    }


     public function store(Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:255|unique:suppliers',
            'address' => 'required|string|max:255',
            'phone' => 'required|unique:settings|regex:/(0)[0-9]{10}/',
        ]);

            Supplier::create([
                'name' => $request['name'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'code' => substr(str_shuffle("0123456789"), 0, 5),
                
            ]);

        Alert::success('Success', 'You\'ve Successfully added Company\'s Supplier');

        return redirect()->route('supplier')->with('success','Companys Supplier added successfully');

    }

    public function edit(Request $request, $id){
        
        $supplier = Supplier::find($id);

        return view('layouts.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id){

         $supplier = Supplier::find($id);

         $this->validate($request, [
            'name' => 'required|string|max:255|unique:suppliers,name,'.$supplier->id,
            'address' => 'required|string|max:255',
            'phone' => 'required|unique:settings|regex:/(0)[0-9]{10}/',
        ]);

         $supplier->fill([
            'name'=>$request->name ? $request->name : $supplier->name,
            'address'=>$request->address ? $request->address : $supplier->address,
            'phone'=>$request->phone ? $request->phone : $supplier->phone,

         ])->save();

         Alert::success('Success', 'You\'ve Successfully updated Company\'s Supplier');

        return redirect()->route('supplier')->with('success','Companys Supplier updated successfully');

    }

    public function destroy(Request $request, $id){

        $supplier = Supplier::find($id);

        $supplier->delete();

        Alert::success('Success', 'You\'ve Successfully deleted Company\'s Supplier');

        return redirect()->route('supplier')->with('success','Companys Supplier deleted successfully');
        
    }
}
