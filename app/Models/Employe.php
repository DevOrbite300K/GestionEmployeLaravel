<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasPermissions;
use App\Models\Departement;
use App\Models\Poste;
use App\Models\Document;
use App\Models\Contrat;
use App\Models\Conge;
use App\Models\Pointage;
use App\Models\Paiement;

/**
 * Class Employe
 * 
 * @property int $id
 * @property string $nom
 * @property string|null $prenom
 * @property string|null $telephone
 * @property string $email
 * @property string|null $sexe
 * @property string $password
 * @property string|null $adresse
 * @property string|null $matricule
 * @property Carbon|null $date_naissance
 * @property Carbon|null $date_embauche
 * @property string|null $photo
 * @property bool $est_responsable
 * @property int|null $departement_id
 * @property int|null $poste_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Departement|null $departement
 * @property Poste|null $poste
 * @property Document[]|null $documents
 * @property Contrat[]|null $contrats
 * @property Conge[]|null $conges
 * @property Pointage[]|null $pointages
 * @property Paiement[]|null $paiements
 *
 * @package App\Models
 */
class Employe extends Authenticatable
{
	use HasFactory, Notifiable;
	use HasRoles;


	protected $table = 'employes';

	protected $casts = [
		'date_naissance' => 'datetime',
		'date_embauche' => 'datetime',
		'departement_id' => 'int',
		'poste_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nom',
		'prenom',
		'telephone',
		'email',
		'sexe',
		'password',
		'adresse',
		'matricule',
		'date_naissance',
		'date_embauche',
		'photo',
		'departement_id',
		'poste_id',
		'est_responsable'
	];

	public function departement()
	{
		return $this->belongsTo(Departement::class);
	}

	public function poste()
	{
		return $this->belongsTo(Poste::class);
	}

	public function documents()
    {
        return $this->hasMany(Document::class);
    }

	public function contrats()
	{
		return $this->hasMany(Contrat::class);
	}

	public function conges()
	{
		return $this->hasMany(Conge::class);
	}

	public function pointages()
	{
		return $this->hasMany(Pointage::class);
	}

	public function paiements()
	{
		return $this->hasMany(Paiement::class);
	}

}
