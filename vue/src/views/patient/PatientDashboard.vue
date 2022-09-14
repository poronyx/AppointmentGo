<template>
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold text-gray-900">
        Patient Dashboard
      </h1>
      <slot name="header"></slot>
    </div>
  </header>
  <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div v-if="loading" class="flex justify-center">Loading...</div>
    <div v-else class="grid grid-cols-1 gap-5 text-gray-700">

      <div class="px-4 sm:px-0 animate-fade-in-down  ">
        <carousel :slides="slides" :interval="3000" controls indicators></carousel>

      </div>


      <!--//pagination-->
      <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
          <a href="#"
            class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
          <a href="#"
            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-gray-700">
              Showing
              {{ ' ' }}
              <span class="font-medium">1</span>
              {{ ' ' }}
              to
              {{ ' ' }}
              <span class="font-medium">3</span>
              {{ ' ' }}
              of
              {{ ' ' }}
              <span class="font-medium">30</span>
              {{ ' ' }}
              results
            </p>
          </div>
          <div>
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
              <a href="#"
                class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                <span class="sr-only">Previous</span>
                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
              </a>
              <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
              <a href="#" aria-current="page"
                class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20">1</a>
              <a href="#"
                class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">2</a>
              <a href="#"
                class="relative hidden items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20 md:inline-flex">3</a>
              <span
                class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700">...</span>
              <a href="#"
                class="relative hidden items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20 md:inline-flex">8</a>
              <a href="#"
                class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">9</a>
              <a href="#"
                class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">10</a>
              <a href="#"
                class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                <span class="sr-only">Next</span>
                <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
              </a>
            </nav>
          </div>
        </div>
      </div>
      <div class="flex flex-col">
        <div class="overflow-x-auto">
          <div class="p-1.5 w-full inline-block align-middle">
            <div class="overflow-hidden border rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                      Title
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                      Description
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                      Date
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <tr>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                      <a href="#">Fight Against Covid</a>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                      Guidelines to help keep our nation safe from Covid-19
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                      2022/09/12
                    </td>
                  </tr>
                  <tr>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                      <a href="#">Summer Flu</a>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                      <a>Its the season that most of us will get sick and everybody should be safe</a>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                      2022/09/9
                    </td>
                  </tr>
                  <tr>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                      <a href="#">Get your covid jabs with us</a>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                      With the constant spread of covid-19, our clinic now provide different vaccines to help against the virus
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                      2022/07/23
                    </td>
                  </tr>
                </tbody>
              </table>
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
  "/src/assets/example1.jpg",
  "/src/assets/example2.jpg",
  "/src/assets/example3.png",
]

</script>
  
<style scoped>

</style>
  