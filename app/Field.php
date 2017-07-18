<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Field
 *
 * @mixin \Eloquent
 * @property int $field_id
 * @property string $name
 * @property int $type
 * @property bool $transformatein
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereFieldId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereTransformatein($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereUpdatedAt($value)
 * @property int $transformation_count
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereTransformationCount($value)
 */
class Field extends Model
{
    protected $fillable = ['name', 'type', 'transformatein'];
}
