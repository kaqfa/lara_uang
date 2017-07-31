<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function addTransaction($input)
    {        
        return $this->transactions()
                    ->create(['title'=>$input['title'], 
                              'amount'=>$input['amount'],
                              'description'=>$input['description'],
                              'type'=>$input['type'],
                              'status'=>1]);
    }
}
