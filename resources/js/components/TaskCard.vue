<template>
    <div class="h-auto min-h-60 md:h-60">
        <div class="p-6 bg-white border flex flex-col h-full border-gray-200 rounded-lg shadow" :data-id="task_id">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ title }}</h5>
            <p class="mb-3 font-normal text-gray-700">{{ description }}</p>
            <div class="flex items-center mt-auto ml-auto">
                <button
                    class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    @click="openUpdateModal()">
                    Editar
                </button>
                <button
                    class="px-3 py-2 text-sm font-medium text-center ml-2 text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    @click="deleteTask()">
                    Excluir
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["task_id", "title", "description", "status"],
    methods: {
        async deleteTask() {
            const response = await this.$store.dispatch('deleteTask', this.task_id);
        },
        openUpdateModal() {
            let task_data = {
                id: this.task_id,
                title: this.title,
                description: this.description,
                status: this.status
            }
            this.$emit('open-modal', task_data);
        }
    }
}
</script>