<script setup lang="ts">
    import Sidebar from "@/components/sdiebar/Sidebar.vue"
</script>

<template>
    <div class="section-sidebar">
        <Sidebar />
    </div>
    <div class="p-4 sm:ml-64">
        <div class="p-4 bg-[white] rounded-lg dark:border-gray-700 shadow">
            <RouterView />
        </div>
    </div>
</template>

<style scoped>

</style>