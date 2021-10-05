<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sites extends Model
{
    use HasFactory;

    protected $table = 'Sites';
    protected $primaryKey = 'id';
    protected $fillable = [
        'descricao',
        'url',
        'status',
        'atualizacao',
    ];
}