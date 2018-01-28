<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Client
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class Client extends Model
{

    /**
     * @var string
     */
    protected $table = 'client';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email'
    ];

    /**
     * Carbon date fields.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
