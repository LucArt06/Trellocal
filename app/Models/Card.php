<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{

    use HasFactory;
    protected $guarded = ['id'];

    public function listBoardtoCard()
    {
        return $this->belongsTo(Listboard::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_card');
    }
}
