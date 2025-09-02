<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pointage
 * 
 * @property int $id
 * @property Carbon $date_pointage
 * @property Carbon $heure_arrivee
 * @property Carbon $heure_depart
 * @property string $statut
 * @property int $employe_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employe $employe
 *
 * @package App\Models
 */
class Pointage extends Model
{
	protected $table = 'pointages';

	protected $casts = [
		'date_pointage' => 'datetime',
		'heure_arrivee' => 'datetime',
		'heure_depart' => 'datetime',
		'employe_id' => 'int'
	];

	protected $fillable = [
		'date_pointage',
		'heure_arrivee',
		'heure_depart',
		'statut',
		'employe_id'
	];

	public function employe()
	{
		return $this->belongsTo(Employe::class);
	}
}
