<template>
    <PageComponent title="Doctor View Patient">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1 row-span-2" style="animation-delay: 0.1s">
                <template v-slot:title>
                    <h2 v-if="patient.gender == 'Male'" class="text-3xl font-semibold">Mr. {{ patient.name }} </h2>
                    <h2 v-if="patient.gender == 'Female'" class="text-3xl font-semibold">Mrs. {{ patient.name }} </h2>
                    <h2 v-if="patient.gender == 'Others'" class="text-3xl font-semibold">{{ patient.name }} </h2>
                </template>
                <div class="mb-5"></div>
                <div class="flex justify-between text-m mb-2">
                    <div>Email:</div>
                    <div>{{ patient.email }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Race:</div>
                    <div>{{ patient.race }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Contact No.:</div>
                    <div>{{ patient.phone_number }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>NRIC:</div>
                    <div>{{ patient.nric }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Gender:</div>
                    <div>{{ patient.gender }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Age:</div>
                    <div>{{ getAge(patient.date_of_birth) }} years old</div>
                </div>
                <div class="flex justify-between text-m mb-8">
                    <div>DOB:</div>
                    <div>{{ patient.date_of_birth }}</div>
                </div>
            </DashboardCard>
            <DashboardCard class="order-2 lg:order-2 " style="animation-delay: 0.2s">
                <template v-slot:title>
                    <div class="flex justify-between items-center mb-7 px-2">
                        <h3 class="text-xl font-semibold">Patient's Appointments</h3>
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
                                    Symptoms
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

                        <tbody v-for="appointment in appointmentsData" class="divide-y divide-gray-200">

                            <tr>
                                <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                    <a href="#">{{ appointment.id }}</a>
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    {{ appointment.symptoms }}
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
import { useRouter } from "vue-router";

const store = useStore();
const router = useRouter();
const loading = computed(() => store.state.dashboard.loading);
const patient = computed(() => store.state.doctorManageAppointments.viewPatientData)
const appointmentsData = computed(() => store.state.patientProfile.appointments);

store.dispatch("getUser");
console.log("User ID", patient.value)
const param = {
    "patient_id": patient.value.id,
    "profile_page": false
}
store.dispatch("getAppointmentData", param)


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
    