<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class BookmarkData extends Data
{
    public function __construct(
        public string $title,
        public string $url,
        public int $category_id,
        public bool $is_favorite,
        public bool $read_later,
        /** @var int[] */
        public array $tags,
        public ?string $description = null,
    ) {}
}
