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

    protected $casts = [
        'status' => 'boolean',
        'blocked' => 'boolean',
        'trash' => 'boolean',
        'round_one_status' => 'boolean',
        'round_two_status' => 'boolean',
        'selected' => 'boolean',
        'selectedTwo' => 'boolean',
        'selectedThree' => 'boolean',
        'winner' => 'boolean',
        'last_login_at' => 'datetime',
    ];


    public function avatarFile(): string
    {
        if (!empty($this->photo) && $this->photo !== 'avatar.png') {
            return $this->photo;
        }

        return strtolower((string) $this->gender) === 'female'
            ? 'avatar_female.svg'
            : 'avatar_male.svg';
    }

    public function role()
    {
        return $this ->belongsTo(Role::class,'role_id','id');
    }
}
