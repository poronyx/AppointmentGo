<template>
    <PageComponent title="NurseDashboard">
    <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold text-gray-900">
        Nurse Dashboard
      </h1>
      <slot name="header"></slot>
    </div>
    </header>
    
    </PageComponent>
  </template>
  
  <script setup>
  import { computed } from "vue";
  import { useStore } from "vuex";
  
  const store = useStore();
  
  const loading = computed(() => store.state.dashboard.loading);
  const data = computed(() => store.state.dashboard.data);
  const user = computed(() => store.state.user.data);
  
  store.dispatch("getDashboardData");
  </script>
  
  <style scoped></style>
  