<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Employe;


/**
 * Class Document
 * 
 * @property int $id
 * @property string $nom
 * @property string $type
 * @property string|null $typefichier
 * @property string|null $description
 * @property string|null $chemin
 * @property int $employe_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employe $employe
 *
 * @package App\Models
 */
class Document extends Model
{
	protected $table = 'documents';

	protected $casts = [
		'employe_id' => 'int'
	];

	protected $fillable = [
		'nom',
		'type',
		'typefichier',
		'description',
		'chemin',
		'employe_id'
	];

	public function employe()
	{
		return $this->belongsTo(Employe::class);
	}
}
