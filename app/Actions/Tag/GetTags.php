<?php

namespace App\Actions\Tag;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class GetTags
{
    public static function handle(User $user, int $perPage): LengthAwarePaginator
    {
        return $user->tags()
            ->latest()
            ->paginate($perPage);
    }
}
