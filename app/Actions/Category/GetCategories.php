<?php

namespace App\Actions\Category;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class GetCategories
{
    public static function handle(User $user, int $perPage): LengthAwarePaginator
    {
        return $user->categories()
            ->latest()
            ->paginate($perPage);
    }
}
