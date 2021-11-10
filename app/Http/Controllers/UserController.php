<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller
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
        $search = $request->get('search', '');

        $users = User::where('first_name', 'like', '%'.$search.'%')->orwhere('last_name', 'like', '%'.$search.'%')->orwhere('username', 'like', '%'.$search.'%')->orwhere('email', 'like', '%'.$search.'%')->paginate(10);
        return view('layouts.user.index', compact('users'));
        
    }

    public function show(Request $request){

        return view('layouts.user.create');
    }

    public function store(Request $request){

        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'userRole' => 'required|string|max:255',
        ]);

        User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'userRole' => $request['userRole'],       
            ]);

        Alert::success('Success', 'You\'ve Successfully added User');

        return redirect()->route('user')->with('success','Product Category added successfully');

    }

    public function edit(Request $request, $id){
        
        $staff = User::find($id);

        return view('layouts.user.edit', compact('staff'));
    }

    public function update(Request $request, $id){

         $staff = User::find($id);

         $this->validate($request, [
            'userRole' => 'required|string|max:255',
        ]);

         $staff->fill([

            'userRole'=>$request->userRole ? $request->userRole : $staff->userRole,

         ])->save();

         Alert::success('Success', 'You\'ve Successfully upgraded User');

        return redirect()->route('user')->with('success','Staff was Upgraded successfully');

    }

    public function change(Request $request, $id){

        $staff = User::find($id);

        return view('layouts.user.change', compact('staff'));
    }

    public function changePassword(Request $request, $id){

         $staff = User::find($id);

         $this->validate($request, [
            'old_password' => 'required|string|max:255',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

         $password = $request['old_password'];

         if(Hash::check($password, $staff->password)){

            $staff->fill([

              'password'=>Hash::make($request['new_password']),

            ])->save();


            Alert::success('Success', 'You\'ve Successfully Updated User\'s Password');

            return redirect()->route('user')->with('success','Staff Password was Updated successfully');

        }

        Alert::error('Error', 'Staff Password doesn\'t match in our database');

        return redirect()->route('user')->with("success','Staff Password doesn't match in our database");

    }

    public function reset(Request $request, $id){

        $staff = User::find($id);

        return view('layouts.user.reset', compact('staff'));
    }


    public function resetPassword(Request $request, $id){

         $staff = User::find($id);

         $this->validate($request, [
            'password' => 'required|string|min:8|confirmed',
        ]);


        $staff->fill([

            'password'=>Hash::make($request['password']),

        ])->save();

        Alert::success('Success', 'You\'ve Successfully reset your Password');

        return redirect()->route('user')->with('success','Staff Password was Updated successfully');
    }


    public function destroy(Request $request, $id){

        $staff = User::find($id);

        $staff->delete();

        Alert::success('Success', 'You\'ve Successfully deleted company\'s staff ');

        return redirect()->route('user')->with('success','Companys staff deleted successfully');
        
    }

}
