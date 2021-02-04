<?php

namespace TestPax\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use TestPax\Models\Base\Category as BaseCategory;

class Category extends BaseCategory implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name'
	];
}
