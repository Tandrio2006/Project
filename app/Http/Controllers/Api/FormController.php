<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Http;
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
        $recaptchaSecret = '6LfXbmkqAAAAACAaA0bWAP5s3lNeeTrKN5YkJ8XB'; 
        $response = $request->input('captcha');
        $remoteIp = $request->ip();

        $verifyResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $response,
            'remoteip' => $remoteIp,
        ]);

        $responseData = json_decode($verifyResponse->getBody());

        if (!$responseData->success) {
            return response()->json([
                'status' => false,
                'message' => 'Verifikasi CAPTCHA gagal.',
            ], 400);
        }

        $validate = [
            'Username' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:tbl_customer,Email',
            'Wa' => 'required|string|max:15',
            'Bank' => 'required|string|max:255',
            'NamaRek' => 'required|string|max:255',
            'NoRek' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            Log::error('Validation failed.', ['errors' => $validator->errors()]);
            return response()->json([
                'status' => false,
                'message' => 'Email sudah ada, coba lagi nanti.',
                'data' => $validator->errors()
            ]);
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
                'message' => 'Gagal menyimpan data. Silakan coba lagi.'
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
