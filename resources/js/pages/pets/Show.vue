<script setup lang="ts">
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { router } from '@inertiajs/vue3';

interface Category {
    id: number;
    name: string;
}

interface Tag {
    id: number;
    name: string;
}

interface Pet {
    id: string;
    category?: Category;
    name: string;
    photoUrls: string[];
    tags: Tag[];
    status: string;
}

const props = defineProps({
    pet: {
        type: Object as () => Pet,
        required: true,
    },
});

const getCategoryName = (pet: Pet): string => {
    return pet.category?.name || 'No Category';
};

const invalidUrls = ['string', 'url1'];

const getPetImageUrl = (pet: Pet): string => {
    if (pet.photoUrls && pet.photoUrls.length && pet.photoUrls[0] && !invalidUrls.includes(pet.photoUrls[0])) {
        return pet.photoUrls[0];
    }

    return 'https://placehold.co/600x400/EAEAEA/999999?text=No+Image+Available';
};

const deletePet = (petId: string) => {
    if (confirm('Are you sure you want to delete this pet?')) {
        router.delete(`/pets/${petId}`, {
            onSuccess: () => {
                router.visit(route('pets.index'));
            },
        });
    }
};
</script>

<template>
    <div class="container mx-auto py-8">
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-3xl font-bold">{{ pet.name || 'Unnamed Pet' }}</h1>
            <Button @click="router.visit(route('pets.index'))">Back to List</Button>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
            <Card class="overflow-hidden">
                <CardContent class="p-0">
                    <img :src="getPetImageUrl(pet)" :alt="pet.name" class="h-full w-full object-cover" />
                </CardContent>
            </Card>

            <Card>
                <CardHeader>
                    <CardTitle>Details</CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="space-y-4">
                        <div>
                            <h3 class="font-medium text-gray-500">ID</h3>
                            <p>{{ pet.id }}</p>
                        </div>

                        <div>
                            <h3 class="font-medium text-gray-500">Name</h3>
                            <p>{{ pet.name || 'Unnamed' }}</p>
                        </div>

                        <div>
                            <h3 class="font-medium text-gray-500">Category</h3>
                            <p>{{ getCategoryName(pet) }}</p>
                        </div>

                        <div>
                            <h3 class="font-medium text-gray-500">Status</h3>
                            <Badge>{{ pet.status }}</Badge>
                        </div>

                        <div v-if="pet.tags && pet.tags.length">
                            <h3 class="font-medium text-gray-500">Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                <Badge v-for="tag in pet.tags" :key="tag.id" variant="outline">
                                    {{ tag.name }}
                                </Badge>
                            </div>
                        </div>
                    </div>
                </CardContent>
                <CardFooter class="flex justify-between">
                    <Button variant="outline" @click="router.visit(route('pets.edit', pet.id))"> Edit </Button>
                    <Button variant="destructive" @click="deletePet(pet.id)"> Delete </Button>
                </CardFooter>
            </Card>
        </div>
    </div>
</template>
