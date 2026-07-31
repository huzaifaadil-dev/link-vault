<?php

namespace App\Actions\Bookmark;

use App\Data\BookmarkData;
use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateBookmark
{
    public static function handle(BookmarkData $data, User $user): Bookmark
    {
        return DB::transaction(function () use ($data, $user) {
            $bookmark = $user->bookmarks()->create($data->toArray());

            $bookmark->tags()->sync($data->tags);

            return $bookmark;
        });
    }
}
