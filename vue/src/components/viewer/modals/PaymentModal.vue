<template>


    <div class="inset-0 flex items-center justify-center">
        <button type="button" @click="openModal"
            class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 w-full rounded mb-2">
            Sign up
        </button>
    </div>
    <TransitionRoot appear :show="isOpenAlert" as="template">
        <Dialog as="div" class="relative z-10" :key="payment">
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

                            <div class="mt-1">
                                <div class="col-span-3">
                                    <label for="instituition" class="block text-sm font-medium text-gray-700">
                                        Payment Successful!
                                    </label>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                    @click="register(user,                                                   valueFields,                                                   type)">
                                    Continue to setup
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
import { ref } from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogTitle,
} from '@headlessui/vue'

import TButtonLoading from "../../core/TButtonLoading.vue";

import { useStore } from "vuex";
import { useRouter } from "vue-router";

const store = useStore();
const router = useRouter();

const isOpenAlert = ref(false)

const props = defineProps({
    user: Object,
    valueFields: Object,
    type: String,
});

function closeModal() {
    isOpenAlert.value = false
}
function openModal() {
    isOpenAlert.value = true
}

function register(user, valueFields, type) {

    console.log(user)
    console.log(valueFields)
    console.log(type)

    const param = {
        name: user.name,
        email: user.email,
        user_type: "Group Admin", //register is only for patient
        password: user.password,
        password_confirmation: user.password_confirmation,
        sub_type: type,
        company_name: user.company_name,
        cardName: valueFields.cardName,
        cardNumber: valueFields.cardNumber,
        cardMonth: valueFields.cardMonth,
        cardYear: valueFields.cardYear,
        cardCvv: valueFields.cardCvv
    }


    console.log(param)
    store
        .dispatch("registerGroupAdmin", param)
        .then(() => {
            router.push({
                name: "GroupAdminDashboard",
            });
        })
        .catch((error) => {
            console.log(error)
        });

}



</script>