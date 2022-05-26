<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervencion extends Model
{
    use HasFactory;

    protected $fillable = ['detalle', 'cambio_estado', 'id_usuario', 'id_solicitud'];
}
