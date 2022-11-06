<template>
    <PageComponent title="Patient Profile" appointment="Make Appointment">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1 row-span-2" style="animation-delay: 0.1s">
                <template v-slot:title>
                    <h2 class="text-3xl font-semibold">Hello {{ user.name }},</h2>

                </template>

                <div class="mb-5"></div>
                <div class="flex justify-between text-m mb-2">
                    <div>Email:</div>
                    <div>{{ user.email }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Race:</div>
                    <div>{{ user.race }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Contact No.:</div>
                    <div>{{ user.phone_number }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>NRIC:</div>
                    <div>{{ user.nric }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Gender:</div>
                    <div>{{ user.gender }}</div>
                </div>
                <div class="flex justify-between text-m mb-8">
                    <div>DOB:</div>
                    <div>{{ user.date_of_birth }}</div>
                </div>
                <div class="justify-between text-m ">
                    <button @click="toEditProfile"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit Profile
                    </button>
                </div>
            </DashboardCard>
            <DashboardCard class="order-2 lg:order-2" style="animation-delay: 0.2s">
                <template v-slot:title>
                    <div class="flex justify-between items-center mb-6 px-2">
                        <h3 class="text-2xl font-semibold">Latest appointment</h3>
                        <TButton  :to="{ name: 'MyAppointment' }" link>
                            View all
                        </TButton>
                    </div>
                </template>
                <table class=" divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-200">
                        <tr>
                            <th scope="col" class="px-3 py-1 text-xs font-bold  text-gray-500 uppercase">
                                ID
                            </th>
                            <th scope="col" class="px-3 py-1 text-xs font-bold  text-gray-500 uppercase">
                                Date
                            </th>
                            <th scope="col" class="px-3 py-1 text-xs font-bold  text-gray-500 uppercase">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="appointment in appointmentsData" class="divide-y divide-gray-200">

                        <tr>
                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#">{{ appointment.id }}</a>
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                {{ appointment.appointment_date }}
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                <p v-if="appointment.status == 0">Pending</p>
                                <p v-else>Completed</p>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </DashboardCard>
            <DashboardCard class="order-3 lg:order-4 " style="animation-delay: 0.4s">
                <template v-slot:title>
                    <div class="flex justify-between items-center mb-6 px-2">
                        <h3 class="text-2xl font-semibold">My medical history</h3>

                        <a href="/medical-history" class="text-sm text-blue-500 hover:decoration-blue-500">
                            View all
                        </a>
                    </div>
                </template>
                <table class=" divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-200">
                        <tr>
                            <th scope="col" class="px-3 py-1 text-xs font-bold  text-gray-500 uppercase">
                                ID
                            </th>
                            <th scope="col" class="px-3 py-1 text-xs font-bold  text-gray-500 uppercase">
                                Summary
                            </th>
                            <th scope="col" class="px-3 py-1 text-xs font-bold  text-gray-500 uppercase">
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="history in medicalHistories" class="divide-y divide-gray-200">

                        <tr>
                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#">{{ history.id }}</a>
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                {{ history.summary }}
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                {{ history.date }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </DashboardCard>
            <DashboardCard class="order-4 lg:order-3 row-span-2" style="animation-delay: 0.8s">
                <template v-slot:title>
                    <div class="flex justify-between items-center mb-3 px-2">
                        <h3 class="text-xl font-semibold">Submit Preliminary Documents</h3>
                    </div>
                </template>
                <div class="mb-8"></div>
                <div class="justify-between text-xl mb-28">
                    <div>There is no document yet</div>
                </div>
                <div class="justify-between text-sm ">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">
                        Add Document
                    </button>
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
const data = computed(() => store.state.dashboard.data);
const user = computed(() => store.state.user.data);
const appointmentsData = computed(() => store.state.patientProfile.appointments);
store.dispatch("getUser")
console.log(user.value.id)
const param = {
    "patient_id": user.value.id,
    "profile_page": true
}
store.dispatch("getAppointmentData", param)


const appointments = [{
    id: "PD2051245124124",
    appointment_type: "On-site",
    date: "2022-11-23",
    status: "Pending",
},
{
    id: "HV2022235235235",
    appointment_type: "Home-visit",
    date: "2021-10-14",
    status: "Completed",

}]

const medicalHistories = [{
    id: "OS2022125124124",
    summary: "Common flu",
    appointment_type: "On-site",
    date: "2022-03-23",
},
{
    id: "HV2022235235235",
    summary: "Covid delta-variant positive",
    appointment_type: "Home-visit",
    date: "2021-10-14",
}]

function toEditProfile() {
    router.push({
        name: "PatientEditProfile",
    });
}
</script>
    
<style scoped>

</style>
    