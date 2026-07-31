export type Category = {
    id: number;
    name: string;
    color: string;
};

export type Tag = {
    id: number;
    name: string;
};

export type Bookmark = {
    id: number;
    title: string;
    url: string;
    description: string | null;
    is_favorite: boolean;
    read_later: boolean;
    created_at: string;
    category: Category;
    tags: Tag[];
};

export type Paginated<T> = {
    data: T[];
    meta: {
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
};
