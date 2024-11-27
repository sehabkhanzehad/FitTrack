<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use App\Models\SuperAdmin;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function LoginPage(){
        return view('login.index');
    }

    public function loginCheck(Request $request){
        try {
  
            $request->validate([
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:3'
            ]);

              $superAdmin = SuperAdmin::where('email', $request->email)->first();
              
   
              if ($superAdmin) {
 
                if (!$superAdmin || !Hash::check($request->input('password'), $superAdmin->password)) {
                    return  ResponseHelper::Out('fail',null,401);
                }
                $role = 'superadmin';
                $token = JWTToken::CreateToken($request->email ,$superAdmin->id,$role);
                return  ResponseHelper::Out('success',$role,200)->cookie('token',$token,60*24*30);            

              }
             

          } 
          catch (Exception $e) {
            return  ResponseHelper::Out('fail',null,401);
          }
    }
     
}
