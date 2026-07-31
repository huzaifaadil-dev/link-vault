import { Head, router } from '@inertiajs/react';
import type { PaginationState } from '@tanstack/react-table';
import { FolderOpen } from 'lucide-react';
import { useRef } from 'react';
import CategoriesController from '@/actions/App/Http/Controllers/CategoriesController';
import { DataTable } from '@/components/ui/data-table';
import { EmptyState } from '@/components/ui/empty-state';
import { columns } from '@/pages/categories/columns';
import type { Category, Paginated } from '@/types';

export default function Categories({
    categories,
}: {
    categories: Paginated<Category>;
}) {
    const paramsRef = useRef({
        page: categories.meta.current_page,
        per_page: categories.meta.per_page,
    });

    const reloadData = () => {
        router.reload({
            only: ['categories'],
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
            <Head title="Categories" />
            <div className="flex h-full flex-1 flex-col gap-4 p-4">
                {categories.meta.total === 0 ? (
                    <EmptyState
                        icon={FolderOpen}
                        title="No categories yet"
                        description="Categories you create will show up here."
                    />
                ) : (
                    <DataTable
                        columns={columns}
                        data={categories.data}
                        rowCount={categories.meta.total}
                        pageCount={categories.meta.last_page}
                        pagination={{
                            pageIndex: categories.meta.current_page - 1,
                            pageSize: categories.meta.per_page,
                        }}
                        onPaginationChange={handlePaginationChange}
                        itemLabel="category(s)"
                    />
                )}
            </div>
        </>
    );
}

Categories.layout = {
    breadcrumbs: [
        {
            title: 'Categories',
            href: CategoriesController.index().url,
        },
    ],
};
