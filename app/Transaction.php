<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['title', 'amount', 'description', 'type', 'status'];

    public function transactions()
	{
	    return $this->hasMany(Transaction::class);
	}
}
