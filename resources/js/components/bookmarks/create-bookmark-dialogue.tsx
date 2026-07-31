import { Form } from '@inertiajs/react';
import { useState } from 'react';
import BookmarksController from '@/actions/App/Http/Controllers/BookmarksController';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { Skeleton } from '@/components/ui/skeleton';
import { Textarea } from '@/components/ui/textarea';
import type { Category, ResourceCollection, Tag } from '@/types';

export function CreateBookmarkDialogue({
    categories,
    tags,
}: {
    categories?: ResourceCollection<Category>;
    tags?: ResourceCollection<Tag>;
}) {
    const [open, setOpen] = useState(false);

    return (
        <Dialog open={open} onOpenChange={setOpen}>
            <DialogTrigger asChild>
                <Button>Create bookmark</Button>
            </DialogTrigger>
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Create bookmark</DialogTitle>
                </DialogHeader>

                <Form
                    {...BookmarksController.store.form()}
                    resetOnSuccess
                    onSuccess={() => setOpen(false)}
                    className="space-y-4"
                >
                    {({ processing, errors, resetAndClearErrors }) => (
                        <>
                            <div className="grid gap-2">
                                <Label htmlFor="title">Title</Label>
                                <Input id="title" name="title" required />
                                <InputError message={errors.title} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="url">URL</Label>
                                <Input
                                    id="url"
                                    name="url"
                                    type="url"
                                    required
                                />
                                <InputError message={errors.url} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="description">Description</Label>
                                <Textarea id="description" name="description" />
                                <InputError message={errors.description} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="category_id">Category</Label>
                                {!categories ? (
                                    <Skeleton className="h-9 w-full" />
                                ) : (
                                    <Select name="category_id">
                                        <SelectTrigger
                                            id="category_id"
                                            className="w-full"
                                        >
                                            <SelectValue placeholder="Select a category" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            {categories.data.map((category) => (
                                                <SelectItem
                                                    key={category.id}
                                                    value={`${category.id}`}
                                                >
                                                    {category.name}
                                                </SelectItem>
                                            ))}
                                        </SelectContent>
                                    </Select>
                                )}
                                <InputError message={errors.category_id} />
                            </div>

                            <div className="grid gap-2">
                                <Label>Tags</Label>
                                {!tags ? (
                                    <Skeleton className="h-9 w-full" />
                                ) : (
                                    <div className="flex flex-wrap gap-3">
                                        {tags.data.map((tag) => (
                                            <label
                                                key={tag.id}
                                                htmlFor={`tag-${tag.id}`}
                                                className="flex items-center gap-2 text-sm"
                                            >
                                                <Checkbox
                                                    id={`tag-${tag.id}`}
                                                    name="tags[]"
                                                    value={`${tag.id}`}
                                                />
                                                {tag.name}
                                            </label>
                                        ))}
                                    </div>
                                )}
                                <InputError message={errors.tags} />
                            </div>

                            <div className="flex items-center gap-6">
                                <label className="flex items-center gap-2 text-sm">
                                    <Checkbox name="is_favorite" value="1" />
                                    Favorite
                                </label>
                                <label className="flex items-center gap-2 text-sm">
                                    <Checkbox name="read_later" value="1" />
                                    Read later
                                </label>
                            </div>

                            <DialogFooter className="gap-2">
                                <DialogClose asChild>
                                    <Button
                                        type="button"
                                        variant="secondary"
                                        onClick={() => resetAndClearErrors()}
                                    >
                                        Cancel
                                    </Button>
                                </DialogClose>

                                <Button disabled={processing} type="submit">
                                    Create bookmark
                                </Button>
                            </DialogFooter>
                        </>
                    )}
                </Form>
            </DialogContent>
        </Dialog>
    );
}
