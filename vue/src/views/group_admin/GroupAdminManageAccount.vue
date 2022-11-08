<template>
    <PageComponent title="Group Admin Manage Account">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1" style="animation-delay: 0.2s">

                <div class="inset-0 flex items-center justify-center mt-2 mb-5">
                    <TButtonLoading :loading="loading" class=" relative justify-center" @click="createUser">
                        Create New User!
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
                        placeholder="Search for users...">



                </div>

                <div class="mt-3 col-span-3">
                    <label for="userType" class="block text-sm font-medium text-gray-700">Search by User Type
                    </label>
                    <select id="userType" name="userType" v-model="specialty" class="
          mt-1
          block
          w-full
          py-2
          px-3
          border border-gray-300
          bg-white
          rounded-md
          shadow-sm
          focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
          sm:text-sm
        ">
                        <option v-for="uType in userTypes" :key="uType" :value="uType">
                            {{ uType }}
                        </option>
                    </select>
                </div>
                <div class="mt-3 col-span-3">
                    <label for="instituition" class="block text-sm font-medium text-gray-700">Search by
                        Instituition</label>
                    <select id="instituition" name="instituition" v-model="instituition" class="
          mt-1
          block
          w-full
          py-2
          px-3
          border border-gray-300
          bg-white
          rounded-md
          shadow-sm
          focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
          sm:text-sm
        ">
                        <option v-for="iType in institutes" :key="iType" :value="iType">
                            {{ iType.instituition_name }}
                        </option>
                    </select>
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
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                User Type
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Institute
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">
                                Suspended
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold  text-gray-500 uppercase">

                            </th>
                        </tr>
                    </thead>

                    <tbody v-for="user in allUsers" class="divide-y divide-gray-200">

                        <tr>
                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#">{{ user.name }}</a>
                            </td>
                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#">{{ user.email }}</a>
                            </td>
                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#">{{ user.user_type }}</a>
                            </td>

                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <div>
                                    <a v-for="instituteName in institutes" href="#">
                                        <p v-if="instituteName.id == user.instituition_id">
                                            {{ instituteName.instituition_name }}</p>
                                    </a>
                                </div>
                            </td>

                            <td v-if="user.suspended == 0" class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#"> No </a>
                            </td>
                            <td v-if="user.suspended == 1" class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <a href="#"> Yes </a>
                            </td>

                            <td class="px-6 py-3 text-xs font-medium text-gray-800 ">
                                <button v-if="user.suspended == 0"
                                    class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-full"
                                    @click="suspendUser(user.id)">
                                    Suspend
                                </button>
                                <button v-if="user.suspended == 1"
                                    class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-full"
                                    @click="unSuspendUser(user.id)">
                                    Undo Suspend
                                </button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                                    @click="deleteUser(user.id)">
                                    Delete
                                </button>
                                <button
                                    class="bg-slate-900 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-full"
                                    @click="editUser(user)">
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

const institutes = computed(() => store.state.institute.instituition_list);
const allUsers = computed(() => store.state.groupAdminManageAccount.user_list);
const loading = computed(() => store.state.groupAdminManageAccount.loading);

store.dispatch("getInstituteData");
store.dispatch("getAllUsersData");


const userTypes = ["Patient", "Doctor", "Nurse", "Medical Admin", "Platform Admin", "Group Admin"]

const specialty = ["Cardiology", "Physiology", "Allergy and immunology", "Anesthesiology", "Dermatology"]

const instituition = ["Bukit Panjang Clinic", "Newton Clinic"]





function createUser() {
    router.push({
        name: "GroupAdminCreateAccount",
    });
}

function deleteUser(user_id) {
    console.log("deleted", user_id)
    const param = {
        id: user_id
    }
    store.dispatch("deleteUser", param).then((res) => {
        if (res.data.success == true) {
            window.location.reload();
        }
    });
}
function suspendUser(user_id) {
    console.log("suspended")
    const param = {
        id: user_id
    }
    store.dispatch("suspendUser", param).then((res) => {
        if (res.data.success == true) {
            window.location.reload();
        }
    });
}

function unSuspendUser(user_id) {
    console.log("suspended")
    const param = {
        id: user_id
    }
    store.dispatch("unSuspendUser", param).then((res) => {
        if (res.data.success == true) {
            window.location.reload();
        }
    });
}

function editUser(user) {
    console.log("edit user", user)
    store.commit("setUserForEdit", user)
    router.push({
        name: "GroupAdminEditAccount",
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
.bg-white{
 background-color:rgb(237, 231, 225);
}
.bg-gray-50{
    background-color:rgb(237, 231, 225);
    color: black;
}
.text-gray-500{
    color: black;
}
</style>
    