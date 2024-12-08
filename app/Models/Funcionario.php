<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Funcionario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'funcionarios';

    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->senha;
    }
}

