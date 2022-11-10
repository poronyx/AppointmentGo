<template>

    <div>
        <button type="button" @click="openModal"
            class="bg-slate-900 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-full">
            Change Appointment
        </button>
    </div>

    <TransitionRoot appear :show="isOpen" as="template">

        <Dialog as="div" @close="closeModal" class="relative z-10" :key="on - site">
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
                                        Changing appointment schedule
                                    </div>
                                    <div class="order-2 lg:order-2 ">
                                        <button type="button" class="float-right" @click="closeModal()"> X
                                        </button>
                                    </div>

                                </div>
                            </DialogTitle>
                            <div class="mt-1">

                                <div class="col-span-3">
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="dates" class="block text-sm font-medium text-gray-700">Pick a Date
                                </label>
                                <TInput type="date" name="date_of_birth" v-model="appointmentData.date" :errors="errors"
                                    placeholder="dd/mm/yyyy" @change="pickedDate(appointment)" />
                            </div>
                            <div v-if="showSlots" class="col-span-3">

                                <label for="timeSlots" class="block text-sm font-medium text-gray-700">Pick a time
                                </label>
                                <select id="timeSlots" name="timeSlots" v-model="appointmentData.time"
                                    @change="pickedTimeSlot($event.target.value)" class="
  mt-1
  block
  w-full
  py-2
  px-3
  border border-gray-300
  bg-white
  rounded-md
  shadow-sm
  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
  sm:text-sm
  ">
                                    <option v-for="time in slotAvailablityData" :key="time" :value="time.key">
                                        {{ time.time }}
                                    </option>
                                </select>
                            </div>

                            <div v-if="showButton" class="mt-4">
                                <button type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                    @click="updateAppointment(appointment.id)">
                                    Make on-site appointment
                                </button>
                            </div>
                            <TransitionRoot appear :show="isOpenAlert" as="template">
                                <Dialog as="div" class="relative z-10" :key="on - site">
                                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                                        enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100"
                                        leave-to="opacity-0">
                                        <div class="fixed inset-0 bg-black bg-opacity-25" />
                                    </TransitionChild>

                                    <div class="fixed inset-0 overflow-y-auto">
                                        <div class="flex min-h-full items-center justify-center p-4 text-center">
                                            <TransitionChild as="template" enter="duration-300 ease-out"
                                                enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100"
                                                leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                                                leave-to="opacity-0 scale-95">
                                                <DialogPanel
                                                    class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                                                    <DialogTitle as="h3"
                                                        class="text-lg font-medium leading-6 text-gray-900">
                                                        <div
                                                            class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mb-9">
                                                            <div class="order-1 lg:order-1">
                                                                On-site Appointment Successfully made!!
                                                            </div>
                                                            <div class="order-2 lg:order-2 ">
                                                                <button type="button" class="float-right"
                                                                    @click="closeModal()"> X
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </DialogTitle>
                                                    <div class="mt-1">
                                                        <div class="col-span-3">
                                                            <label for="instituition"
                                                                class="block text-sm font-medium text-gray-700">
                                                                Your booking details will be sent to you shortly via
                                                                email
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="mt-4">
                                                        <button type="button"
                                                            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                                            @click="routeToHome">
                                                            Confirm
                                                        </button>
                                                    </div>


                                                </DialogPanel>

                                            </TransitionChild>
                                        </div>
                                    </div>


                                </Dialog>
                            </TransitionRoot>
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


const makeAppointmentData = computed(() => store.state.patientMakeAppointment.makeAppointmentData);
const slotAvailablityData = computed(() => store.state.patientMakeAppointment.slotAvailability);


store.dispatch("getUser");



const appointmentData = {
    date: "",
    time: ""
}

const props = defineProps({
    appointment: Object
});



const isOpen = ref(false)
const isOpenAlert = ref(false)

const showButton = ref(false)

const showSlots = ref(false)
const router = useRouter();
const errors = ref({});

function pickedDate(event) {
    showSlots.value = true
    console.log(event)
    console.log("Date", appointmentData.date)
    console.log("owener type", event.owner_type)
    let param = {}
    if (event.owner_type == "Doctor") {
        param = {
            "institute_id": event.instituition_id,
            "owner_id": event.owner_id,
            "date": appointmentData.date,
            "appointment_type": "on-site"
        }
    } else if (event.owner_type == "Institute") {
        param = {
            "institute_id": event.instituition_id,
            "owner_id": "NA",
            "date": appointmentData.date,
            "appointment_type": "on-site"
        }
    }

    //Get Available slots from selected date doctor
    console.log("Appointment Data", event.instituition_id)
    console.log("Appointment Data", event.owner_id)
    console.log("Appointment Data", event.date)
    store
        .dispatch("getAvailabilityData", param).then((res) => {
            console.log(res.data.final_slots)
            store.commit("setAvailableSlots", res.data.final_slots)
        })
    console.log(appointmentData)
}
function pickedTimeSlot(picked) {
    console.log(picked)
    showButton.value = true;
    appointmentData.time = picked;
    console.log(appointmentData)
}


function closeModal() {
    isOpen.value = false
    isOpenAlert.value = false
    resetFields()
}
function openModal() {
    isOpen.value = true
}
function updateAppointment(id) {

    console.log(appointmentData)

    const param = {
        "id": id,
        "appointment_date": appointmentData.date,
        "time": appointmentData.time
    }

    console.log("successfully submitted", param)

    store
        .dispatch("updateAppointment", param).then((res) => {
            console.log("making appointment res", res)

            resetFields()
            isOpenAlert.value = true

        })

}

function resetFields() {
    showSlots.value = false
    showButton.value = false;
}

function routeToHome() {

    router.push({
        name: "NurseManagePatientAndAppointments",
    });
}

</script>