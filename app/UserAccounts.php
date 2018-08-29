<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccounts extends Model
{
    protected $table='useraccounts';
    protected $fillable=['username','email','image','password'];
}
