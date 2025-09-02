<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Conge
 * 
 * @property int $id
 * @property string $type
 * @property string|null $motif
 * @property Carbon $date_debut
 * @property Carbon|null $date_fin
 * @property string $statut
 * @property int $employe_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employe $employe
 *
 * @package App\Models
 */
class Conge extends Model
{
	protected $table = 'conges';

	protected $casts = [
		'date_debut' => 'datetime',
		'date_fin' => 'datetime',
		'employe_id' => 'int'
	];

	protected $fillable = [
		'type',
		'motif',
		'date_debut',
		'date_fin',
		'statut',
		'employe_id'
	];

	public function employe()
	{
		return $this->belongsTo(Employe::class);
	}
}
