<template>
    <PageComponent title="Patient View Article">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1 row-span-2" style="animation-delay: 0.1s">
                

                <div class="relative h-64 m-8 overflow-hidden bg-indigo-500 rounded-lg">
                    <div class="absolute z-30 flex w-full h-full">
                        <div class="relative z-30 w-5/6 px-6 py-8 text-white md:py-10 md:w-1/2">
                            <h2 class="text-3xl">{{title}}</h2>
                            <span></span>
                        </div>
                        <div class="absolute top-0 right-0 flex w-full h-full">
                            <div class="w-1/4 h-full bg-indigo-500"></div>
                            <div class="relative w-1/3">
                                <svg fill="currentColor" viewBox="0 0 100 100"
                                    class="absolute inset-y-0 z-20 h-full text-indigo-500">
                                    <polygon id="diagonal" points="0,0 100,0 50,100 0,100"></polygon>
                                </svg>
                                <svg fill="currentColor" viewBox="0 0 100 100"
                                    class="absolute inset-y-0 z-10 h-full ml-6 text-white opacity-50">
                                    <polygon points="0,0 100,0 50,100 0,100"></polygon>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 block w-9/12 h-full">
                        <img alt="Snowy mountain lake" class="object-cover h-full min-w-full"
                            src="/src/assets/covidBanner.jpg" />
                    </div>
                </div>

                <div class="w-full flex items-center">
                    This is a sample article. Covid-19 Sample article.This is a sample article. Covid-19 Sample article.
                    This is a sample article. Covid-19 Sample article.This is a sample article. Covid-19 Sample article.
                    This is a sample article. Covid-19 Sample article.This is a sample article. Covid-19 Sample article.
                    This is a sample article. Covid-19 Sample article.This is a sample article. Covid-19 Sample article.
                    This is a sample article. Covid-19 Sample article.This is a sample article. Covid-19 Sample article.
                    This is a sample article. Covid-19 Sample article.This is a sample article. Covid-19 Sample article.
                    This is a sample article. Covid-19 Sample article.This is a sample article. Covid-19 Sample article.
                    This is a sample article. Covid-19 Sample article.This is a sample article. Covid-19 Sample article.
                    This is a sample article. Covid-19 Sample article.This is a sample article. Covid-19 Sample article.
                    This is a sample article. Covid-19 Sample article.This is a sample article. Covid-19 Sample article.
                </div>
                <div class="flex items-left">
                    2022/09/12
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

const store = useStore();
const loading = computed(() => store.state.dashboard.loading);
const data = computed(() => store.state.dashboard.data);
const user = computed(() => store.state.user.data);

const title = "Guidelines to help keep our nation safe from Covid-19"
</script>
    
<style scoped>

</style>
    