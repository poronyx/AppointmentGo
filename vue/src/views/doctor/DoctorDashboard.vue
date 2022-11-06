<template>
  <PageComponent title="Doctor Dashboard">
    <div v-if="loading" class="flex justify-center">Loading...</div>
    <div v-else class=" gap-5 text-gray-700">
      <VueCal class="vuecal--blue-theme" 
      
      :timeStep=15 
      :disable-views="['years', 'year']" 
      :events="events"
      
      ></VueCal>



    </div>
  </PageComponent>
</template>
  
<script setup>
import { computed } from "vue";
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

const doctorId = user.value.id
console.log(doctorId)
const param = {
  id : 2
}

console.log("Param",param)
store
  .dispatch("getEventData", param)
  .then((res) => {
    console.log(res)
    store.commit("setDoctorDashBoardData", res.data)
  })


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

.on-site {background-color: #ddfbdf;color: #1ab82d;}
.home-visit {background-color: #bde2f6;color: #2276cb;}
</style>