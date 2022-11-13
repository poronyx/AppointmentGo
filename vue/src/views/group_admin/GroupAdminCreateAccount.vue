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
                    <TInput name="name" v-model="userData.name" :errors="errors" placeholder="Full Name"
                        inputClass="rounded-t-md" />
                    <TInput type="email" name="email" v-model="userData.email" :errors="errors"
                        placeholder="Email Address" />
                    <TInput name="race" v-model="userData.race" :errors="errors" placeholder="Race" />
                    <input type="text" name="phone_number" v-model="userData.phone_number" minlength="8" maxlength="8"
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Phone number" />
                    <TInput name="nric" v-model="userData.nric" :errors="errors" placeholder="NRIC/FIN" />
                    <TInput name="address" v-model="userData.address.address" :errors="errors"
                        placeholder="Please Enter your address" />

                    <input type="text" name="postcode" v-model="userData.address.postcode" minlength="6" maxlength="6"
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Postal Code" />

                    <div class="col-span-3 mt-5 mb-5">
                        <label for="genderType" class="block text-sm font-medium text-gray-700">Choose a Gender
                        </label>
                        <select id="genderType" name="genderType" v-model="userData.gender" class="
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
                            <option v-for="gender in genderTypes" :key="gender" :value="gender">
                                {{ gender }}
                            </option>
                        </select>
                    </div>
                    <TInput type="date" name="date_of_birth" v-model="userData.date_of_birth" :errors="errors"
                        placeholder="dd/mm/yyyy" />
                    <TInput type="password" name="password" v-model="userData.password" :errors="errors"
                        placeholder="Password" />
                    <TInput type="password" name="password_confirmation" v-model="userData.password_confirmation"
                        :errors="errors" placeholder="Confirm Password" inputClass="rounded-b-md" />
                </div>
                <div class="col-span-3 mt-5 mb-5">
                    <label for="userType" class="block text-sm font-medium text-gray-700">Choose a user Type
                    </label>
                    <select id="userType" name="userType" v-model="userData.user_type"
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
                    <TInput name="academic_title" v-model="userData.academic_title" :errors="errors"
                        placeholder="Academic Title" inputClass="rounded-t-md" />
                    <TInput name="main_qualification" v-model="userData.qualifications.main_qualification"
                        :errors="errors" placeholder="Main Qualification" inputClass="rounded-t-md" />
                    <TInput name="other_qualification" v-model="userData.qualifications.other_qualification"
                        :errors="errors" placeholder="Other Qualification" inputClass="rounded-t-md" />

                    <div class="mt-1 mb-1">
                        <textarea id="description" name="description" rows="3" v-model="userData.summary"
                            autocomplete="survey_description"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                            placeholder="Summary of Doctor's career" />
                    </div>

                    <TInput name="experience" v-model="userData.experience" :errors="errors"
                        placeholder="Years of experience" inputClass="rounded-t-md" />


                    <div class="col-span-3 mt-5 mb-5">
                        <label for="userType" class="block text-sm font-medium text-gray-700">Choose a main specialty
                        </label>
                        <select id="userType" name="userType" v-model="userData.specialty.main_specialty"
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
                        <label for="userType" class="block text-sm font-medium text-gray-700">Choose a sub specialty
                        </label>
                        <select id="userType" name="userType" v-model="userData.specialty.sub_specialty"
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
                        <select id="userType" name="userType" v-model="userData.instituition"
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
                            <option v-for="instituition in institutes" :key="instituition" :value="instituition">
                                {{ instituition.instituition_name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div v-if="nursePicked" class="rounded-md shadow-sm ">
                    <TInput name="department" v-model="userData.department" :errors="errors" placeholder="Department"
                        inputClass="rounded-t-md" />

                    <div class="col-span-3 mt-5 mb-5">
                        <label for="userType" class="block text-sm font-medium text-gray-700">Choose an institute
                        </label>
                        <select id="userType" name="userType" v-model="userData.instituition"
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
                            <option v-for="instituition in institutes" :key="instituition" :value="instituition">
                                {{ instituition.instituition_name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div v-if="medicalAdminPicked" class="rounded-md shadow-sm ">

                    <div class="col-span-3 mt-5 mb-5">
                        <label for="userType" class="block text-sm font-medium text-gray-700">Choose an institute
                        </label>
                        <select id="userType" name="userType" v-model="userData.instituition"
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
                            <option v-for="instituition in institutes" :key="instituition" :value="instituition">
                                {{ instituition.instituition_name }}
                            </option>
                        </select>
                    </div>
                </div>



                <div class="inset-0 flex items-center justify-center">
                    <TButtonLoading :loading="loading" class=" relative justify-center" @click="register(userData)">
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
import { useStore } from "vuex";
import { computed } from "vue";
import { useRouter } from "vue-router";

const store = useStore();

const router = useRouter();
const institutes = computed(() => store.state.institute.instituition_list);
const specialties = computed(() => store.state.specialty.specialty_list);
const userData = computed(() => store.state.user.createData);
const user1 = computed(() => store.state.user.data);

userData.value.organization_id = user1.value.organization_id
store.dispatch("getInstituteData");
store.dispatch("getSpecialtyData");

const genderTypes = ["Male", "Female", "Others"]
const userTypes = ["Patient", "Doctor", "Nurse", "Medical Admin", "Platform Admin", "Group Admin"]
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
        postcode: "",
        address: "",
    },
    //doctor
    academic_title: "",
    qualifications: {
        main_qualification: "",
        other_qualification: "",
    },
    summary: "",
    specialty: {
        main_specialty: "",
        sub_specialty: "",
    },
    experience: "",
    //nurse
    department: "",
    //all except user, group and platform admin
    instituition_id: "",


};
const loading = ref(false);
const errors = ref({});
const patientPicked = ref(false)
const doctorPicked = ref(false)
const nursePicked = ref(false)
const medicalAdminPicked = ref(false)
const platformAdminPicked = ref(false)
const groupAdminPicked = ref(false)

const opening_time = [];

function register(input) {
    // loading.value = true;
    console.log(input)
    console.log("Opening Time", userData.value.instituition.opening_time)


    store
        .dispatch("registerForAll", input)
        .then((res) => {

            console.log("Res From Register", res)
            
            const param = {
                owner_id: res.id,
                opening_time: {
                    first: [userData.value.instituition.opening_time.first[0], userData.value.instituition.opening_time.first[1]],
                    second: [userData.value.instituition.opening_time.second[0], userData.value.instituition.opening_time.second[1]]
                },
                owner_type: "Doctor"
            }

            console.log("Param", param)
            // console.log("ID: ", userData.value.id)
            console.log("First Open: ", userData.value.instituition.opening_time.first)
            console.log("Second Open: ", userData.value.instituition.opening_time.second)
            store.dispatch("generateSlots", param).then((res) => {

                console.log(res)
                loading.value = false;

                router.push({
                    name: "GroupAdminManageAccount",
                });
            })
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
    if (ev == "Patient") {
        patientPicked.value = true;
        doctorPicked.value = false;
        nursePicked.value = false;
        medicalAdminPicked.value = false;
        platformAdminPicked.value = false;
        groupAdminPicked.value = false;
    }
    else if (ev == "Doctor") {
        patientPicked.value = false;
        doctorPicked.value = true;
        nursePicked.value = false;
        medicalAdminPicked.value = false;
        platformAdminPicked.value = false;
        groupAdminPicked.value = false;
    }
    else if (ev == "Nurse") {
        patientPicked.value = false;
        doctorPicked.value = false;
        nursePicked.value = true;
        medicalAdminPicked.value = false;
        platformAdminPicked.value = false;
        groupAdminPicked.value = false;
    }
    else if (ev == "Medical Admin") {
        patientPicked.value = false;
        doctorPicked.value = false;
        nursePicked.value = false;
        medicalAdminPicked.value = true;
        platformAdminPicked.value = false;
        groupAdminPicked.value = false;
    }
    else if (ev == "Platform Admin") {
        patientPicked.value = false;
        doctorPicked.value = false;
        nursePicked.value = false;
        medicalAdminPicked.value = false;
        platformAdminPicked.value = true;
        groupAdminPicked.value = false;
    }
    else if (ev == "Group Admin") {
        patientPicked.value = false;
        doctorPicked.value = false;
        nursePicked.value = false;
        medicalAdminPicked.value = false;
        platformAdminPicked.value = false;
        groupAdminPicked.value = true;
    }
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
    