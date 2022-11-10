<template>
    <PageComponent title="Group Admin Manage Specialty">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1" style="animation-delay: 0.2s">

                <div class="inset-0 flex items-center justify-center mt-2 mb-5">
                    <TButtonLoading :loading="loading" class=" relative justify-center" @click="createSpecialty">
                        Create New Specialty!
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
                        placeholder="Search for specialty...">



                </div>
            </DashboardCard>

            <DashboardCard class="order-2 lg:order-2" style="animation-delay: 0.1s">

                <table class=" divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Date Created
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Date Updated
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">

                            </th>
                        </tr>
                    </thead>

                    <tbody v-for="specialty in specialties" class="divide-y divide-gray-200">

                        <tr>
                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#">{{ specialty.name }}</a>
                            </td>
                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#">{{ specialty.description }}</a>
                            </td>
                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#">{{ specialty.created_at }}</a>
                            </td>
                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#">{{ specialty.updated_at }}</a>
                            </td>
                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                                    @click="deleteSpecialty(specialty.id)">
                                    Delete
                                </button>
                                <button
                                    class="bg-slate-900 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-full"
                                    @click="editSpecialty(specialty)">
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
import DashboardCard from "../../components/core/DashboardCard.vue";
import PageComponent from "../../components/PageComponent.vue";
import { computed, ref } from "@vue/reactivity";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import TButtonLoading from "../../components/core/TButtonLoading.vue";
const router = useRouter();
const store = useStore();

const loading = computed(() => store.state.groupAdminManageAccount.loading);
const specialties = computed(() => store.state.specialty.specialty_list);


store.dispatch("getSpecialtyData");




function createSpecialty() {
    router.push({
        name: "GroupAdminCreateSpecialty",
    });
}

function deleteSpecialty(id) {

    console.log("deleted", id)
    const param = {
        id: id
    }
    store.dispatch("deleteSpecialty", param).then((res) => {
        if (res.data.success == true) {
            window.location.reload();
        }
    });
}

function editSpecialty(specialty) {
    console.log("edit specialty", specialty)
    store.commit("setSpecialtyForEdit", specialty)
    router.push({
        name: "GroupAdminEditSpecialty",
    });



    // const param = {
    //     id: user_id
    // }
    // store.dispatch("getUserForEdit", param).then((res) => {
    //     console.log(res)
    //     if (res.data.success == true) {
    //         router.push({
    //             name: "GroupAdminEditAccount",
    //         });
    //     }
    // });

}
</script>
    
<style scoped>

</style>
    