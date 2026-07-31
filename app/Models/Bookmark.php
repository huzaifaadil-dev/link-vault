<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Database\Factories\BookmarkFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['title', 'url', 'description', 'category_id', 'is_favorite', 'read_later'])]
class Bookmark extends Model
{
    /** @use HasFactory<BookmarkFactory> */
    use BelongsToUser, HasFactory;

    protected function casts(): array
    {
        return [
            'is_favorite' => 'boolean',
            'read_later' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
