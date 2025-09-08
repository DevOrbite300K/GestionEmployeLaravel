<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contrat
 * 
 * @property int $id
 * @property string $type_contrat
 * @property Carbon $date_debut
 * @property Carbon|null $date_fin
 * @property float $salaire_base
 * @property string $statut
 * @property string $fichier
 * @property int $employe_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employe $employe
 *
 * @package App\Models
 */
class Contrat extends Model
{
	protected $table = 'contrats';

	protected $casts = [
		'date_debut' => 'datetime',
		'date_fin' => 'datetime',
		'salaire_base' => 'float',
		'employe_id' => 'int'
	];

	protected $fillable = [
		'type_contrat',
		'date_debut',
		'date_fin',
		'salaire_base',
		'statut',
		'fichier',
		'employe_id'
	];

	public function employe()
	{
		return $this->belongsTo(Employe::class);
	}
}
