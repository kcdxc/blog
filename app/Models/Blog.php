<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    
    protected $table = 'blogs';

    protected $fillable = [
        'category_id', 'title', 'description', 'content'
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}