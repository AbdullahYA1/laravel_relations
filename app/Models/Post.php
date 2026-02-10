<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'image', 'profile_id', 'user_id'];

    public function user(){
    return $this->belongsTo(User::class);
}
public function categories(){

    return $this->belongsToMany(Category::class, 'post_category_pivot');
}
}

