<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { router } from '@inertiajs/vue3';

interface Category {
    id: number;
    name: string;
}

interface Tag {
    id: number;
    name: string;
}

type PetStatus = 'available' | 'pending' | 'sold';

interface Pet {
    id: number;
    category?: Category;
    name: string;
    photoUrls: string[];
    tags: Tag[];
    status: PetStatus;
}

defineProps({
    pets: {
        type: Array as () => Pet[],
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

    return 'https://placehold.co/400x300/EAEAEA/999999?text=No+Image+Available';
};

const deletePet = (petId: number) => {
    if (confirm('Are you sure you want to delete this pet?')) {
        router.delete(`/pets/${petId}`);
    }
};
</script>

<template>
    <div class="container mx-auto py-8">
        <h1 class="mb-6 text-3xl font-bold">Pets</h1>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <Card v-for="pet in pets" :key="pet.id" class="overflow-hidden">
                <CardHeader>
                    <CardTitle>{{ pet.name || 'Unnamed Pet' }}</CardTitle>
                    <CardDescription>{{ getCategoryName(pet) + 'id: ' + pet.id }}</CardDescription>
                </CardHeader>
                <CardContent>
                    <img :src="getPetImageUrl(pet)" :alt="pet.name" class="mb-4 h-48 w-full rounded-md object-cover" />
                    <Badge>
                        {{ pet.status }}
                    </Badge>
                </CardContent>
                <CardFooter>
                    <Button variant="outline" class="mr-2 w-full">
                        <router-link :to="{ name: 'pets.show', params: { id: pet.id } }"> View Details </router-link>
                    </Button>
                    <Button variant="outline" class="w-full">
                        <router-link :to="{ name: 'pets.edit', params: { id: pet.id } }"> Edit </router-link>
                    </Button>
                    <Button variant="destructive" class="ml-2 w-full" @click="deletePet(pet.id)"> Delete </Button>
                </CardFooter>
            </Card>
        </div>
    </div>
</template>
