# LinkVault - Database Structure

## Tables

### bookmarks
| Column        | Type      | Notes                          |
|---------------|-----------|---------------------------------|
| id            | bigint    | Primary key                     |
| title         | string    |                                  |
| url           | string    |                                  |
| description   | text      | Nullable                        |
| category_id   | bigint    | Foreign key -> categories.id    |
| is_favorite   | boolean   | Default: false                  |
| read_later    | boolean   | Default: false                  |
| created_at    | timestamp |                                  |
| updated_at    | timestamp |                                  |

### categories
| Column     | Type      | Notes            |
|------------|-----------|------------------|
| id         | bigint    | Primary key      |
| name       | string    |                  |
| color      | string    |                  |
| created_at | timestamp |                  |
| updated_at | timestamp |                  |

### tags
| Column     | Type      | Notes            |
|------------|-----------|------------------|
| id         | bigint    | Primary key      |
| name       | string    |                  |
| created_at | timestamp |                  |
| updated_at | timestamp |                  |

### bookmark_tag (pivot table)
| Column       | Type   | Notes                          |
|--------------|--------|---------------------------------|
| bookmark_id  | bigint | Foreign key -> bookmarks.id    |
| tag_id       | bigint | Foreign key -> tags.id         |

---

## Relationships

- **Category** hasMany **Bookmarks**
- **Bookmark** belongsTo **Category**
- **Bookmark** belongsToMany **Tags** (via bookmark_tag)
- **Tag** belongsToMany **Bookmarks** (via bookmark_tag)

## Eloquent Model Notes

**Bookmark**
```php
public function category() {
    return $this->belongsTo(Category::class);
}

public function tags() {
    return $this->belongsToMany(Tag::class);
}
```

**Category**
```php
public function bookmarks() {
    return $this->hasMany(Bookmark::class);
}
```

**Tag**
```php
public function bookmarks() {
    return $this->belongsToMany(Bookmark::class);
}
```
