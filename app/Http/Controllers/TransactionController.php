<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            Auth::user()->addTransaction($request->all());

            return redirect()->route('home')
                ->with('message', 'Berhasil input data transaksi baru');
        }
        return view('add-trans');
    }
}
