<?php
/**
 * TransactionController File Documentation
 *
 * @category Controller Class
 * @package Controller
 * @author Fahri Firdausillah
 */

namespace App\Http\Controllers;

use App\Http\Requests\TransactionForm;
use Illuminate\Http\Request;
use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Auth;

/**
 * TransactionController
 *
 *
 * @package    App
 * @subpackage Controller
 * @author     Fahri Firdausillah <elfaatta@gmail.com>
 */
class TransactionController extends Controller
{
    protected $repo;
    protected $user;

    /**
     *
     * Function constructor
     *
     * @param TransactionRepository $transRepo DI for TransactionRepo
     */
    public function __construct(TransactionRepository $transRepo)
    {
        $this->repo = $transRepo;

        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();
            $this->repo->setUid($this->user->id);
            return $next($request);
        });
    }

    /**
     *
     * Function add Transaction
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        return view('add-trans');
    }

    /**
     *
     * Function add Transaction
     *
     * @param TransactionForm|Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addPost(TransactionForm $request)
    {
        $this->user->addTransaction($request->all());

        return redirect()->route('home')
            ->with('message', 'Berhasil input data transaksi baru');
    }

    /**
     *
     * Function add Transaction
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param Request $request
     */
    public function show()
    {
        return view('list-trans', ['balance' => $this->repo->getBalance(),
            'outTransactions' => $this->repo->listOut(),
            'inTransactions' => $this->repo->listIn()]);
    }
}
