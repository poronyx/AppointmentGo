<template>
    <PageComponent title="Medical Admin Profile">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1" style="animation-delay: 0.1s">
                <template v-slot:title>Hello {{user.name}},</template>
                <div class="flex justify-between text-sm mb-1">
                    <div>Email:</div>
                    <div>{{user.email}}</div>
                </div>
                <div class="flex justify-between text-sm mb-1">
                    <div>Race:</div>
                    <div>{{user.race}}</div>
                </div>
                <div class="flex justify-between text-sm mb-1">
                    <div>Contact No.:</div>
                    <div>{{user.phone_number}}</div>
                </div>
                <div class="flex justify-between text-sm mb-1">
                    <div>NRIC:</div>
                    <div>{{user.nric}}</div>
                </div>
                <div class="flex justify-between text-sm mb-1">
                    <div>Gender:</div>
                    <div>{{user.gender}}</div>
                </div>
                <div class="flex justify-between text-sm mb-1">
                    <div>DOB:</div>
                    <div>{{user.date_of_birth}}</div>
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

const loading = computed(() => store.state.dashboard.loading);
const data = computed(() => store.state.dashboard.data);
const user = computed(() => store.state.user.data);
const router = useRouter();


function toEditProfile(){
    MedicalAdminEditProfile

    router.push({
        name: "MedicalAdminEditProfile",
    });
}
</script>
    
<style scoped>

</style>
    