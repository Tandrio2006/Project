<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Validator;
use Illuminate\Support\Facades\Log;
class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::orderBy('Username', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = [
            'Username' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:tbl_customer,Email',
            'Wa' => 'required|string|max:15',
            'Bank' => 'required|string|max:255',
            'NamaRek' => 'required|string|max:255',
            'NoRek' => 'required|string|max:255',
            'captcha' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $emailError = $errors->has('Email');
            $captchaError = $errors->has('captcha');

           
            if ($emailError) {
                Log::error('Validation failed: email is incorrect.', ['errors' => $errors]);
                return response()->json([
                    'status' => false,
                    'message' => 'Email sudah ada. Silahkan coba lagi.',
                    'data' => $errors
                ]);
            } elseif ($captchaError) {
                Log::error('Validation failed: captcha is incorrect.', ['errors' => $errors]);
                return response()->json([
                    'status' => false,
                    'message' => 'Captcha salah. Silahkan coba lagi.',
                    'data' => $errors
                ]);
            }
        }

        $Customer = new Customer;
        $Customer->Username = $request->Username;
        $Customer->Email = $request->Email;
        $Customer->Wa = $request->Wa;
        $Customer->Bank = $request->Bank;
        $Customer->NamaRek = $request->NamaRek;
        $Customer->NoRek = $request->NoRek;

        if ($Customer->save()) {
            Log::info('Customer created successfully.', ['customer_id' => $Customer->id]);
            return response()->json([
                'status' => true,
                'message' => 'Sukses memasukkan data'
            ]);
        } else {
            Log::error('Failed to save customer data.', ['customer' => $Customer]);
            return response()->json([
                'status' => false,

            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
