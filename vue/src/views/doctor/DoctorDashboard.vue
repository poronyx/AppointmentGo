<template>
    <PageComponent title="DoctorDashboard">
      <div v-if="loading" class="flex justify-center">Loading...</div>
      <div
        v-else
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 text-gray-700"
      >
        
      </div>
    </PageComponent>
  </template>
  
  <script setup>
  import { computed } from "vue";
  import { useStore } from "vuex";
  
  const store = useStore();
  
  const loading = computed(() => store.state.dashboard.loading);
  const data = computed(() => store.state.dashboard.data);
  
  store.dispatch("getDashboardData");
  </script>
  
  <style scoped></style>
  