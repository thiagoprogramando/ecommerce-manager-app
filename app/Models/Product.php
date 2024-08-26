<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'value',
        'stock',
        'ean',
        'color',
        'group',
        'size',
        'condition',
        'unit',
        'mark',
        'type',
        'status',
        'views',
        'license'
    ];

    public function labelType(): string {
        $types = [
            0 => 'Físico',
            1 => 'Digital',
            2 => 'Serviço'
        ];

        return $types[$this->type] ?? 'Físico';
    }

    public function labelStatus(): string {
        $statuses = [
            1 => 'Disponível',
            2 => 'Pendente',
            3 => 'Bloqueado',
            4 => 'Sem estoque'
        ];

        return $statuses[$this->status] ?? 'Pendente';
    }

}
