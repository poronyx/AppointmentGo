<template>
    <PageComponent title="Doctor's Profile" appointment="Make Appointment">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1" style="animation-delay: 0.2s">

                <template v-slot:title>
                    <h2 class="text-2xl font-semibold">Dr. {{ viewDoctor.name }}</h2>
                </template>
                <div class="mb-5"></div>
                <div class="flex justify-between text-m mb-2">
                    <div>Years of Experience: </div>
                    <div>{{ viewDoctor.experience }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Gender: </div>
                    <div>{{ viewDoctor.gender }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Race: </div>
                    <div>{{ viewDoctor.race }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Contact No. : </div>
                    <div>{{ viewDoctor.phone_number }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Currently at institute : </div>
                    <template v-for="instituteName in institutes">
                        <p v-if="instituteName.id == viewDoctor.instituition_id">
                            {{ instituteName.instituition_name }}</p>
                    </template>
                </div>
            </DashboardCard>

            <DashboardCard class="order-2 lg:order-2" style="animation-delay: 0.1s">
                <template v-slot:title>
                    <h2 class="text-2xl font-semibold">{{ viewDoctor.academic_title }}</h2>
                </template>

                <div class="mb-5"></div>
                <div class="justify-between text-m ">
                    <h2>Qualifications</h2>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Main qualification : </div>
                    <div>{{ viewDoctor.qualifications.main_qualification }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Other qualification : </div>
                    <div>{{ viewDoctor.qualifications.other_qualification }}</div>
                </div>

                <div class="mb-5"></div>
                <div class="justify-between text-m ">
                    <h2>Specialties</h2>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Primary specialty : </div>
                    <template v-for="specialtyName in specialties">
                        <p v-if="specialtyName.id == viewDoctor.specialty.main_specialty">
                            {{ specialtyName.name }}</p>
                    </template>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Other specialty : </div>
                    <template v-for="specialtyName in specialties">
                        <p v-if="specialtyName.id == viewDoctor.specialty.sub_specialty">
                            {{ specialtyName.name }}</p>
                    </template>
                </div>
            </DashboardCard>
            <DashboardCard class="order-3 lg:order-3" style="animation-delay: 0.1s">
                <template v-slot:title>
                    <h2 class="text-2xl font-semibold">Summary of Doctor</h2>
                </template>
                <div class="mb-5"></div>
                <div class="justify-between text-m ">
                    <h2>{{viewDoctor.summary}} </h2>
                </div>

            </DashboardCard>

        </div>
    </PageComponent>
</template>
    
<script setup>
import DashboardCard from "../../components/core/DashboardCard.vue";
import PageComponent from "../../components/PageComponent.vue";
import { computed, ref } from "@vue/reactivity";
import { useStore } from "vuex";

const store = useStore();

const loading = computed(() => store.state.dashboard.loading);
const viewDoctor = computed(() => store.state.patientFindDoctor.viewDoctorData);
const specialties = computed(() => store.state.specialty.specialty_list);
const institutes = computed(() => store.state.institute.instituition_list);

store.dispatch("getInstituteData");
store.dispatch("getSpecialtyData");




</script>
    
<style scoped>

</style>
    