<template>
    <PageComponent title="Manage Schedule">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1 " style="animation-delay: 0.2s">
                <template v-slot:title>
                    <div class="flex justify-between items-center mb-7 px-2">
                        <h3 class="text-xl font-semibold">Dr. {{ user.name }}</h3>
                    </div>
                </template>
                <div class="relative w-full">
                    <DoctorAddOffDayModal></DoctorAddOffDayModal>
            </div>
                <!--  
                    
                    <button class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded  mb-9"
                    @click="addOffDayModal">Add an Off Day!</button> 
@click="events.push({
        start: '2022-11-12',
        end: '2022-11-12',
        title: 'Day off!',
        content: '<br> \u00A0Take a break, You deserve it!</div>',
        class: 'new-event',
        allDay: true
      })
                -->


            </DashboardCard>
            <DashboardCard class="order-2 lg:order-2 " style="animation-delay: 0.2s">
                <template v-slot:title>
                    <div class="flex justify-between items-center mb-7 px-2">
                        <h3 class="text-xl font-semibold">Manage Patients & Appointments</h3>
                    </div>
                </template>
                <div class="relative w-full">
                    <button class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded  mb-9">
                        Manage</button>

                </div>


            </DashboardCard>

            <DashboardCard class="order-3 lg:order-3 row-span-2 col-span-2" style="animation-delay: 0.1s">
                <div class="flex justify-between text-m mb-8">
                <vue-cal small :time="false" hide-view-selector active-view="week"
                    :disable-views="['years', 'year', 'month']" :selected-date="selectedDate" class="vuecal--blue-theme"
                    style="max-width: 660px;height: 260px"
                    :events="events">
                </vue-cal>
                <VueCal xsmall :time="false" hide-view-selector active-view="month"
                    :disable-views="['years', 'year', 'week', 'day']" @cell-focus="selectedDate = $event"
                    class="vuecal--blue-theme vuecal--rounded-theme" style="max-width: 270px;height: 290px"
                    :events="events">
                </VueCal>
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
const store = useStore();

const loading = computed(() => store.state.dashboard.loading);
const user = computed(() => store.state.user.data);
const institutes = computed(() => store.state.institute.instituition_list);
const userID = computed(() => store.state.patientMakeAppointment.patientProfile);
const appointmentsData = computed(() => store.state.patientProfile.appointments);
const events = computed(() => store.state.doctorDashBoard.events);

store.dispatch("getUser");
console.log("Inside user", user)
const doctorId = store.getters.getUserID

const param = {
  id: doctorId
}
console.log("Param", param)
store
  .dispatch("getEventData", param)
  .then((res) => {
    console.log(res)
    store.commit("setDoctorDashBoardData", res.data)
  })




let startDate;
let endDate;

</script>
    
<style scoped>

</style>
    