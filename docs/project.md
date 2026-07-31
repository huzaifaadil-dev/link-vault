# LinkVault - Project Plan

Single-user bookmark manager built with Laravel, React, and Inertia.

## Tech Stack
- Laravel
- React
- Inertia.js
- Tailwind CSS
- SQLite/MySQL

---

## Phase 1 - Authentication
1. Login
2. Register
3. Logout

## Phase 2 - Bookmark CRUD
1. Bookmark fields: Title, URL, Description, Category, Tags, Favorite, Read Later, Created At
2. Create bookmark
3. Read/List bookmarks
4. Update bookmark
5. Delete bookmark

## Phase 3 - Categories
1. Create category
2. Read/List categories
3. Update category
4. Delete category

## Phase 4 - Tags
1. Create tag
2. Read/List tags
3. Update tag
4. Delete tag
5. Many-to-many relationship with bookmarks

## Phase 5 - Search
1. Search by Title
2. Search by URL
3. Search by Description

## Phase 6 - Filters
1. Filter by Category
2. Filter by Tag
3. Filter by Favorite
4. Filter by Read Later

## Phase 7 - Favorites
1. Mark/unmark bookmark as favorite
2. Favorites count on dashboard

## Phase 8 - Read Later
1. Mark/unmark bookmark as read later
2. Read Later count on dashboard

## Phase 9 - Dashboard
1. Total bookmarks stat
2. Favorites stat
3. Read Later stat
4. Recent bookmarks list

## Phase 10 - UI Polish
1. Responsive layout pass
2. Accessibility pass
3. Reusable components: BookmarkCard, BookmarkForm, SearchBar, TagBadge, CategoryBadge, StatsCard, EmptyState

---

## Pages
- /dashboard
- /bookmarks
- /bookmarks/create
- /bookmarks/{id}/edit
- /categories
- /tags
- /profile

## Future Enhancements (post-MVP, do not build until MVP complete)
- Auto-fetch page title
- Favicon
- Meta description
- Duplicate detection
- Import/export
- Pin bookmarks
- Dark mode
- Keyboard shortcuts

## Guidelines for AI Coding Assistant
- Build incrementally, one phase at a time.
- Follow Laravel best practices.
- Keep controllers thin; business logic in services/actions.
- Use Form Requests for validation.
- Use Eloquent relationships.
- Use Inertia for page rendering.
- Build reusable React components.
- Prefer responsive, accessible UI.
- Do not implement future enhancements until the MVP is complete.
