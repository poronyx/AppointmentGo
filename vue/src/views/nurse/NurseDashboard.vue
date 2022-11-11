<template>
    <PageComponent title="Nurse Dashboard">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class=" grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <!-- <button class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded  mb-4"
        @click="events.push({
          start: '2022-11-12',
          end: '2022-11-12',
          title: 'Day off!',
          content: '<br> \u00A0Take a break, You deserve it!</div>',
          class: 'new-event',
          allDay: true
        })">Add an Off Day!</button> -->
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
                            placeholder="Search for doctors..." required>



                    </div>



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
                                    Qualification(s)
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                    Working experience
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">

                                </th>
                            </tr>
                        </thead>

                        <tbody v-for="doctor in doctors" class="divide-y divide-gray-200">

                            <tr>
                                <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                    <a href="#" @click="viewDoctorSchedule(doctor)">{{ doctor.name }}</a>
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    <div v-for="specialtyName in specialties">
                                        <p
                                            v-if="specialtyName.id == doctor.specialty.main_specialty || specialtyName.id == doctor.specialty.sub_specialty">
                                            {{ specialtyName.name }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    <p v-for="qualification in doctor.qualifications"> {{ qualification }}</p>
                                </td>
                                <td class="px-6 py-3 text-xs text-gray-800 ">
                                    {{ doctor.experience }}
                                </td>
                                <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                    <button
                                        class="bg-slate-900 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-full"
                                        @click="viewDoctorSchedule(doctor)">
                                        View Schedule
                                    </button>
                                    <button
                                        class="bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full"
                                        @click="toManageSchedule(doctor)">
                                        Manage Schedule
                                    </button>

                                </td>
                            </tr>
                        </tbody>

                    </table>

                </DashboardCard>

                <DashboardCard v-if="showSchedule" class="order-2 lg:order-2" style="animation-delay: 0.1s">
                    <template v-slot:title>
                    <div class="flex justify-between items-center mb-6 px-2">
                        <h3 class="text-2xl font-semibold">Dr. {{docName}}'s Schedule</h3>
                    </div>
                </template>
                    
                    <VueCal  class="vuecal--blue-theme" :timeStep=15
                        :disable-views="['years', 'year']" :events="events"
                        @cell-dblclick="logEvents('cell-click', $event)" @event-focus="logEvents($event)"
                        @event-drag-create="logEvents('event-drag-create', $event)" @event-delete="eventDelete($event)"
                        @event-create="logEvents('event-create', $event)"></VueCal>

                </DashboardCard>

            </div>
  
    </PageComponent>
</template>
    
<script setup>
import { computed, ref } from "vue";
import { useStore } from "vuex";
import DashboardCard from "../../components/core/DashboardCard.vue";
import PageComponent from "../../components/PageComponent.vue";
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'
import { useRouter } from "vue-router";


const store = useStore();
const router = useRouter();

const loading = computed(() => store.state.dashboard.loading);
const user = computed(() => store.state.user.data);
const doctors = computed(() => store.state.nurseDashboard.listDoctors);
const events = computed(() => store.state.doctorDashBoard.events);
const specialties = computed(() => store.state.specialty.specialty_list);

const showSchedule = ref(false)

store.dispatch("getSpecialtyData");
store.dispatch("getUser");
console.log("Inside user", user)
console.log("Nurse's institution id", user.value.instituition_id)
const param = {
    institute_id: user.value.instituition_id
}
store.dispatch("getAllDoctorsFromInstitute", param)

//   console.log("Param", param)
//   store
//     .dispatch("getEventData", param)
//     .then((res) => {
//       console.log(res)
//       store.commit("setDoctorDashBoardData", res.data)
//     })

let docName = ""

function logEvents(ev) {
    console.log(ev)
}

function eventDelete(ev) {
    console.log(ev.appointment_id)
}


function viewDoctorSchedule(ev) {
    console.log(ev)
    showSchedule.value = true;
    this.docName = ev.name
    const param = {
        id: ev.id
    }
    console.log("Param", param)
    store
        .dispatch("getEventData", param)
        .then((res) => {
            console.log(res)
            store.commit("setDoctorDashBoardData", res.data)
        })
}

function toManageSchedule(ev){
    console.log(ev)
    store.commit("setDoctorDataNurse", ev)

    router.push({
        name: "NurseManageDoctor",
    });
}


</script>
    
<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}

.vuecal {
    height: 90vh;
}

.on-site {
    background-color: #ddfbdf;
    color: #1ab82d;
}

.home-visit {
    background-color: #bde2f6;
    color: #2276cb;
}

.new-event {
    background-color: #f5d399;
    color: #dc6d18;
}
</style>