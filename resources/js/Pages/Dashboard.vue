<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                HS - Aplikacja rekrutacyjna - Piotr Świderski
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="mb-4 w-full p-8 flex justify-center">
                        <inertia-link class="flex items-center group py-3 max-w-md" :href="route('get-characters')">
                            <icon name="dashboard" class="w-4 h-4 mr-2" :class="'fill-grey-400 group-hover:fill-black'" />
                            <div :class="'text-grey-300 group-hover:text-black'">SWAPI characters</div>
                        </inertia-link>
                    </div>
                </div>
            </div>
        </div>

    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'

    export default {
        components: {
            BreezeAuthenticatedLayout,
        },
    }
</script>
