<template>
    <div class="px-4 md:px-12">
        <h1 class="mb-2 text-4xl font-bold tracking-tight text-gray-900">Dashboard</h1>
        <div class="py-2">
            <button class="bg-green-500 px-5 py-2 text-white rounded shadow" @click="openModal">Adicionar
                Tarefa</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-10 items-stretch w-100">
            <div class="w-full md:w-auto md:grow">
                <h2 class="mt-6 text-3xl font-semibold tracking-tight text-gray-700">À Fazer:</h2>
                <div class="mt-4 py-4 flex flex-col space-y-4 rounded-lg">
                    <task-card-component v-for="task in this.tasks.todo" :task_id="task.id" :title="task.title"
                        :description="task.description" :status="task.status"
                        @open-modal="openUpdateModal"></task-card-component>
                </div>
            </div>
            <div class="w-full md:w-auto md:grow">
                <h2 class="mt-6 text-3xl font-semibold tracking-tight text-gray-700">Em Andamento:</h2>
                <div class="mt-4 py-4 flex flex-col space-y-4 rounded-lg">
                    <task-card-component v-for="task in this.tasks.doing" :task_id="task.id" :title="task.title"
                        :description="task.description" :status="task.status"
                        @open-modal="openUpdateModal"></task-card-component>
                </div>
            </div>
            <div class="w-full md:w-auto md:grow">
                <h2 class="mt-6 text-3xl font-semibold tracking-tight text-gray-700">Finalizado:</h2>
                <div class="mt-4 py-4 flex flex-col space-y-4 rounded-lg">
                    <task-card-component v-for="task in this.tasks.done" :task_id="task.id" :title="task.title"
                        :description="task.description" :status="task.status"
                        @open-modal="openUpdateModal"></task-card-component>
                </div>
            </div>
        </div>

        <base-modal-component :modalTitle="(edit_task) ? `Editar tarefa: ${edit_task.title}` : 'Nova tarefa'"
            :modalActive="modalActive" @close-modal="closeModal">
            <task-form-component @close-modal="closeModal" :edit_task="edit_task"></task-form-component>
        </base-modal-component>
    </div>
</template>

<script>
export default {
    data() {
        return {
            modalActive: false,
            edit_task: null
        }
    },
    methods: {
        openModal() {
            this.modalActive = true;
        },
        closeModal() {
            this.edit_task = null;
            this.modalActive = false;
        },
        openUpdateModal(data) {
            this.edit_task = data;
            console.log(data);
            this.openModal();
        }
    },
    created() {
        this.$store.dispatch('loadTasks')
    },
    computed: {
        tasks() {
            return this.$store.getters.tasks
        },
    }
}
</script>