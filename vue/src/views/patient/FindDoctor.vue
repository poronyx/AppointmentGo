<template>
    <PageComponent title="Find Doctor" appointment="Make Appointment">
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
                        placeholder="Search for doctors..." v-model="input" required>



                </div>

                <div class="mt-3 col-span-3">
                    <label for="specialty" class="block text-sm font-medium text-gray-700">Search by Specialty
                    </label>
                    <select id="specialty" name="specialty" v-model="specialty" class="
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
                        <option v-for="sType in specialties" :key="sType" :value="sType.id">
                            {{ upperCaseFirst(sType.name) }}
                        </option>
                    </select>
                </div>
                <div class="mt-3 col-span-3">
                    <label for="instituition" class="block text-sm font-medium text-gray-700">Search by
                        Instituition</label>
                    <select id="instituition" name="instituition" v-model="instituition" class="
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
                        <option v-for="iType in institutes" :key="iType" :value="iType.instituition_id">
                            {{ upperCaseFirst(iType.instituition_name) }}
                        </option>
                    </select>
                </div>
            </DashboardCard>

            <DashboardCard class="order-2 lg:order-2" style="animation-delay: 0.1s">

                <table class=" divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Specialty
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Institute
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Qualification(s)
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Working experience
                            </th>
                        </tr>
                    </thead>

                    <tbody v-for="doctor in filteredDoctor" class="divide-y divide-gray-200">

                        <tr>
                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#" @click="goToDoctorProfile(doctor)">{{ doctor.name }}</a>
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                <div v-for="specialtyName in specialties" >
                                    <p
                                        v-if="specialtyName.id == doctor.specialty.main_specialty || specialtyName.id == doctor.specialty.sub_specialty">
                                        {{ specialtyName.name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                <div v-for="instituteName in institutes" href="#">
                                    <p v-if="instituteName.id == doctor.instituition_id">
                                        {{ instituteName.instituition_name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                <p v-for="qualification in doctor.qualifications"> {{ qualification }}</p>
                            </td>
                            <td class="px-6 py-3 text-xs text-gray-800 ">
                                {{ doctor.experience }}
                            </td>
                        </tr>
                    </tbody>

                </table>

            </DashboardCard>

        </div>
    </PageComponent>
</template>
    
<script setup>
import DashboardCard from "../../components/core/DashboardCard.vue";
import PageComponent from "../../components/PageComponent.vue";
import { computed, ref } from "@vue/reactivity";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

const input = ref("");
const store = useStore();
const router = useRouter();

const loading = computed(() => store.state.dashboard.loading);
const allDoctors = computed(() => store.state.patientFindDoctor.allDoctors);
const institutes = computed(() => store.state.institute.instituition_list);
const specialties = computed(() => store.state.specialty.specialty_list);
const user = computed(() => store.state.user.data);

store.dispatch("getAllDoctors");
store.dispatch("getInstituteData");
store.dispatch("getSpecialtyData");

const props = defineProps({
    question: Object,
    index: Number,
});

const filteredDoctor = computed(() => {
    let allDoctors = store.state.patientFindDoctor.allDoctors;
    return allDoctors.filter((doctor) =>
            doctor.name.toLowerCase().includes(input.value.toLowerCase())
    );
}); 

function goToDoctorProfile(doct){
    console.log("clicked profile")
    console.log("view Doctor", doct)
    store.commit("setDoctorForView", doct)
    router.push({
        name: "ViewDoctorProfile",
    });
}

function upperCaseFirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

</script>
    
<style scoped>

</style>
    