<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'comment', 'news_id', 'user_id'
    ];

    public function news(){
        return $this->belongsTo(News::class, 'news_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
