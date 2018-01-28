<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Ticket
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $note
 * @property int $order_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class Ticket extends Model
{

    /**
     * @var string
     */
    protected $table = 'ticket';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'note',
        'order_id'
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

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
}
