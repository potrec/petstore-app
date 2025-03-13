<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Category {
    id: number;
    name: string;
}

interface Tag {
    id: number;
    name: string;
}

const form = useForm({
    name: '',
    status: 'available',
    category: {
        id: 1,
        name: '',
    },
    photoUrls: [''],
    tags: [] as Tag[],
});

const newTag = ref({
    id: 1,
    name: '',
});

const addTag = () => {
    if (newTag.value.name.trim()) {
        form.tags.push({ ...newTag.value });
        newTag.value.name = '';
        newTag.value.id++;
    }
};

const removeTag = (index: number) => {
    form.tags.splice(index, 1);
};

const submit = () => {
    form.post(route('pets.store'), {
        onSuccess: () => {
            router.visit(route('pets.index'));
        },
    });
};
</script>

<template>
    <div class="container mx-auto py-8">
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-3xl font-bold">Add New Pet</h1>
            <Button @click="router.visit(route('pets.index'))">Cancel</Button>
        </div>

        <Card>
            <CardHeader>
                <CardTitle>Pet Information</CardTitle>
                <CardDescription>Enter the details for the new pet</CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="space-y-2">
                        <Label for="name">Name</Label>
                        <Input id="name" v-model="form.name" type="text" class="w-full" />
                    </div>

                    <div class="space-y-2">
                        <Label for="status">Status</Label>
                        <Select v-model="form.status">
                            <SelectTrigger>
                                <SelectValue placeholder="Select status" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="available">Available</SelectItem>
                                <SelectItem value="pending">Pending</SelectItem>
                                <SelectItem value="sold">Sold</SelectItem>
                            </SelectContent>
                        </Select>
                        <div v-if="form.errors.status" class="text-sm text-red-500">{{ form.errors.status }}</div>
                    </div>

                    <div class="space-y-2">
                        <Label for="category">Category</Label>
                        <Input id="category" v-model="form.category.name" type="text" class="w-full" />
                        <div v-if="form.errors['category.name']" class="text-sm text-red-500">{{ form.errors['category.name'] }}</div>
                    </div>

                    <div class="space-y-2">
                        <Label for="photoUrl">Photo URL</Label>
                        <Input id="photoUrl" v-model="form.photoUrls[0]" type="text" class="w-full" />
                        <div v-if="form.errors.photoUrls" class="text-sm text-red-500">{{ form.errors.photoUrls }}</div>
                    </div>

                    <div class="space-y-2">
                        <Label>Tags</Label>
                        <div class="flex space-x-2">
                            <Input v-model="newTag.name" type="text" class="w-full" placeholder="Add a tag" />
                            <Button type="button" @click="addTag">Add</Button>
                        </div>

                        <div class="mt-2 flex flex-wrap gap-2">
                            <div v-for="(tag, index) in form.tags" :key="index" class="flex items-center rounded-full bg-gray-600 px-3 py-1">
                                {{ tag.name }}
                                <button type="button" @click="removeTag(index)" class="ml-2 text-red-500 hover:text-red-700">&times;</button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <Button type="submit" :disabled="form.processing">Save Pet</Button>
                    </div>
                    <div v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
