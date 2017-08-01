<?php
namespace App\Repositories;

use App\Transaction;


class TransactionRepository{

    protected $trans;
    protected $uid = null;

    public function __construct(Transaction $trans)
    {
        $this->trans = $trans;
    }

    public function setUid($uid){
        $this->uid = $uid;
    }

    public function latestTrans()
    {
        $latest = $this->trans->orderBy('created_at', 'desc');
        if($this->uid != null)
            return $latest->where('user_id', $this->uid);
        return $latest;
    }

    public function listIn()
    {
        $latest = $this->latestTrans()->where('type', 2);
        return $latest->get();
    }

    public function listOut()
    {
        $latest = $this->latestTrans()->where('type', 1);
        return $latest->get();
    }

    public function getBalance()
    {
        $in = $this->latestTrans()->where('type', 2)->sum('amount');
        $out = $this->latestTrans()->where('type', 1)->sum('amount');

        return $in - $out;
    }

    public function add($input)
    {
        // already implemented in User model
    }
}