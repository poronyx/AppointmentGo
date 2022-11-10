<template>
    <PageComponent title="Nurse View Patient">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard v-if="appointment.status == 0" class="order-1 lg:order-1 row-span-2 bg-blue-200"
                style="animation-delay: 0.1s">
                <template v-slot:title>
                    <h2 class="text-3xl font-semibold"> Appointment Details </h2>
                </template>
                <div class="mb-5"></div>
                <div class="flex justify-between text-m mb-2">
                    <div>Patient Name:</div>
                    <template v-for="patient in allPatientData">
                        <p v-if="patient.id == appointment.patient_id">{{ patient.name }}</p>
                    </template>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Patient NRIC:</div>
                    <template v-for="patient in allPatientData">
                        <p v-if="patient.id == appointment.patient_id">{{ patient.nric }}</p>
                    </template>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Patient Age:</div>
                    <template v-for="patient in allPatientData">
                        <p v-if="patient.id == appointment.patient_id">{{ getAge(patient.date_of_birth) }} years old</p>
                    </template>
                </div>
                <div class="flex justify-between text-m mb-8">
                    <div>Patient Race:</div>
                    <template v-for="patient in allPatientData">
                        <p v-if="patient.id == appointment.patient_id">{{ patient.race }}</p>
                    </template>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Appointment Type:</div>
                    <div>{{ appointment.appointment_type }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Appointment Date:</div>
                    <div>{{ appointment.appointment_date }}</div>
                </div>
                <div class="flex justify-between text-m mb-8">
                    <div>Appointment Time:</div>
                    <div>{{ toHoursAndMinutes(appointment.time) }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Symptoms:</div>
                    <div>{{ appointment.symptoms }}</div>
                </div>
                <div class="flex justify-between text-m mb-8">
                    <div>Status:</div>
                    <div>Pending</div>
                </div>
                <div v-if="appointment.instituition_id == user.instituition_id" class="flex justify-between text-m mb-2">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                        @click="cancelAppointment(appointment.id)">
                        Cancel
                    </button>
                    <ChangeAppointmentModal :appointment="appointment"></ChangeAppointmentModal>
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
import ChangeAppointmentModal from "../../components/viewer/modals/ChangeAppointmentModal.vue";


const store = useStore();
const router = useRouter();
const loading = computed(() => store.state.dashboard.loading);
const patient = computed(() => store.state.doctorManageAppointments.viewPatientData)
const appointment = computed(() => store.state.doctorManageAppointments.viewAppointmentData);
const allPatientData = computed(() => store.state.doctorManageAppointments.allPatientData);
const user = computed(() => store.state.user.data)

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

function cancelAppointment() {
    console.log("cancel!")
}
function changeAppointment(ev) {
    console.log("change!", ev)
}
function diagnoseAppointment() {
    console.log("diagnose!")
}
</script>
    
<style scoped>

</style>
    