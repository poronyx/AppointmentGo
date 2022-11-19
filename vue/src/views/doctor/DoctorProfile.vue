<template>
    <PageComponent title="Doctor Profile" >
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1 row-span-2" style="animation-delay: 0.1s">
                <template v-slot:title>
                    <h2 class="text-3xl font-semibold">Hello {{ user.name }},</h2>

                </template>

                <div class="mb-5"></div>
                <div class="flex justify-between text-m mb-2">
                    <div>Email:</div>
                    <div>{{ user.email }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Race:</div>
                    <div>{{ user.race }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Contact No.:</div>
                    <div>{{ user.phone_number }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>NRIC:</div>
                    <div>{{ user.nric }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div>Gender:</div>
                    <div>{{ user.gender }}</div>
                </div>
                <div class="flex justify-between text-m mb-8">
                    <div>DOB:</div>
                    <div>{{ user.date_of_birth }}</div>
                </div>
                <div class="justify-between text-m ">
                    <button @click="toEditProfile"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit Profile
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
import { useRouter } from "vue-router";

const store = useStore();
const router = useRouter();
const loading = computed(() => store.state.dashboard.loading);
const data = computed(() => store.state.dashboard.data);
const user = computed(() => store.state.user.data);


store.dispatch("getUser")
console.log(user.value.id)



function toEditProfile() {
    router.push({
        name: "DoctorEditProfile",
    });
}
</script>
    
<style scoped>

</style>
    