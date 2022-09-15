<template>
    <PageComponent title="Make an appointment with us" >
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1" style="animation-delay: 0.1s">
                <template v-slot:title>On-site Appointment</template>
                <div class="flex justify-between text-sm mb-6 mt-7">
                    <div>Make an appointment with our available clinics today at your 
                        convenience!! (Booking can be made without being charged a single dollar)
                    </div>
                </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">
                    Make appointment now
                </button>

            </DashboardCard>
            <DashboardCard class="order-2 lg:order-2" style="animation-delay: 0.2s">
                <template v-slot:title>Home-visit Appointment</template>
                <div class="flex justify-between text-sm mb-6 mt-7">
                    <div>With ease, you can now order a doctor to your house at your convenience!!(A booking fee of $120 will have to be paid to make an appointment. T&C applied)
                    </div>
                </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">
                    Make appointment now
                </button>

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

store.dispatch("getDashboardData");
</script>
    
<style scoped>

</style>
    