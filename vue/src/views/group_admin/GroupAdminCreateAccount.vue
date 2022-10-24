<template>
    <PageComponent title="Group Admin Create Account">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1" style="animation-delay: 0.1s">
                <form class="mt-8 space-y-6" @submit="register">
                    <Alert v-if="Object.keys(errors).length" class="flex-col items-stretch text-sm">
                        <div v-for="(field, i) of Object.keys(errors)" :key="i">
                            <div v-for="(error, ind) of errors[field] || []" :key="ind">
                                * {{ error }}
                            </div>
                        </div>
                    </Alert>


                    <input type="hidden" name="remember" value="true" />
                    <div class="rounded-md shadow-sm ">
                        <TInput name="name" v-model="user.name" :errors="errors" placeholder="Full Name"
                            inputClass="rounded-t-md" />
                        <TInput type="email" name="email" v-model="user.email" :errors="errors"
                            placeholder="Email Address" />
                        <TInput name="race" v-model="user.race" :errors="errors" placeholder="Race" />
                        <input type="text" name="phone_number" v-model="user.phone_number" minlength="8" maxlength="8"
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Phone number" />
                        <TInput name="nric" v-model="user.nric" :errors="errors" placeholder="NRIC/FIN" />
                        <TInput type="selected" name="gender" v-model="user.gender" :errors="errors"
                            placeholder="Gender" />
                        <TInput type="date" name="date_of_birth" v-model="user.date_of_birth" :errors="errors"
                            placeholder="dd/mm/yyyy" />
                        
                    </div>
                    <div class="col-span-3">
                        <label for="userType" class="block text-sm font-medium text-gray-700">Choose a user Type
                        </label>
                        <select id="userType" name="userType" v-model="userType"
                            @change="pickedUserType($event.target.value)" class="
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
                            <option v-for="userType in userTypes" :key="userType" :value="userType">
                                {{ userType }}
                            </option>
                        </select>
                    </div>
                    <div class="inset-0 flex items-center justify-center">
                        <TButtonLoading :loading="loading" class=" relative justify-center" disabled >
                            Create Account
                        </TButtonLoading>
                    </div>
                </form>

            </DashboardCard>

        </div>
    </PageComponent>
</template>
    
<script setup>
import { EyeIcon, PencilIcon } from "@heroicons/vue/solid"
import DashboardCard from "../../components/core/DashboardCard.vue";
import TButton from "../../components/core/TButton.vue";
import PageComponent from "../../components/PageComponent.vue";
import TButtonLoading from "../../components/core/TButtonLoading.vue";
import TInput from "../../components/core/TInput.vue";
import Alert from "../../components/Alert.vue";
import { ref } from "vue";


const userTypes = ["Doctor", "Nurse", "Medical Admin", "Platform Admin", "Group Admin"]
const user = {
    name: "",
    email: "",
    race: "",
    phone_number: "",
    nric: "",
    gender: "",
    user_type: "",
    date_of_birth: "",
    password: "",
};
const loading = ref(false);
const errors = ref({});

function register(ev) {
    ev.preventDefault();
    loading.value = true;
    store
        .dispatch("register", user)
        .then(() => {
            loading.value = false;
        })
        .catch((error) => {
            console.log(error);
            loading.value = false;
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        });
}

function pickedUserType(ev){
    console.log(ev)
}
</script>
    
<style scoped>

</style>
    