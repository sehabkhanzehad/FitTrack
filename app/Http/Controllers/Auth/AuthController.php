<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{




    function signUpPage(): View
    {
        return view('auth.sign-up');
    }





    function LoginPage(): View
    {
        return view('pages.auth.login-page');
    }
    function SendOtpPage(): View
    {
        return view('pages.auth.send-otp-page');
    }
    function VerifyOTPPage(): View
    {
        return view('pages.auth.verify-otp-page');
    }
    function ResetPasswordPage(): View
    {
        return view('pages.auth.reset-pass-page');
    }




    public function signUp(Request $request)
    {
        try {

            $data = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => $request->input('password'),
                'gender' => $request->input('gender'),
                'height' => $request->input('height'),
                'weight' => $request->input('weight'),
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $data,
                'message' => 'User Registration Successfully.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User Registration Failed.',
                'error' => $e->getMessage()
            ], 200);
        }
    }

    function signIn(Request $request)
    {
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))->first();
        if ($count !== null) {
            $token = JWTToken::CreateToken($request->input('email'), $count->id);
            session(['user_id' => $count->id]);
            return response()->json([
                'status' => 'success',
                'message' => 'User Login success',
                'role' => $count->role,
            ], 200)->cookie('token', $token, 60 * 24 * 30); //sec

        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized'
            ], 200);
        }
    }

    function otpSend(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(1000, 9999);
        $count = User::where('email', '=', $email)->count();

        if ($count == 1) {
            // OTP Email Address
            Mail::to($email)->send(new OTPMail($otp));
            // OTO Code Table Update
            User::where('email', '=', $email)->update(['otp' => $otp]);

            return response()->json([
                'status' => 'success',
                'message' => '4 Digit OTP Code has been send to your email !'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ]);
        }
    }

    function otpVerify(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');
        $count = User::where('email', '=', $email)
            ->where('otp', '=', $otp)->count();
        if ($count == 1) {

            User::where('email', '=', $email)
                ->where('otp', '=', $otp)->update(['otp' => '0']);

            $token = JWTToken::CreateTokenForSetPassword($request->input('email'));
            return response()->json([
                'status' => 'success',
                'message' => 'Otp verification successfully',
            ], 200)->cookie('token1', $token, 60 * 24 * 30);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ]);
        }
    }

    function passwordReset(Request $request)
    {

        try {

            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email', '=', $email)->update(['password' => $password]);
            return response()->json([
                'status' => 'success',
                'message' => 'Request successfully',
            ], 200)->cookie('token1', '', -1);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed',
            ], 200)->cookie('token1', '', -1);
        }
    }

    function signOut()
    {
        session()->flush();
        return redirect('/userLogin')->cookie('token', '', -1);
    }
}
