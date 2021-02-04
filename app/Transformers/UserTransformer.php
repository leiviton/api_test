<?php

namespace TestPax\Transformers;

use League\Fractal\TransformerAbstract;
use TestPax\Models\User;
use DateTime;

/**
 * Class UserTransformer.
 *
 * @package namespace TestPax\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    /**
     * Transform the User entity.
     *
     * @param \TestPax\Models\User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'email' => $model->email,
            'role' => $model->role,
            /* place your other model properties here */
            'last_login_at' => $model->last_login_at,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    private function formatDate($data)
    {
        $d = new DateTime($data);
        return $d->format('Y-m-d');
    }
}
