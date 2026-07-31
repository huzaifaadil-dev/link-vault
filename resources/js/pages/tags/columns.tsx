import type { ColumnDef } from '@tanstack/react-table';
import { Badge } from '@/components/ui/badge';
import type { Tag } from '@/types';

export const columns: ColumnDef<Tag>[] = [
    {
        accessorKey: 'name',
        header: 'Name',
        cell: ({ row }) => (
            <Badge variant="secondary">{row.original.name}</Badge>
        ),
    },
    {
        accessorKey: 'created_at',
        header: 'Created',
        cell: ({ row }) =>
            new Date(row.original.created_at).toLocaleDateString(),
    },
];
