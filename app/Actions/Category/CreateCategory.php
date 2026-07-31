<?php

namespace App\Actions\Category;

use App\Data\CategoryData;
use App\Models\Category;
use App\Models\User;

class CreateCategory
{
    public static function handle(CategoryData $data, User $user): Category
    {
        return $user->categories()->create($data->toArray());
    }
}
