import { Head, router } from '@inertiajs/react';
import type { PaginationState } from '@tanstack/react-table';
import { Bookmark as BookmarkIcon } from 'lucide-react';
import { useRef } from 'react';
import BookmarksController from '@/actions/App/Http/Controllers/BookmarksController';
import { CreateBookmarkDialogue } from '@/components/bookmarks/create-bookmark-dialogue';
import { DataTable } from '@/components/ui/data-table';
import { EmptyState } from '@/components/ui/empty-state';
import { columns } from '@/pages/bookmarks/columns';
import type {
    Bookmark,
    Category,
    Paginated,
    ResourceCollection,
    Tag,
} from '@/types';

export default function Bookmarks({
    bookmarks,
    categories,
    tags,
}: {
    bookmarks: Paginated<Bookmark>;
    categories?: ResourceCollection<Category>;
    tags?: ResourceCollection<Tag>;
}) {
    const paramsRef = useRef({
        page: bookmarks.meta.current_page,
        per_page: bookmarks.meta.per_page,
    });

    const reloadData = () => {
        router.reload({
            only: ['bookmarks'],
            data: paramsRef.current,
        });
    };

    const handlePaginationChange = (pagination: PaginationState) => {
        paramsRef.current = {
            page: pagination.pageIndex + 1,
            per_page: pagination.pageSize,
        };

        reloadData();
    };

    return (
        <>
            <Head title="Bookmarks" />
            <div className="flex h-full flex-1 flex-col gap-4 p-4">
                <div className="flex items-center justify-end">
                    <CreateBookmarkDialogue
                        categories={categories}
                        tags={tags}
                    />
                </div>

                {bookmarks.meta.total === 0 ? (
                    <EmptyState
                        icon={BookmarkIcon}
                        title="No bookmarks yet"
                        description="Bookmarks you save will show up here."
                    />
                ) : (
                    <DataTable
                        columns={columns}
                        data={bookmarks.data}
                        rowCount={bookmarks.meta.total}
                        pageCount={bookmarks.meta.last_page}
                        pagination={{
                            pageIndex: bookmarks.meta.current_page - 1,
                            pageSize: bookmarks.meta.per_page,
                        }}
                        onPaginationChange={handlePaginationChange}
                        itemLabel="bookmark(s)"
                    />
                )}
            </div>
        </>
    );
}

Bookmarks.layout = {
    breadcrumbs: [
        {
            title: 'Bookmarks',
            href: BookmarksController.index().url,
        },
    ],
};
