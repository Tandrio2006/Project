<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
class FormController extends Controller
{
    public function index()
    {
        return view('form.indexform');
    }

}
