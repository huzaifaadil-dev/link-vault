<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetCategoryOptions
{
    public static function handle(User $user): Collection
    {
        /** @var Collection<int, Category> */
        return $user->categories()->orderBy('name')->get();
    }
}
