<template>
    <div class="inset-0 flex items-center justify-center">
        <button type="button" @click="openModal"
            class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded  mb-9">
            Add an Off Day!
        </button>
    </div>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" class="relative z-10" :key="docAdd">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">

                            <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mb-9">
                                    <div class="order-1 lg:order-1">
                                        Add a day off!
                                    </div>
                                    <div class="order-2 lg:order-2 ">
                                        <button type="button" class="float-right" @click="closeModal()"> X
                                        </button>
                                    </div>

                                </div>
                            </DialogTitle>
                            <div class="col-span-3">
                                <label for="dates" class="block text-sm font-medium text-gray-700">Pick a Date
                                </label>
                                <TInput type="date" name="date_of_birth" :errors="errors" placeholder="dd/mm/yyyy"
                                    @change="pickedDate($event.target.value)" />
                            </div>

                            <div v-if="showButton" class="mt-4">
                                <button type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                    @click="submitOffday">
                                    Confirm
                                </button>
                            </div>


                        </DialogPanel>

                    </TransitionChild>
                </div>
            </div>


        </Dialog>
    </TransitionRoot>
</template>
<script setup>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogTitle,
} from '@headlessui/vue'
import { useRouter } from "vue-router";
import TInput from "../../core/TInput.vue";
import { computed, ref } from "@vue/reactivity";
import { useStore } from "vuex";


const store = useStore();

const user = computed(() => store.state.user.data);
const emit = defineEmits(['addEvent'])

const isOpen = ref(false)
const showButton = ref(false)
const errors = ref({});

const { instituition_id, owner_id} = defineProps({
    instituition_id: String,
    owner_id: String,
});




let pickedOffDate = ""
function closeModal() {
    isOpen.value = false
}
function openModal() {
    isOpen.value = true
}

function pickedDate(ev) {
    console.log(ev)
    pickedOffDate = ev
    showButton.value = true

    console.log("Instute id: ",instituition_id)
    console.log("owner id: ",owner_id)  

}

function submitOffday() {

    const param = {
        "appointment_type": "off-day",
        "instituition_id": instituition_id,
        "owner_id": owner_id,
        "appointment_date": pickedOffDate,
        "time": 0,
    }

    console.log("successfully submitted", param)

    store
        .dispatch("makeAppointment", param).then((res) => {
            console.log("making appointment res", res)


            isOpen.value = false
            const newEvent = {
                start: pickedOffDate,
                end: pickedOffDate,
                title: 'Day off!',
                content: '<br> \u00A0Take a break, You deserve it!</div>',
                class: 'new-event',
                allDay: true
            }
            emit("addEvent", newEvent)
        })
}

</script>