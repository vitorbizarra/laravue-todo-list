<template>
    <div class="h-auto min-h-60 md:h-60">
        <div class="p-6 bg-white border flex flex-col h-full border-gray-200 rounded-lg shadow" :data-id="task_id">
            <h5 class="mb-2 text-2xl font-bold text-gray-900 break-all">{{ title }}</h5>
            <p class="mb-3 font-normal text-gray-700">{{ description }}</p>
            <div class="flex items-center mt-auto ml-auto space-x-2">
                <button
                    class="px-3 py-2 text-sm font-medium text-indigo-600 bg-wihte border border-indigo-600 rounded-md hover:bg-indigo-600 hover:text-white transition ease-in-out duration-150"
                    @click="openUpdateModal()">
                    Editar
                </button>
                <button
                    class="px-3 py-2 text-sm font-medium text-red-600 bg-wihte border border-red-600 rounded-md hover:bg-red-600 hover:text-white transition ease-in-out duration-150"
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