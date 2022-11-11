<template>
    <PageComponent title="Group Admin Dashboard">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1" style="animation-delay: 0.1s">

                <template v-slot:title>Hello {{ user.name }},</template>
                <div class="flex justify-between text-sm mb-1">
                    <div>Email:</div>
                    <div>{{ user.email }}</div>
                </div>
                <div class="flex justify-between text-sm mb-1">
                    <div>Organization Name:</div>
                    <div>{{ org.name }}</div>
                </div>
                <div class="flex justify-between text-sm mb-1">
                    <div>Subscription Plan:</div>
                    <div v-if="org.sub_type == 1"> Basic</div>
                    <div v-else-if="org.sub_type == 2"> Premium</div>
                    <div v-else-if="org.sub_type == 3"> Deluxe</div>
                </div>
                <div class="flex justify-between text-sm mb-1">
                    <div>Subscription status:</div>
                    <div v-if="org.sub_status == 1"> Active</div>
                    <div v-else> In-active</div>
                </div>
                <div class="flex justify-between text-sm mb-1">
                    <div>Subscription date:</div>
                    <div>{{ org.sub_date }}</div>
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
const org = computed(() => store.state.groupAdminManageAccount.orgData);


store.dispatch("getOrg",
    {
        organization_id: user.value.organization_id
    })

</script>
    
<style scoped>

</style>
    