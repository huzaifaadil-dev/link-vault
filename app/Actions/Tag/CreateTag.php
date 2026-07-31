<?php

namespace App\Actions\Tag;

use App\Data\TagData;
use App\Models\Tag;
use App\Models\User;

class CreateTag
{
    public static function handle(TagData $data, User $user): Tag
    {
        return $user->tags()->create($data->toArray());
    }
}
