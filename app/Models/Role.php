<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    protected $guarded =[];


    public function users()
    {
        return $this -> hasMany(Admin::class,'role_id','id');
    }
}
