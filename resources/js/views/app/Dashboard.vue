<template>
    <h1 class="mb-2 text-4xl font-bold px-6 tracking-tight text-gray-900">Dashboard</h1>
    <div class="px-6 py-2">
        <button class="bg-green-500 px-5 py-2 text-white rounded shadow" @click="toggleNewTaskModal">Adicionar
            Tarefa</button>
    </div>
    <div class="grid grid-cols-3 gap-x-10 items-stretch w-100 px-6">
        <div class="w-100 grow">
            <h2 class="mt-6 text-3xl font-semibold tracking-tight text-gray-700">À Fazer:</h2>
            <div class="mt-4 py-4 flex flex-col space-y-4 rounded-lg">
                <task-card-component v-for="task in this.tasks.todo" :task_id="task.id" :title="task.title"
                    :description="task.description"></task-card-component>
            </div>
        </div>
        <div class="w-100 grow">
            <h2 class="mt-6 text-3xl font-semibold tracking-tight text-gray-700">Em Andamento:</h2>
            <div class="mt-4 py-4 flex flex-col space-y-4 rounded-lg">
                <task-card-component v-for="task in this.tasks.doing" :task_id="task.id" :title="task.title"
                    :description="task.description"></task-card-component>
            </div>
        </div>
        <div class="w-100 grow">
            <h2 class="mt-6 text-3xl font-semibold tracking-tight text-gray-700">Finalizado:</h2>
            <div class="mt-4 py-4 flex flex-col space-y-4 rounded-lg">
                <task-card-component v-for="task in this.tasks.done" :task_id="task.id" :title="task.title"
                    :description="task.description"></task-card-component>
            </div>
        </div>
    </div>
    <task-form-modal-component v-if="newTaskModalStatus"></task-form-modal-component>
</template>

<script>
export default {
    methods: {
        toggleNewTaskModal() {
            this.$store.dispatch('toggleNewTaskModal')
        }
    },
    created() {
        this.$store.dispatch('loadTasks')
    },
    computed: {
        tasks() {
            return this.$store.getters.tasks
        },
        newTaskModalStatus() {
            return this.$store.getters.newTaskModalStatus;
        }
    }
}
</script>