<template>
    <PageComponent title="Patient Edit Profile">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1 row-span-2" style="animation-delay: 0.1s">
                <template v-slot:title>
                    <h2 class="text-3xl font-semibold">Mr. {{user.name}}</h2>

                </template>

                <div class="mb-5"></div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36 ">Email </div>
                    <input id="email-address" name="email" type="email" autocomplete="email" required=""
                        v-model="user.email"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Email address" />
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">Race </div>
                    <input id="race" name="race" type="race" autocomplete="race" required="" v-model="user.race"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Race" />
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">Contact No. </div>
                    <input id="phone_number" name="phone_number" type="phone_number" autocomplete="phone_number"
                        required="" v-model="user.phone_number"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Contact no." />
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">NRIC </div>
                    <input id="nric" name="nric" type="nric" autocomplete="nric" required="" v-model="user.nric"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="NRIC" />
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">Gender </div>
                    <input id="gender" name="gender" type="gender" autocomplete="gender" required=""
                        v-model="user.gender"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Gender" />
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">DOB </div>
                    <div class="relative w-full h-9 text-left">{{user.date_of_birth}}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">Address Line 1 </div>
                    <input id="addr1" name="addr1" type="addr1" autocomplete="addr1" required="" v-model="addr1"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Address Line 1" />
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">Address Line 2 </div>
                    <input id="addr2" name="addr2" type="addr2" autocomplete="addr2" required="" v-model="addr2"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Address Line 2" />
                </div>
                <div class="flex items-center mt-4">
                    <div class ="w-20"></div>
                    <input checked id="article-checkbox" type="checkbox" value=""
                        class="w-5 h-5 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checked-checkbox"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subscribe to our newsletter and promotions</label>
                </div>

                <div class="justify-between text-m mt-6 mb-6">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Confirm
                    </button>
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

const addr1 = "Bukit Panjang 222341 #4-123 Singapore";
const addr2 = "Orchard Road 814123 #999-532 Singapore";
</script>
    
<style scoped>

</style>
    