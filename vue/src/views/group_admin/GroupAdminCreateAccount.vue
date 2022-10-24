<template>
    <PageComponent title="Group Admin Create Account">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1" style="animation-delay: 0.1s">

                <Alert v-if="Object.keys(errors).length" class="flex-col items-stretch text-sm">
                    <div v-for="(field, i) of Object.keys(errors)" :key="i">
                        <div v-for="(error, ind) of errors[field] || []" :key="ind">
                            * {{ error }}
                        </div>
                    </div>
                </Alert>


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
                    <TInput type="selected" name="gender" v-model="user.gender" :errors="errors" placeholder="Gender" />
                    <TInput type="date" name="date_of_birth" v-model="user.date_of_birth" :errors="errors"
                        placeholder="dd/mm/yyyy" />
                    <TInput type="password" name="password" v-model="user.password" :errors="errors"
                        placeholder="Password" />
                </div>
                <div class="col-span-3 mt-5 mb-5">
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
                <div v-if="doctorPicked" class="rounded-md shadow-sm ">
                    <TInput name="name" v-model="user.name" :errors="errors" placeholder="Full Name"
                        inputClass="rounded-t-md" />
                    <TInput type="email" name="email" v-model="user.email" :errors="errors"
                        placeholder="Email Address" />

                    <div class="col-span-3 mt-5 mb-5">
                        <label for="userType" class="block text-sm font-medium text-gray-700">Choose a specialty
                        </label>
                        <select id="userType" name="userType" v-model="user.specialty.main_specialty"
                            @change="pickedSpecialty($event.target.value)" class="
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
                            <option v-for="specialty in specialties" :key="specialty" :value="specialty.id">
                                {{ specialty.name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-span-3 mt-5 mb-5">
                        <label for="userType" class="block text-sm font-medium text-gray-700">Choose an institute
                        </label>
                        <select id="userType" name="userType" v-model="user.instituition_id"
                            @change="pickedInstitute($event.target.value)" class="
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
                            <option v-for="instituition in institutes" :key="instituition" :value="instituition.id">
                                {{ instituition.instituition_name }}
                            </option>
                        </select>
                    </div>
                </div>



                <div class="inset-0 flex items-center justify-center">
                    <TButtonLoading :loading="loading" class=" relative justify-center" disabled>
                        Create Account
                    </TButtonLoading>
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
import TButtonLoading from "../../components/core/TButtonLoading.vue";
import TInput from "../../components/core/TInput.vue";
import Alert from "../../components/Alert.vue";
import { ref } from "vue";
import store from "../../store";
import { computed } from "vue";

const institutes = computed(() => store.state.institute.instituition_list);
const specialties = computed(() => store.state.specialty.specialty_list);
store.dispatch("getInstituteData");
store.dispatch("getSpecialtyData");

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
    //patient
    address: {

    },
    //doctor
    academic_title: "",
    qualifications: {

    },
    summary: "",
    specialty: {
        main_specialty: [],
        sub_specialty: [],
    },
    experience: "",
    //nurse
    department: "",
    //all except user, group and platform admin
    instituition_id: "",

};
const loading = ref(false);
const errors = ref({});
const doctorPicked = ref(false)
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

function pickedUserType(ev) {
    console.log("Picked User: ", ev)
    if (ev == "Doctor") {
        doctorPicked.value = true;
    } else if (ev == "Nurse") {
        doctorPicked.value = false;
    }

    console.log(doctorPicked)
}


function pickedInstitute(ev) {
    console.log("Picked Institute ID : ", ev)

}
function pickedSpecialty(ev) {
    console.log("Picked Specialty ID : ", ev)

}


</script>
    
<style scoped>

</style>
    