<template>
    <PageComponent title="Find Us" appointment="Make Appointment">
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
                        placeholder="Search for clinic..." v-model="input" required>

                </div>
            </DashboardCard>
            <DashboardCard v-for="institute in filteredInstitute" class="order-1 lg:order-1" style="animation-delay: 0.1s">

                <template v-slot:title><b>{{ institute.instituition_name }}</b></template>
                <div class="flex justify-between text-sm mb-3">
                    <div>Address</div>
                    <div>{{ institute.instituition_addr }}</div>
                </div>
                <div class="flex justify-between text-sm mb-3">
                    <div>Description</div>
                    <div>{{ institute.instituition_desc }}</div>
                </div>
                <div class="flex justify-between text-sm mb-3">
                    <div>Contact No.</div>
                    <div>{{ institute.instituition_phone }}</div>
                </div>
                <div class="flex justify-between text-sm mb-8">
                    <div>Opening Hours</div>
                    <div>{{ toHoursAndMinutes(institute.opening_time.first[0]) }} to
                        {{ toHoursAndMinutes(institute.opening_time.first[1]) }} and
                        {{ toHoursAndMinutes(institute.opening_time.second[0]) }} to
                        {{ toHoursAndMinutes(institute.opening_time.second[1]) }}
                    </div>
                </div>
                <GoogleMap api-key="AIzaSyA3EaEfTI_FRPgg0b6jqUWdp2jW6vxBH3M" style="width: 100%; height: 500px"
                    :center="{ lat: parseFloat(institute.location.lat), lng: parseFloat(institute.location.lng) }"
                    :zoom="15">
                    <Marker
                        :options="{ position: { lat: parseFloat(institute.location.lat), lng: parseFloat(institute.location.lng) } }" />
                </GoogleMap>

            </DashboardCard>


        </div>
    </PageComponent>
</template>
    
<script setup>
import { EyeIcon, PencilIcon } from "@heroicons/vue/solid"
import DashboardCard from "../../components/core/DashboardCard.vue";
import TButton from "../../components/core/TButton.vue";
import PageComponent from "../../components/PageComponent.vue";
import { computed, ref } from "vue";
import { useStore } from "vuex";
import { defineComponent } from "vue";
import { GoogleMap, Marker } from "vue3-google-map";

const input = ref("");
const store = useStore();

const loading = computed(() => store.state.dashboard.loading);
const institutes = computed(() => store.state.institute.instituition_list);
const user = computed(() => store.state.user.data);

const center1 = { lat: 1.378701, lng: 103.763741 };
const center2 = { lat: 1.3115095, lng: 103.8389787 };
const datatostore = [
    {
        name: "Bukit Panjang Clinic",
        addr: "Singapore 650223",
        desc: "Located at the heart of Bukit Panjang",
        contact: "+65 6882 8393",

    },
    {
        name: "Newton Clinic",
        addr: "Singapore 734352",
        desc: "Located near the famous Newton Food Centre",
        contact: "+65 6762 5234",
    }
]
store.dispatch("getInstituteData");

const filteredInstitute = computed(() => {
    let institutes = store.state.institute.instituition_list;
    return institutes.filter((institute) =>
        institute.instituition_name.toLowerCase().includes(input.value.toLowerCase())
    );
}); 

function toHoursAndMinutes(input) {
    const totalMinutes = input * 15;
    const minutes = totalMinutes % 60;
    const hours = Math.floor(totalMinutes / 60);

    return padTo2Digits(hours) + ":" + padTo2Digits(minutes);
}

function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}
</script>
    
<style scoped>

</style>
    