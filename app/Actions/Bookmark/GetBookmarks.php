<?php

namespace App\Actions\Bookmark;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class GetBookmarks
{
    public static function handle(User $user, int $perPage): LengthAwarePaginator
    {
        return $user->bookmarks()
            ->with(['category', 'tags'])
            ->latest()
            ->paginate($perPage);
    }
}
