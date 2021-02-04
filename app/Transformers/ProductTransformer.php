<?php

namespace TestPax\Transformers;

use League\Fractal\TransformerAbstract;
use TestPax\Models\Product;

/**
 * Class ProductTransformer.
 *
 * @package namespace TestPax\Transformers;
 */
class ProductTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['category'];
    /**
     * Transform the User entity.
     *
     * @param \TestPax\Models\Product $model
     *
     * @return array
     */
    public function transform(Product $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'description' => $model->description,
            'price' => $model->price,
            /* place your other model properties here */
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeCategory(Product $model)
    {
        return $this->item($model->category, new CategoryTransformer());
    }
}
