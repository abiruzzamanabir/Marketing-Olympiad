<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    use HasFactory,Notifiable;
    protected $guarded = [];

    public function role()
    {
        return $this ->belongsTo(Role::class,'role_id','id');
    }
}
