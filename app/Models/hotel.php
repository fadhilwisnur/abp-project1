<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;


class hotel extends Model
{
    use HasFactory;
    protected $table = 'hotel';
    protected $fillable = ['name','description','rating','image'];

    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id','id');
    }
}
