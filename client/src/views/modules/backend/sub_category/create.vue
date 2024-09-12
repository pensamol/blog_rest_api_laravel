<script setup lang="ts">
    import { onMounted } from 'vue';
    import { useAdminSubCategoryStore } from '@/stores/modules/backend/subCategoryStore';
    import { useAdminCategoryStore } from '@/stores/modules/backend/categoryStore';

    const adminSubCategoryStore = useAdminSubCategoryStore()
    const adminCategoryStore = useAdminCategoryStore()

    const handleSaveSubCategory = async() => {
        await adminSubCategoryStore.onSaveSubCategory()
    }
    onMounted(async() => {
        await adminCategoryStore.fetchCategories()
    })
</script>

<template>
    <div class="relative overflow-x-auto sm:rounded-lg">
        <div class="page-header flex justify-between">
            <div class="page-title">
                <h2>Create Sub Category</h2>
            </div>
            <div class="btn-create">
                <RouterLink :to="{name: 'admin.subcategories.index'}">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        back
                    </button>
                </RouterLink>
            </div>
        </div>
       <div class="form">
            <form method="post" @submit.prevent="handleSaveSubCategory">
                <div class="grid md:grid-cols-1 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="name" v-model="adminSubCategoryStore.formData.name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Sub Category name</label>
                    </div>
                </div>
                <div class="grid md:grid-cols-1 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category_id" v-model="adminSubCategoryStore.formData.category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option style="display: none;">Choose a Category</option>
                            <option v-for="(category, index) in adminCategoryStore.getCategories" :value="category.id" :key="index">{{category.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="btn-submit">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Save
                    </button>
                </div>
            </form>

       </div>
    </div>

</template>