<?php

namespace TestPax\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use TestPax\Models\Base\Product as BaseProduct;

class Product extends BaseProduct implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'category_id',
		'name',
		'description',
		'price'
	];
}
