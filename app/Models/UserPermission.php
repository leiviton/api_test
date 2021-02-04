<?php

namespace TestPax\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserPermission.
 *
 * @package namespace TestPax\Models;
 */
class UserPermission extends \TestPax\Models\Base\UserPermission implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'permission_id'
    ];

}
