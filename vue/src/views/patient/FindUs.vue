<template>
    <PageComponent title="Find Us">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1" style="animation-delay: 0.1s">
                <template v-slot:title>Bukit Panjang Clinic</template>
                <div class="flex justify-between text-sm mb-3">
                    <div>Address</div>
                    <div>Singapore 650223</div>
                </div>
                <div class="flex justify-between text-sm mb-3">
                    <div>Description</div>
                    <div>Located at the heart of Bukit Panjang</div>
                </div>
                <GoogleMap api-key="AIzaSyA3EaEfTI_FRPgg0b6jqUWdp2jW6vxBH3M" style="width: 100%; height: 500px" :center="center1"
                    :zoom="15">
                    <Marker :options="{ position: center1 }" />
                </GoogleMap>

            </DashboardCard>
            <DashboardCard class="order-1 lg:order-1" style="animation-delay: 0.1s">
                <template v-slot:title>Newton Clinic</template>
                <div class="flex justify-between text-sm mb-3">
                    <div>Address</div>
                    <div>Singapore 734352</div>
                </div>
                <div class="flex justify-between text-sm mb-3">
                    <div>Description</div>
                    <div>Located near the famous Newton Food Centre</div>
                </div>
                <GoogleMap api-key="AIzaSyA3EaEfTI_FRPgg0b6jqUWdp2jW6vxBH3M" style="width: 100%; height: 500px" :center="center2"
                    :zoom="15">
                    <Marker :options="{ position: center2 }" />
                </GoogleMap>

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
import { defineComponent } from "vue";
import { GoogleMap, Marker } from "vue3-google-map";

const store = useStore();

const loading = computed(() => store.state.dashboard.loading);
const data = computed(() => store.state.dashboard.data);
const user = computed(() => store.state.user.data);

const center1 = { lat: 1.378701, lng: 103.763741 };
const center2 = { lat: 1.3115095, lng: 103.8389787 };

store.dispatch("getDashboardData");
</script>
    
<style scoped>

</style>
    