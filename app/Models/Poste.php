<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employe;

/**
 * Class Poste
 * 
 * @property int $id
 * @property string $titre
 * @property string $description
 * @property float $salaire_base
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Poste extends Model
{
	protected $table = 'postes';

	protected $casts = [
		'salaire_base' => 'float'
	];

	protected $fillable = [
		'titre',
		'description',
		'salaire_base'
	];

	public function employes()
	{
		return $this->hasMany(Employe::class, 'poste_id');
	}
}
