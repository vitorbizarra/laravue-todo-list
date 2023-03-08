<template>
    <Transition name="modal-outer">
        <div v-show="modalActive" id="defaultModal" tabindex="-1" aria-hidden="true"
            class="fixed flex top-0 left-0 right-0 z-50 w-full h-full bg-black/50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal">

            <Transition name="modal-inner">
                <div v-if="modalActive" class="relative flex w-full m-auto h-full max-w-2xl md:h-auto">
                    <div class="relative bg-white rounded-lg shadow m-auto w-full">
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ modalTitle }}
                            </h3>
                            <button type="button" @click="$emit('close-modal')"
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
                        <slot />
                    </div>
                </div>
            </Transition>

        </div>
    </Transition>
</template>
  
<script setup>
defineEmits(["close-modal"]);
defineProps({
    modalTitle: {
        type: String,
        default: '',
    },
    modalActive: {
        type: Boolean,
        default: false
    }
})
</script>

<style scoped>
.modal-outer-enter-active,
.modal-outer-leave-active {
    transition: opacity 0.3s cubic-bezier(0.52, 0.02, 0.19, 1.02);
}

.modal-outer-enter-from,
.modal-outer-leave-to{
    opacity: 0;
}

.modal-inner-enter-active {
    transition: all 0.3s cubic-bezier(0.52, 0..02, 0.19, 1.02) 0.15s;
}
.modal-inner-leave-active {
    transition: all 0.3s cubic-bezier(0.52, 0..02, 0.19, 1.02);
}

.modal-inner-enter-from{
    opacity: 0;
    transform: scale(0.8);
}

.modal-inner-leave-to{
    transform: scale(0.8);
}

</style>
  