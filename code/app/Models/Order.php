<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Order
 * @package App\Models
 *
 * @property int $id
 * @property string $number
 * @property int $client_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class Order extends Model
{

    /**
     * @var string
     */
    protected $table = 'order';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'number',
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

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
