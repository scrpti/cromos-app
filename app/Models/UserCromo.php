<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCromo extends Model
{
	protected $fillable = [
		'user_id',
		'grupo',
		'seleccion',
		'numero',
		'cantidad',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
