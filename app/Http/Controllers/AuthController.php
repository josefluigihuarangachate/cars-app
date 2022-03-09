<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function loginView()
    {
        return view("login");
    }

    function registerView()
    {
        return view("register");
    }

    function doLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(), 422);


        } else {

            if (Auth::attempt($request->only(["email", "password"]))) {

                $user = Auth::user();

                if($user->role == 'admin'){
                    return response()->json(["status" => true, "redirect_location" => url("dashboard")]);
                }else {
                    return response()->json(["status" => true, "redirect_location" => url("/")]);
                }

            } else {
                return response()->json([["Invalid credentials"]], 422);
            }
        }
    }

    function doRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',

        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(), 422);


        } else {

            $User = new User;
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = bcrypt($request->password);
            $User->role = "user";
            $User->save();

            return response()->json(["status" => true, "msg" => "You have successfully registered, Login to access your dashboard", "redirect_location" => url("/")]);
        }
    }

    function dashboard()
    {
       if(Auth::user()->role == 'admin'){
            $cars =  Car::all();
            $categories =  Category::all();
            return view("dashboard", compact('cars','categories'));
       }else {
            return redirect("/");
       }
    }


    function logout()
    {
        Auth::logout();
        return redirect("login")->with('success', 'Logout successfully');;
    }
}
