import type { ColumnDef } from '@tanstack/react-table';
import { Badge } from '@/components/ui/badge';
import type { Category } from '@/types';

export const columns: ColumnDef<Category>[] = [
    {
        accessorKey: 'name',
        header: 'Name',
        cell: ({ row }) => {
            const category = row.original;

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
        accessorKey: 'color',
        header: 'Color',
        cell: ({ row }) => (
            <span className="font-mono text-xs text-muted-foreground">
                {row.original.color}
            </span>
        ),
    },
    {
        accessorKey: 'created_at',
        header: 'Created',
        cell: ({ row }) =>
            new Date(row.original.created_at).toLocaleDateString(),
    },
];
