<?php

namespace App\Http\Controllers;

use App\Events\UserEvent;
use App\Events\UserRegistered;
use App\Models\User;
use App\Notifications\RegistrationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDOException;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth',['only'=>'logout']);
    }

    


    public function processRegister(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required:max:15',
            'password' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return response()->json(['data'=>'wrong']);
        }

        try {
            $user =   User::create([
                'name' => $req->name,
                'email' => $req->email,
                'phone' => $req->phone,
                'password' => bcrypt($req->password),
                'remember_token' => uniqid(time() . $req->email, true) . str_random(16)
            ]);

            return response()->json(['data'=>'success']);
            // $user->notify(new RegistrationEmail($user));

        } catch (\Exception $err) {
            return response()->json(['data'=>'wrong']);
        }
    }


    public function processLogin(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['data'=>'wrong']);
        }

        $credentials =  $req->only(['email', 'password']);

        if (auth()->attempt($credentials)) {
            return response()->json(['data'=>auth()->user()]);
        } else {
            return response()->json(['data'=>'wrong']);
        }
    }

    public function dashboard(){
        return "Dashboard";
        
    }

    public function logout(){
       auth()->logout();
       return "logged Out";

    }
}
