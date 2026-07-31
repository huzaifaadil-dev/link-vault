import type { ColumnDef } from '@tanstack/react-table';
import { Bookmark as BookmarkIcon, Clock } from 'lucide-react';
import { Badge } from '@/components/ui/badge';
import type { Bookmark } from '@/types';

export const columns: ColumnDef<Bookmark>[] = [
    {
        accessorKey: 'title',
        header: 'Title',
        cell: ({ row }) => {
            const bookmark = row.original;

            return (
                <div className="flex max-w-xs flex-col gap-0.5">
                    <a
                        href={bookmark.url}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="truncate font-medium hover:underline"
                    >
                        {bookmark.title}
                    </a>
                    {bookmark.description && (
                        <span className="truncate text-xs text-muted-foreground">
                            {bookmark.description}
                        </span>
                    )}
                </div>
            );
        },
    },
    {
        accessorKey: 'category',
        header: 'Category',
        cell: ({ row }) => {
            const { category } = row.original;

            return (
                <Badge variant="outline" className="gap-1.5">
                    <span
                        className="size-2 rounded-full"
                        style={{ backgroundColor: category.color }}
                    />
                    {category.name}
                </Badge>
            );
        },
    },
    {
        accessorKey: 'tags',
        header: 'Tags',
        cell: ({ row }) => (
            <div className="flex flex-wrap gap-1">
                {row.original.tags.map((tag) => (
                    <Badge key={tag.id} variant="secondary">
                        {tag.name}
                    </Badge>
                ))}
            </div>
        ),
    },
    {
        id: 'status',
        header: 'Status',
        cell: ({ row }) => {
            const bookmark = row.original;

            return (
                <div className="flex gap-1">
                    {bookmark.is_favorite && (
                        <BookmarkIcon className="size-4 fill-current text-yellow-500" />
                    )}
                    {bookmark.read_later && (
                        <Clock className="size-4 text-blue-500" />
                    )}
                </div>
            );
        },
    },
    {
        accessorKey: 'created_at',
        header: 'Created',
        cell: ({ row }) =>
            new Date(row.original.created_at).toLocaleDateString(),
    },
];
