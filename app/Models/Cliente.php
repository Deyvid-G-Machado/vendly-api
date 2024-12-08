<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'cpf',
        'telefone',
    ];

    protected $hidden = ['senha'];

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }
}
