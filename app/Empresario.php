<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresario extends Model
{
    protected $table = 'empresarios';
    protected $fillable = [
    	'nome', 'estado','cidade','telefone','nome_pai', 'pai_empresarial'
    ];

    public function empresarios()
		{
		    return $this->hasMany(self::class, 'pai_empresarial', 'id');
		}
	
		public function parent()
		{
		    return $this->hasMany(self::class,'pai_empresarial', 'id')->with('empresarios');
		}
}
