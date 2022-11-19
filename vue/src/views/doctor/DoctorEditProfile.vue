<template>
    <PageComponent title="Doctor Edit Profile">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1 row-span-2" style="animation-delay: 0.1s">
                <template v-slot:title>
                    <h2 class="text-3xl font-semibold">Mr. {{ user.name }}</h2>

                </template>

                <div class="mb-5"></div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36 ">Email </div>
                    <input id="email-address" name="email" type="email" autocomplete="email" required=""
                        v-model="user.email"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Email address" />
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">Race </div>
                    <input id="race" name="race" type="race" autocomplete="race" required="" v-model="user.race"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Race" />
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">Contact No. </div>
                    <input id="phone_number" name="phone_number" type="phone_number" autocomplete="phone_number"
                        required="" v-model="user.phone_number"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Contact no." />
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">NRIC </div>
                    <input id="nric" name="nric" type="nric" autocomplete="nric" required="" v-model="user.nric"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="NRIC" />
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">Gender </div>
                    <input id="gender" name="gender" type="gender" autocomplete="gender" required=""
                        v-model="user.gender"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Gender" disabled />
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">DOB </div>
                    <div class="relative w-full h-9 text-left">{{ user.date_of_birth }}</div>
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">Address </div>
                    <input id="addr1" name="addr1" type="addr1" autocomplete="addr1" required=""
                        v-model="user.address.address"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Address" />
                </div>
                <div class="flex justify-between text-m mb-2">
                    <div class="w-36">Postal Code </div>
                    <input id="addr2" name="addr2" type="addr2" autocomplete="addr2" required=""
                        v-model="user.address.postcode"
                        class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Postal Code" />
                </div>
                <div class="rounded-md shadow-sm ">
                    <div class="flex justify-between text-m mb-2">
                        <div class="w-36">Gender </div>
                        <input id="gender" name="gender" type="gender" autocomplete="gender" required=""
                            v-model="user.gender"
                            class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="Gender" disabled />
                    </div>
                    <div class="w-36 mb-2 mt-4">Academic title </div>
                    <TInput name="academic_title" v-model="user.academic_title" :errors="errors"
                        placeholder="Academic Title" inputClass="rounded-t-md" />
                    <div class="w-36 mt-4 mb-2">Main Qualification </div>
                    <TInput name="main_qualification" v-model="user.qualifications.main_qualification" :errors="errors"
                        placeholder="Main Qualification" inputClass="rounded-t-md" />
                        <div class="w-36 mt-4 mb-2">Sub Qualification </div>
                    <TInput name="other_qualification" v-model="user.qualifications.other_qualification"
                        :errors="errors" placeholder="Other Qualification" inputClass="rounded-t-md" />
                        <div class="w-36 mt-4 mb-2">Summary </div>
                    <div class="mt-1 mb-1">
                        <textarea id="description" name="description" rows="3" v-model="user.summary"
                            autocomplete="survey_description"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                            placeholder="Summary of Doctor's career" />
                    </div>
                    <div class="w-36 mt-4 mb-2">Experience </div>
                    <TInput name="experience" v-model="user.experience" :errors="errors"
                        placeholder="Years of experience" inputClass="rounded-t-md" />


                    <div class="col-span-3 mt-5 mb-5">
                        <label for="userType" class="block text-sm font-medium text-gray-700">Choose a main specialty
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
                        <label for="userType" class="block text-sm font-medium text-gray-700">Choose a sub specialty
                        </label>
                        <select id="userType" name="userType" v-model="user.specialty.sub_specialty"
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
                <div class="justify-between text-m mt-6 mb-6">
                    <button @click="updateProfile(user)"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Confirm
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
import { computed, ref } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import TInput from "../../components/core/TInput.vue";
import Alert from "../../components/Alert.vue";

const store = useStore();
const router = useRouter();
const loading = computed(() => store.state.dashboard.loading);
const data = computed(() => store.state.dashboard.data);
const user = computed(() => store.state.user.data);

const institutes = computed(() => store.state.institute.instituition_list);
const specialties = computed(() => store.state.specialty.specialty_list);

const errors = ref({});

store.dispatch("getInstituteData");
store.dispatch("getSpecialtyData");

function updateProfile(ev) {
    console.log(ev)
    store.dispatch("updateUser", ev).then((res) => {
        console.log("Res after Update profile", res)
        router.push({
            name: "DoctorProfile",
        });

    })
}
</script>
    
<style scoped>

</style>
    