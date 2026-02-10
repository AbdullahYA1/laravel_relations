<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = ['name', 'email', 'phone', 'role', 'active', 'user_id'];


    public function user(){
    return $this->belongsTo(User::class);
}
}
