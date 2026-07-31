<?php

namespace Database\Seeders;

use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::factory()->count(4)->create();
        $tags = Tag::factory()->count(6)->create();

        Bookmark::factory()
            ->count(10)
            ->recycle($categories)
            ->create()
            ->each(function (Bookmark $bookmark) use ($tags): void {
                $bookmark->tags()->attach(
                    $tags->random(random_int(1, 3))->pluck('id')
                );
            });
    }
}
