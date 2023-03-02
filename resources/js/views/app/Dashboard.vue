<template>
    <h1 class="mb-2 text-4xl font-bold px-6 tracking-tight text-gray-900">Dashboard</h1>
    <div class="flex flex-nowrap w-100 px-6 space-x-36">
        <div class="w-100 grow" >
            <h2 class="mt-6 text-3xl font-semibold tracking-tight text-gray-700">À Fazer:</h2>
            <div class="mt-4 py-4 px-4 flex flex-col space-y-4 rounded-lg">
                <div v-for="task in this.tasks">
                    <task-card-component title="teste de título" description="descricao de teste" task_id="1"></task-card-component>
                </div>
            </div>
        </div>
        <div class="w-100 grow" >
            <h2 class="mt-6 text-3xl font-semibold tracking-tight text-gray-700">Em Andamento:</h2>
            <div class="mt-4 py-4 px-4 flex flex-col space-y-4 rounded-lg">
                <div v-for="task in this.tasks">
                    <task-card-component title="teste de título" description="descricao de teste" task_id="2"></task-card-component>
                </div>
            </div>
        </div>
        <div class="w-100 grow" >
            <h2 class="mt-6 text-3xl font-semibold tracking-tight text-gray-700">Finalizado:</h2>
            <div class="mt-4 py-4 px-4 flex flex-col space-y-4 rounded-lg">
                <div v-for="task in this.tasks">
                    <task-card-component title="teste de título" description="descricao de teste" task_id="3"></task-card-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tasks: null
        }
    },
    methods: {
        async getTasks() {
            const res = await this.$store.dispatch('loadTasks');
            console.log(res);
            this.tasks = res; 
        }
    },
    mounted() {
        this.getTasks();
    }
}
</script>