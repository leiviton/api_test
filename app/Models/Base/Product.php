<?php

/**
 * Created by Reliese Model.
 */

namespace TestPax\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use TestPax\Models\Category;

/**
 * Class Product
 * 
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 *
 * @package TestPax\Models\Base
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'category_id' => 'int',
		'price' => 'float'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}
}
