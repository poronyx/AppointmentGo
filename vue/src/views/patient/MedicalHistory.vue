<template>
    <PageComponent title="Medical History" appointment="Make Appointment">
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
                        placeholder="Search for medical histories..." required>



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
                               
                            </th>
                        </tr>
                    </thead>

                    <tbody v-for="appointment in appointments" class="divide-y divide-gray-200">

                        <tr>
                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#">{{appointment.id}}</a>
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                {{appointment.institute}}
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                {{appointment.summary}}
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                {{appointment.appointment_type}}
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                {{appointment.date}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                <button
                                    class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                                    @click="changeApointment(data)">
                                    View
                                </button>
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
import { computed } from "vue";
import { useStore } from "vuex";
import { ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/solid'

const store = useStore();

const loading = computed(() => store.state.dashboard.loading);
const data = computed(() => store.state.dashboard.data);
const user = computed(() => store.state.user.data);

const appointments = [{
    id: "OS2022125124124",
    institute: "Bukit Panjang Clinic",
    summary: "Common flu",
    appointment_type: "On-site",
    date: "2022-03-23",
},
{
    id: "HV2022235235235",
    institute: "Not Applicable",
    summary: "Covid delta-variant positive",
    appointment_type: "Home-visit",
    date: "2021-10-14",
},
{
    id: "OS20227562342342",
    institute: "Newton Clinic",
    summary: "High fever and irritated throat",
    appointment_type: "On-site",
    date: "2021-06-07",
}]



let startDate;
let endDate;

</script>
    
<style scoped>

</style>
    