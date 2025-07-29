<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    use HasFactory;

    protected $table = 'agentes';

    protected $fillable = [
        'nombre',
        'rol',
        'habilidad',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public static function rules($id = null)
    {
        return [
            'nombre' => 'required|string|max:255|unique:agentes,nombre,' . $id,
            'rol' => 'required|in:assault,defensive,support,recon',
            'habilidad' => 'required|string|min:10',
        ];
    }
    public static function getRoles()
    {
        return [
            'assault' => 'Asalto',
            'defensive' => 'Defensivo', 
            'support' => 'Apoyo',
            'recon' => 'Reconocimiento'
        ];
    }

    public function getRolNombreAttribute()
    {
        $roles = self::getRoles();
        return $roles[$this->rol] ?? $this->rol;
    }
}