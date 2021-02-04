<?php

/**
 * Created by Reliese Model.
 */

namespace TestPax\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use TestPax\Models\Product;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Product[] $products
 *
 * @package TestPax\Models\Base
 */
class Category extends Model
{
	protected $table = 'categories';

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
