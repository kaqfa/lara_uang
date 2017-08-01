<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    protected $repo;
    protected $user;

    public function __construct(TransactionRepository $transRepo)
    {
        $this->repo = $transRepo;

        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();
            $this->repo->setUid($this->user->id);
            return $next($request);
        });
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->user->addTransaction($request->all());

            return redirect()->route('home')
                ->with('message', 'Berhasil input data transaksi baru');
        }
        return view('add-trans');
    }

    public function show()
    {
        return view('list-trans', ['balance' => $this->repo->getBalance(),
            'outTransactions' => $this->repo->listOut(),
            'inTransactions' => $this->repo->listIn()]);
    }
}
