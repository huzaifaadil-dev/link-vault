import { Head, router } from '@inertiajs/react';
import type { PaginationState } from '@tanstack/react-table';
import { Tag as TagIcon } from 'lucide-react';
import { useRef } from 'react';
import TagsController from '@/actions/App/Http/Controllers/TagsController';
import { DataTable } from '@/components/ui/data-table';
import { EmptyState } from '@/components/ui/empty-state';
import { columns } from '@/pages/tags/columns';
import type { Paginated, Tag } from '@/types';

export default function Tags({ tags }: { tags: Paginated<Tag> }) {
    const paramsRef = useRef({
        page: tags.meta.current_page,
        per_page: tags.meta.per_page,
    });

    const reloadData = () => {
        router.reload({
            only: ['tags'],
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
            <Head title="Tags" />
            <div className="flex h-full flex-1 flex-col gap-4 p-4">
                {tags.meta.total === 0 ? (
                    <EmptyState
                        icon={TagIcon}
                        title="No tags yet"
                        description="Tags you create will show up here."
                    />
                ) : (
                    <DataTable
                        columns={columns}
                        data={tags.data}
                        rowCount={tags.meta.total}
                        pageCount={tags.meta.last_page}
                        pagination={{
                            pageIndex: tags.meta.current_page - 1,
                            pageSize: tags.meta.per_page,
                        }}
                        onPaginationChange={handlePaginationChange}
                        itemLabel="tag(s)"
                    />
                )}
            </div>
        </>
    );
}

Tags.layout = {
    breadcrumbs: [
        {
            title: 'Tags',
            href: TagsController.index().url,
        },
    ],
};
