<template>
    <div id="defaultModal" tabindex="-1" aria-hidden="true"
        class="fixed flex top-0 left-0 right-0 z-50 w-full bg-black/50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full m-auto h-full max-w-2xl md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Adicionar tarefa
                    </h3>
                    <button type="button" @click="toggleModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                        data-modal-hide="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form ref="newTaskForm" @submit.prevent="submitNewTaskForm($event)">
                        <label for="email-address-icon" class="block text-sm font-medium text-gray-900">Título:</label>
                        <div class="relative">
                            <input type="text" id="email-address-icon"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 mb-4"
                                placeholder="Título" v-model="this.form.title" required>

                            <p class="text-sm text-red-400 mb-4" v-if="this.task_errors.title">
                                {{ this.task_errors.title[0] }}
                            </p>
                        </div>
                        <label for="message" class="block text-sm font-medium text-gray-900">Descrição:</label>
                        <textarea id="message" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-4"
                            placeholder="Descrição" v-model="this.form.description" required></textarea>
                        <p class="text-sm text-red-400 mb-4" v-if="this.task_errors.description">
                            {{ this.task_errors.description[0] }}
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
                            {{ this.task_errors.status[0] }}
                        </p>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b ">
                    <button type="button" @click="toggleModal"
                        class="ml-auto text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancelar</button>
                    <button type="button" @click="submitNewTaskForm"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Adicionar</button>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>

export default {
    data() {
        return {
            form: {
                title: null,
                description: null,
                status: 'todo',
            },
            task_errors: {
                title: null,
                description: null,
                status: null,
            }
        }
    },
    methods: {
        toggleModal() {
            this.$store.dispatch('toggleModal')
        },
        async submitNewTaskForm() {
            const response = await this.$store.dispatch('storeTask', this.form);
            this.$store.dispatch('loadTasks');
            this.task_errors = {
                title: null,
                description: null,
                status: null,
            }
            if (!response) {
                this.$store.dispatch('toggleModal');
            }
            
            if (response) {
                console.log(response);
                this.task_errors = response.errors;
            }
        }
    },
}

</script>
  