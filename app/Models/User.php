<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'photo',
        'name',
        'description',
        'address',
        'cpfcnpj',
        'phone',
        'email',
        'password',
        'wallet',
        'api_key',
        'url',
        'type',
        'status',
        'created_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function labelStatus(): string {
        $statuses = [
            1 => 'Ativo',
            2 => 'Pendente',
            3 => 'Bloqueado',
        ];

        return $statuses[$this->status] ?? 'Pendente';
    }

    public function labelType(): string {
        $types = [
            1 => 'Administrador',
            2 => 'Empresa',
            3 => 'Colaborador',
            4 => 'Cliente'
        ];

        return $types[$this->type] ?? 'Desconhecido';
    }
}
