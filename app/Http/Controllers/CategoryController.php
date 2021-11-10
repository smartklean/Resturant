<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

use App\Models\Category;

use Illuminate\Support\Facades\Validator;

use Auth;

class CategoryController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){

        $search = $request->get('search', '');

        $categories = Category::where('name', 'like', '%'.$search.'%')->with('user')->paginate(10);
        
        return view('layouts.category.index',compact('categories'));
    }

    public function create(Request $request){

        return view('layouts.category.create');
    }


    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:255|unique:categories',
            'logo' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

         if($request->hasFile('logo')){

            $file = $request->file('logo');
            // Define upload path
            $destinationPath = public_path('/category_images/'); // upload path
            // Upload Orginal Image           
            $img = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $img);

            Category::create([
                'name' => $request['name'],
                'created_by' => Auth::user()->id,
                'logo' => $img,
                
            ]);
        
        Alert::success('Success', 'You\'ve Successfully added Category');

        return redirect()->route('category')->with('success','Product Category added successfully');

        }

        Alert::error('Error', 'Unable to add Category, Please try again');
    }

    public function edit(Request $request, $id){
        $category = Category::find($id);

        return view('layouts.category.edit', compact('category'));
    }
        

    public function update(Request $request, $id){
        $category = Category::find($id);

        $this->validate($request, [
            'name' => 'nullable|string|max:255|unique:categories,name,'.$category->id,
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
    
        if($request->hasFile('logo')){
            
            $file = $request->file('logo');
            // Define upload path
            $destinationPath = public_path('/category_images/'); // upload path
            // Upload Orginal Image           
            $img = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $img);
            unlink(public_path('/category_images/'.$category->logo));
        }else{
            $img = $category->logo;
        }

        $category->fill([
            'name'=>$request->name ? $request->name : $category->name,
            'updated_at'=> Auth::user()->id,
            'logo'=> $img ? $img : $category->logo,

         ])->save();

        Alert::success('Success', 'You\'ve Successfully updated Category');

        return redirect()->route('category')->with('success','Product Category Updated successfully');

    }

    public function destroy(Request $request, $id){
        $category = Category::find($id);

        $category->delete();

        Alert::success('Success', 'You\'ve Successfully deleted Category');
        
        return redirect()->route('category')->with('success','Product Category deleted successfully');
    }

}

