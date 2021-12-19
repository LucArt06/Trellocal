<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function listBoards()
    {
        return $this->hasMany(Listboard::class, "id_board");
    }
}
