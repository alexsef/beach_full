<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Order
 *
 * @property int $order_id
 * @property int $user_id
 * @property int $field_id
 * @property string $reserved_from
 * @property int $field_as
 * @property bool $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereFieldId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereReservedFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereFieldAs($value)
 */
class Order extends Model
{
    protected $fillable = [
        'user_id', 'field_id', 'field_as', 'reserved_from', 'reserved_to'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function field() {
        return $this->belongsTo('App\Field', 'field_id', 'field_id');
    }
}
