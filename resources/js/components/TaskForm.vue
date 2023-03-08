<template>
    <div class="p-6 space-y-6">
        <form ref="newTaskForm" @submit.prevent="submitNewTaskForm($event)">
            <label for="email-address-icon" class="block text-sm font-medium text-gray-900">Título:</label>
            <div class="relative">
                <input type="text" id="email-address-icon"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 mb-4"
                    placeholder="Título" v-model="this.form.title" required>
                <p class="text-sm text-red-400 mb-4" v-if="this.task_errors.title">
                    {{ this.task_errors.title }}
                </p>
            </div>
            <label for="message" class="block text-sm font-medium text-gray-900">Descrição:</label>
            <textarea id="message" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4"
                placeholder="Descrição" v-model="this.form.description" required></textarea>
            <p class="text-sm text-red-400 mb-4" v-if="this.task_errors.description">
                {{ this.task_errors.description }}
            </p>
            <label for="countries" class="block text-sm font-medium text-gray-900">Status</label>
            <select id="countries"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                v-model="this.form.status" required>
                <option value="todo" selected>À Fazer</option>
                <option value="doing">Em Andamento</option>
                <option value="done">Finalizado</option>
            </select>

            <p class="text-sm text-red-400 mb-4" v-if="this.task_errors.status">
                {{ this.task_errors.status }}
            </p>
        </form>

    </div>
    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b ">
        <button type="button" @click="close()"
            class="ml-auto text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancelar</button>
        <button v-if="this.edit_task" type="button" @click="submitUpdateTaskForm"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Atualizar</button>

        <button v-if="!this.edit_task" type="button" @click="submitNewTaskForm"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Cadastrar</button>
    </div>
</template>

<script>

export default {
    props: {
        edit_task: Object
    },
    data() {
        return {
            task_id: (this.edit_task && this.edit_task.id) ? this.edit_task.id : null,
            form: {
                title: (this.edit_task && this.edit_task.title) ? this.edit_task.title : null,
                description: (this.edit_task && this.edit_task.description) ? this.edit_task.description : null,
                status: (this.edit_task && this.edit_task.status) ? this.edit_task.status : 'todo',
            },
            task_errors: {
                title: null,
                description: null,
                status: null,
            }
        }
    },
    methods: {
        async submitNewTaskForm() {
            const response = await this.$store.dispatch('storeTask', this.form);

            this.validateErrors(response);

            if (!response) {
                this.$store.dispatch('loadTasks');
                this.close();
            }
        },
        async submitUpdateTaskForm() {
            let update_data = {
                task_id: this.task_id,
                task_data: this.form
            }

            const response = await this.$store.dispatch('updateTask', update_data);
            this.validateErrors(response);

            if (!response) {
                this.$store.dispatch('loadTasks');
                this.close();
            }
        },
        validateErrors(response) {
            this.task_errors = {
                title: (response && response.errors && response.errors.title && response.errors.title[0]) ? response.errors.title[0] : null,
                description: (response && response.errors && response.errors.description && response.errors.description[0]) ? response.errors.description[0] : null,
                status: (response && response.errors && response.errors.status && response.errors.status[0]) ? response.errors.status[0] : null,
            }
        },
        close() {
            this.$emit('close-modal', false);
        }
    },
}

</script>