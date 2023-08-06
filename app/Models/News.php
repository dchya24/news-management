<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'user_id'
    ];

    public function comment(){
        return $this->hasMany(Comment::class, 'news_id');
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
