<script setup lang="ts">
    import { onMounted } from 'vue';
    import { useAdminCategoryStore } from '@/stores/modules/backend/categoryStore';

    const adminCategoryStore = useAdminCategoryStore()

    const handleDeleteCategory = async(id: number) => {
        await adminCategoryStore.onDeleteCategory(id)
    }
    onMounted(async() => {
        await adminCategoryStore.fetchCategories()
    })
</script>

<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="page-header flex justify-between">
            <div class="page-title">
                <h2>All Categories</h2>
            </div>
            <div class="btn-create">
                <RouterLink :to="{name: 'admin.categories.create'}">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Create
                    </button>
                </RouterLink>
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                       ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(category, index) in adminCategoryStore.getCategories" :key="index" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                       {{ category.id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                       {{ category.name }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <RouterLink :to="{name: 'admin.categories.edit', params: {id: category.id}}">
                            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                        </RouterLink>
                        <RouterLink to="" @click="handleDeleteCategory(category.id)">
                            <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                        </RouterLink>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

</template>