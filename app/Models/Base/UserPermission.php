<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 25 Nov 2019 16:38:19 -0200.
 */

namespace TestPax\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserPermission
 * 
 * @property int $id
 * @property int $user_id
 * @property int $permission_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \TestPax\Models\Permission $permission
 * @property \TestPax\Models\User $user
 *
 * @package TestPax\Models\Base
 */
class UserPermission extends Eloquent
{
	protected $casts = [
		'permission_id' => 'int',
		'user_id' => 'int'
	];

	public function permission()
	{
		return $this->belongsTo(\TestPax\Models\Permission::class);
	}

	public function user()
	{
		return $this->belongsTo(\TestPax\Models\User::class);
	}
}
