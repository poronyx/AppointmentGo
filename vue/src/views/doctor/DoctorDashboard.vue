<template>
  <PageComponent title="Doctor Dashboard">
    <div v-if="loading" class="flex justify-center">Loading...</div>
    <div v-else class=" gap-5 text-gray-700">
      <!-- <button class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded  mb-4"
      @click="events.push({
        start: '2022-11-12',
        end: '2022-11-12',
        title: 'Day off!',
        content: '<br> \u00A0Take a break, You deserve it!</div>',
        class: 'new-event',
        allDay: true
      })">Add an Off Day!</button> -->
      <VueCal class="vuecal--blue-theme" 
      :timeStep=15 
      :disable-views="['years', 'year']" 
      :events="events"
        @cell-dblclick="logEvents('cell-click', $event)" 
        @event-focus="logEvents($event)"
        @event-drag-create="logEvents('event-drag-create', $event)" 
        @event-delete="eventDelete($event)"
        @event-create="logEvents('event-create', $event)"
        
        ></VueCal>



    </div>
  </PageComponent>
</template>
  
<script setup>
import { computed, reactive } from "vue";
import { useStore } from "vuex";
import DashboardCard from "../../components/core/DashboardCard.vue";
import PageComponent from "../../components/PageComponent.vue";
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'

const store = useStore();

const loading = computed(() => store.state.dashboard.loading);
const data = computed(() => store.state.dashboard.data);
const user = computed(() => store.state.user.data);
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
  
function logEvents(ev) {
  console.log(ev)
}

function eventDelete(ev) {
  console.log(ev.appointment_id)
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
  background-color: #bde2f6;
  color: #2276cb;
}
</style>