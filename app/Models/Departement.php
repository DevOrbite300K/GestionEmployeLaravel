<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employe;

/**
 * Class Departement
 * 
 * @property int $id
 * @property string $nom
 * @property Carbon|null $date_creation
 * @property string $emplacement
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Departement extends Model
{
	protected $table = 'departements';

	protected $casts = [
		'date_creation' => 'datetime'
	];

	protected $fillable = [
		'nom',
		'date_creation',
		'emplacement'
	];


	public function employes()
	{
		return $this->hasMany(Employe::class, 'departement_id');
	}

}
