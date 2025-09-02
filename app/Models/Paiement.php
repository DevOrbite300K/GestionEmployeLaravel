<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Paiement
 * 
 * @property int $id
 * @property Carbon $date_paiement
 * @property float $montant
 * @property string $type_paiement
 * @property string $mode_paiement
 * @property int $employe_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employe $employe
 *
 * @package App\Models
 */
class Paiement extends Model
{
	protected $table = 'paiements';

	protected $casts = [
		'date_paiement' => 'datetime',
		'montant' => 'float',
		'employe_id' => 'int'
	];

	protected $fillable = [
		'date_paiement',
		'montant',
		'type_paiement',
		'mode_paiement',
		'employe_id'
	];

	public function employe()
	{
		return $this->belongsTo(Employe::class);
	}
}
