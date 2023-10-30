<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = ['title', 'image', 'description', 'sub_title', 'sub_description'];

    public function category():BelongsTo {
        return  $this->belongsTo(Category::class,'category_id', 'id');
    }
}
