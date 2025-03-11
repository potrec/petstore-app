<script setup lang="ts">

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
    category: Category;
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
</script>

<template>
    <div>
        <h1>Pets</h1>
        <ul>
            <li v-for="pet in pets" :key="pet.id">
                <router-link :to="{ name: 'pets.show', params: { id: pet.id } }">
                    {{ pet.name }}
                </router-link>
            </li>
        </ul>
    </div>
</template>
