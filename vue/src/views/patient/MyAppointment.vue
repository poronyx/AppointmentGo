<template>
    <PageComponent title="My Appointments" appointment="Make Appointment">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1" style="animation-delay: 0.2s">

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



                </div>
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" name="expire_date" id="expire_date" v-model="startDate"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">to Date</label>
                    <input type="date" name="expire_date" id="expire_date" v-model="endDate"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

            </DashboardCard>

            <DashboardCard class="order-2 lg:order-2" style="animation-delay: 0.1s">
                <table class=" divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Instituition
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Summary
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Appointment-type
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Date
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
                                <a href="#">{{appointment.id}}</a>
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                <div v-for="instituteName in institutes" href="#">
                                    <p v-if="instituteName.id == appointment.instituition_id">
                                        {{ instituteName.instituition_name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                {{appointment.symptoms}}
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                {{appointment.appointment_type}}
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                {{appointment.appointment_date}}
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                <p v-if="appointment.status == 0">Pending</p>
                                <p v-else>Completed</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                                    @click="cancelAppointment(appointment.id)">
                                    cancel
                                </button>
                                <PatientChangeAppointmentModal  :appointment="appointment" ></PatientChangeAppointmentModal>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </DashboardCard>

        </div>
    </PageComponent>
</template>
    
<script setup>
import { EyeIcon, PencilIcon } from "@heroicons/vue/solid"
import DashboardCard from "../../components/core/DashboardCard.vue";
import TButton from "../../components/core/TButton.vue";
import PageComponent from "../../components/PageComponent.vue";
import { computed } from "@vue/reactivity";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/solid'
import PatientChangeAppointmentModal from "../../components/viewer/modals/PatientChangeAppointmentModal.vue";

const store = useStore();
const router = useRouter();

const loading = computed(() => store.state.dashboard.loading);
const institutes = computed(() => store.state.institute.instituition_list);
const user = computed(() => store.state.user.data);
const appointmentsData = computed(() => store.state.patientProfile.appointments);


store.dispatch("getUser");
console.log("User ID",user.value.id)
const param = {
    "patient_id": user.value.id,
    "profile_page": false
}
store.dispatch("getAppointmentData", param)
store.dispatch("getInstituteData");

function cancelAppointment(ev){
    console.log(ev)

    const param = {
        id: ev
    }

    store.dispatch("deleteAppointment", param).then((res) =>{
        console.log(res)
        router.push({
            name: "PatientProfile",
        });
    })
}


let startDate;
let endDate;

</script>
    
<style scoped>

</style>
    