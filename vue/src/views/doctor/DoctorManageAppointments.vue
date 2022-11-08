<template>
    <PageComponent title="Manage Appointments">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1 " style="animation-delay: 0.2s">
                <template v-slot:title>
                    <div class="flex justify-between items-center mb-7 px-2">
                        <h3 class="text-xl font-semibold">Search by Patients</h3>
                    </div>
                </template>
                <div class="relative w-full">
                    <div class="flex absolute inset-y-0 left-0 top-3 pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for patient..." required>
                    <table class=" divide-y divide-gray-200 table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    NRIC
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    Age
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    Gender
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    Race
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">

                                </th>
                            </tr>
                        </thead>

                        <tbody v-for="patient in allPatientData" class="divide-y divide-gray-200">

                            <tr>
                                <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                    <a href="#">{{ patient.id }}</a>
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    {{ patient.name }}
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    {{ patient.nric }}
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    {{ getAge(patient.date_of_birth) }}
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    {{ patient.gender }}
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    {{ patient.race }}
                                </td>
                                <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                    <button
                                        class="bg-slate-900 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-full"
                                        @click="toPatientProfile(patient)">
                                        View
                                    </button>
                                </td>
                            </tr>
                        </tbody>

                    </table>


                </div>


            </DashboardCard>
            <DashboardCard class="order-2 lg:order-2 " style="animation-delay: 0.2s">
                <template v-slot:title>
                    <div class="flex justify-between items-center mb-7 px-2">
                        <h3 class="text-xl font-semibold">Search by Appointments</h3>
                    </div>
                </template>
                <div class="relative w-full">
                    <div class="flex absolute inset-y-0 left-0 top-3 pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for appointment..." required>
                    <table class=" divide-y divide-gray-200 table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    Time
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">

                                </th>
                            </tr>
                        </thead>

                        <tbody v-for="appointment in appointmentsDataDoctor" class="divide-y divide-gray-200">

                            <tr>
                                <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                    <a href="#">{{ appointment.id }}</a>
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    <template v-for="patient in allPatientData">
                                        <p v-if="patient.id == appointment.patient_id">{{ patient.name }}</p>
                                    </template>

                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    {{ appointment.appointment_type }}
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    {{ appointment.appointment_date }}
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    {{ toHoursAndMinutes(appointment.time) }}
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    <p v-if="appointment.status == 0">Pending</p>
                                    <p v-else>Completed</p>
                                </td>
                                <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                    <button
                                        class="bg-slate-900 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-full"
                                        @click="toAppointment(appointment)">
                                        Manage
                                    </button>
                                </td>
                            </tr>
                        </tbody>

                    </table>


                </div>


            </DashboardCard>

        </div>
    </PageComponent>
</template>
    
<script setup>
import { EyeIcon, PencilIcon } from "@heroicons/vue/solid"
import DashboardCard from "../../components/core/DashboardCard.vue";
import TButton from "../../components/core/TButton.vue";
import PageComponent from "../../components/PageComponent.vue";
import { computed } from "vue";
import { useStore } from "vuex";
import { ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/solid'
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'
import DoctorAddOffDayModal from "../../components/viewer/modals/DoctorAddOffDayModal.vue";
import { useRouter } from "vue-router";


const store = useStore();
const router = useRouter();

const loading = computed(() => store.state.dashboard.loading);
const user = computed(() => store.state.user.data);
const institutes = computed(() => store.state.institute.instituition_list);
const userID = computed(() => store.state.patientMakeAppointment.patientProfile);
const appointmentsDataDoctor = computed(() => store.state.doctorManageAppointments.appointmentsData);
const allPatientData = computed(() => store.state.doctorManageAppointments.allPatientData);
const events = computed(() => store.state.doctorDashBoard.events);

const param = {
    "doctor_id": user.value.id
}
store
    .dispatch("getAppointmentDataDoctor", param)

store.dispatch("getAllPatientData")


function toHoursAndMinutes(input) {
    const totalMinutes = input * 15;
    const minutes = totalMinutes % 60;
    const hours = Math.floor(totalMinutes / 60);

    return padTo2Digits(hours) + ":" + padTo2Digits(minutes);
}

function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}

function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function toPatientProfile(ev) {

    console.log(ev)
    store.commit("setPatientForView", ev)

    router.push({
        name: "DoctorViewPatient",
    });

}

function toAppointment(ev) {

    console.log(ev)
    store.commit("setAppointmentForManage", ev)

    router.push({
        name: "DoctorViewAppointment",
    });

}

</script>
    
<style scoped>

</style>
    