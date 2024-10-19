<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Mews\Captcha\Facades\Captcha;
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
    public function reloadCaptcha()
    {
        $captcha = captcha_img('mini');
        session(['captcha' => $captcha]);
        return response()->json(['captcha' => $captcha]);

    }


    public function store(Request $request)
    {
        if (!captcha_check($request->input('captcha'))) {
            Log::warning('Captcha validation failed.', [
                'input' => $request->input('captcha'),
                'session_captcha' => session('captcha')
            ]);
            return response()->json(['success' => false, 'message' => 'Captcha yang Anda masukkan tidak valid atau Mohon di refresh captcha.']);
        }


        $validate = [
            'Username' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:tbl_customer,Email',
            'Wa' => 'required|string|max:15',
            'Bank' => 'nullable|string',
            'NamaRek' => 'nullable|string',
            'NoRek' => 'nullable|string',
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
        $Customer->Bank = $request->Bank ?? null;  
        $Customer->NamaRek = $request->NamaRek ?? null;
        $Customer->NoRek = $request->NoRek ?? null;

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
