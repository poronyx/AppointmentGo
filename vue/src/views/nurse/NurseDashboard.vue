<template>
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold text-gray-900">
        Nurse Dashboard
      </h1>
      <slot name="header"></slot>
    </div>
  </header>
  <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div v-if="loading" class="flex justify-center">Loading...</div>
    <div v-else class="grid grid-cols-1 gap-5 text-gray-700">

      <div class="px-4 sm:px-0 animate-fade-in-down">
        <carousel :slides="slides" :interval="3000" controls indicators></carousel>

      </div>
      <div class="flex flex-col">
        <div class="overflow-x-auto">
          <div class="p-1.5 w-full inline-block align-middle">
            <div class="overflow-hidden border rounded-lg">
      
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</template>
  
<script setup>
import { computed } from "vue";
import { useStore } from "vuex";

import DashboardCard from "../../components/core/DashboardCard.vue";
import PageComponent from "../../components/PageComponent.vue";
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'
import Carousel from "../../components/core/carousel/Carousel.vue";

const store = useStore();

const loading = computed(() => store.state.dashboard.loading);
const data = computed(() => store.state.dashboard.data);
const user = computed(() => store.state.user.data);

store.dispatch("getDashboardData");
const slides = [
  "https://picsum.photos/id/1032/900/400",
  "https://picsum.photos/id/1033/900/400",
  "https://picsum.photos/id/1037/900/400",
  "https://picsum.photos/id/1035/900/400",
  "https://picsum.photos/id/1036/900/400",
]

</script>
  
<style scoped>

</style>
  