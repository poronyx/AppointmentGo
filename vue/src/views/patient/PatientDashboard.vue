<template>
  <PageComponent title="Patient Dashboard" appointment="Make Appointment">
    <div v-if="loading" class="flex justify-center">Loading...</div>
    <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
      
      <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 gap-5 text-gray-700">

          <div class="px-4 sm:px-0 animate-fade-in-down  ">
            <carousel :slides="slidesImage" :interval="3000" controls indicators></carousel>

          </div>


          <!--//pagination-->
          <!-- <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
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
                  <span class="font-medium">3</span>
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
                   Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" 
                  <a href="#" aria-current="page"
                    class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20">1</a>
                  
                  
                  
                  <a href="#"
                    class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                    <span class="sr-only">Next</span>
                    <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                  </a>
                </nav>
              </div>
            </div>
          </div> -->
          <div class="flex flex-col">
            <div class="overflow-x-auto">
              <div class="p-1.5 w-full inline-block align-middle">
                <div class="overflow-hidden border rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                          Title
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                          Description
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                          Date
                        </th>
                      </tr>
                    </thead>
                    <tbody v-for="data in material" class="divide-y divide-gray-200">
                      <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                          <a href="#" @click="viewMaterial(data)">{{data.title}}</a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                          {{data.description}}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                          {{data.created_at.split('T')[0]}}
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
    </div>
  </PageComponent>
</template>
  
<script setup>
import { computed } from "vue";
import { useStore } from "vuex";

import DashboardCard from "../../components/core/DashboardCard.vue";
import PageComponent from "../../components/PageComponent.vue";
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'
import Carousel from "../../components/core/carousel/Carousel.vue";
import router from "../../router";

const store = useStore();

const loading = computed(() => store.state.material.loading);
const material = computed(() => store.state.material.data);
const slidesImage = computed(() => store.state.material.slides);
store.dispatch("getMaterialData");

console.log("Loading Materials: ",material.value.length);

const slides = ["http://localhost:8000/images/TG8M6c3coKTmQhbr.jpeg",
"http://localhost:8000/images/TG8M6c3coKTmQhbr.jpeg",
"http://localhost:8000/images/TG8M6c3coKTmQhbr.jpeg"]
//storing material images into slide
for (let x = 0 ;  x < material.value.length; x++){
  console.log("Inside STORE: ",material.value[x].image_url)
  slides.push(material.value[x].image_url)
}
console.log("slides from store: ",slidesImage.value[0])



function viewMaterial(ev){
 console.log(ev)
 store.commit("setMaterialForView", ev)
 router.push({
        name: "ViewArticle",
    });
}
</script>
  
<style scoped>

</style>
  