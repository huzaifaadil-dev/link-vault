<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'color'])]
class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use BelongsToUser, HasFactory;

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }
}
