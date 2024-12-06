<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{




    function signUpPage(): View
    {
        return view('auth.sign-up');
    }
    function signInPage(): View
    {
        return view('auth.sign-in');
    }
    function otpSendPage(): View
    {
        return view('auth.otp-send');
    }
    function otpVerifyPage(): View
    {
        return view('auth.otp-verify');
    }
    function passwordResetPage(): View
    {
        return view('auth.password-reset');
    }



    public function signUp(Request $request)
    {
        try {
            $data = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'dob' => $request->input('dob'),
                'gender' => $request->input('gender'),
                'height' => $request->input('height'),
                'weight' => $request->input('weight'),
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json([
                'status' => 'success',
                'data' => $data,
                'url' => route('auth.sign-in-page'),
                'message' => 'User Registration Successfully.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'User Registration Failed.',
                'error' => $e->getMessage(),
            ], 200);
        }
    }

    function signIn(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $request->input('email'))->first();

            // Check if the user exists and password matches
            if ($user && Hash::check($request->input('password'), $user->password)) {

                // Generate token
                $token = JWTToken::generateToken("userSignInToken", $user->email, $user->id, 60 * 60 * 24 * 30); // Store token for 30 days
                // Store user id in session
                session(['user_id' => $user->id]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'User login success.',
                    'role' => $user->role,
                    'data' => $user,
                    'urlForAdmin' => route('admin.dashboard'),
                    'urlForUser' => route('user.dashboard'),
                ], 200)->cookie('signInToken', $token, 60 * 24 * 30); // Store token for 30 days
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Unauthorized user.'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 200);
        }
    }

    public function otpSend(Request $request)
    {
        try {
            $email = $request->input("email");
            $isUser = User::where('email', $email)->first();

            if ($isUser) {
                // $otp = rand(100000, 999999);
                $otp = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 6);

                // update otp
                $isUser->update(['otp' => $otp]);

                //send otp
                Mail::to($email)->send(new OTPMail($otp));

                return response()->json([
                    'status' => 'success',
                    'url' => route('auth.otp-verify-page'),
                    'message' => "Check your email for code."
                ], 200)->cookie('emailForForgot', $email, 10); // Store cookie for 5 minutes
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'User not found.'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 200);
        }
    }


    function otpVerify(Request $request)
    {
        try {

            $email = $request->cookie('emailForForgot');

            $otp = $request->input('otp');


            $verify = User::where('email', $email)->where('otp', $otp)->get();

            if ($verify) {
                User::where('email', $email)->update(['otp' => null]);

                $token = JWTToken::generateToken("Password Reset Token", $email, null, 60 * 5); // Store token for 5 minutes

                return response()->json([
                    'status' => 'success',
                    'message' => 'Otp verification successfully',
                    'url' => route('auth.reset-pass-page'),
                ], 200)->cookie('passwordResetToken', $token, 5); // Store cookie for 5 minutes



            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => $email,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 200);
        }
    }

    function passwordReset(Request $request)
    {
        try {

            // \Log::info('Request Headers:', $request->headers->all());

            $email = $request->cookie('emailForForgot');
            // if (!$email) {
            //     $email = $request->cookie('emailForReset');
            // }

            if ($email == null) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Email not found.',
                    'url' => route('auth.sign-in-page'),
                ]);
            }


            $isUser = User::where('email', $email)->first();

            if ($isUser) {
                User::where('email', $email)->update([
                    'password' => Hash::make($request->input('password')),
                ]);
                return response()->json([
                    'status' => 'success',
                    'url' => route('auth.sign-in-page'),
                    'message' => 'Password reset successfully.',
                ], 200)->cookie('passwordResetToken', '', -1);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'User not found.',
                    'url' => route('auth.sign-in-page'),
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong. Please try again.',
                'url' => route('auth.sign-in-page'),
                'error' => $e->getMessage()
            ], 200)->cookie('passwordResetToken', '', -1);
        }
    }

    function signOut()
    {
       // delete sign in token and session
        session()->forget('user_id');
        return redirect()->route('auth.sign-in-page')->withCookie(cookie()->forget('signInToken'));
    }
}
