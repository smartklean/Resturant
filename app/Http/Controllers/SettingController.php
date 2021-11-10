<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

use App\Models\Setting;

use Illuminate\Support\Facades\Validator;

use Auth;

class SettingController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){

        $Setting = Setting::all()->first();

        return view('layouts.setting.index',compact('Setting'));
    }


    public function store(Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:255|unique:settings',
            'address' => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            'phone' => 'required|unique:settings|regex:/(0)[0-9]{10}/',
            'logo' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

         if($request->hasFile('logo')){

            $file = $request->file('logo');
            // Define upload path
            $destinationPath = public_path('/logo_images/'); // upload path
            // Upload Orginal Image           
            $img = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $img);

            Setting::create([
                'name' => $request['name'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'currency' => $request['currency'],
                'logo' => $img,
                
            ]);

        Alert::success('Success', 'You\'ve Successfully added Company\'s Profile');

        return redirect()->route('home')->with('success','Companys profile added successfully');

        }

         

    }
}
