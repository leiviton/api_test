<?php


namespace TestPax\Transformers;

use League\Fractal\TransformerAbstract;
use TestPax\Models\Category;

/**
 * Class CategoryTransformer
 * @package namespace TestPax\Transformers;
 */
class CategoryTransformer extends TransformerAbstract
{

    /**
     * Transform the Category entity
     * @param \TestPax\Models\Category $model
     *
     * @return array
     */
    public function transform(Category $model)
    {
        return [
            'id'         => (int) $model->id,
            'name' => $model->name,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
