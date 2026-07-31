<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name'])]
class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use BelongsToUser, HasFactory;

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(Bookmark::class)->withTimestamps();
    }
}
