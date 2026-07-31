<?php

namespace App\Actions\Tag;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetTagOptions
{
    public static function handle(User $user): Collection
    {
        /** @var Collection<int, Tag> */
        return $user->tags()->orderBy('name')->get();
    }
}
