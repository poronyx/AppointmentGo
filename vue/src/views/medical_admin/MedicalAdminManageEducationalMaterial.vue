<template>
    <PageComponent title="Medical Admin Manage Educational Material">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1 row-span-2" style="animation-delay: 0.1s">

                <div class="inset-0 flex items-center justify-center mt-2 mb-5">
                    <TButtonLoading :loading="loading" class=" relative justify-center" @click="createMaterial">
                        Create New Material!
                    </TButtonLoading>
                </div>
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
                        placeholder="Search for material..." required>



                </div>
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
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">

                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="data in material" class="divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                <a href="/patient-view-article">{{ data.title }}</a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                {{ data.description }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                {{ data.created_at.split('T')[0] }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                                    @click="deleteMaterial(data)">
                                    Delete
                                </button>
                                <button
                                    class="bg-slate-900 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-full"
                                    @click="editMaterial(data)">
                                    Edit
                                </button>
                            </td>


                        </tr>
                    </tbody>
                </table>

            </DashboardCard>


        </div>
    </PageComponent>
</template>


<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

import DashboardCard from "../../components/core/DashboardCard.vue";
import PageComponent from "../../components/PageComponent.vue";
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/solid'
import Carousel from "../../components/core/carousel/Carousel.vue";
import TButtonLoading from "../../components/core/TButtonLoading.vue";

const store = useStore();
const router = useRouter();

const loading = computed(() => store.state.material.loading);
const material = computed(() => store.state.material.data);
const slidesImage = computed(() => store.state.material.slides);
store.dispatch("getMaterialData");

console.log("Loading Materials: ", material.value.length);



function createMaterial() {
    router.push({
        name: "MedicalAdminCreateNewsArticle",
    });
}

function deleteMaterial(ev) {
    console.log(ev.id)
    const param = {
        id: ev.id
    }
    store.dispatch("deleteMaterial", param).then((res) => {
        console.log(res)
        window.location.reload();
    })

    
}

function editMaterial(ev) {
    console.log(ev)
    store.commit("setMaterialForEdit", ev)

    router.push({
        name: "MedicalAdminEditMaterial",

    })
}
</script>
  
<style scoped>

</style>
  