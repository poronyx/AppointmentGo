<template>
    <PageComponent title="Group Admin Create Institute">
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



                <div class="col-span-3 mb-8">
                    <label for="userType" class="block text-sm font-medium text-gray-700">Choose an Institution Type
                    </label>
                    <select id="instituition_type" name="instituition_type" v-model="institute.instituition_type"
                        @change="pickedInstituteType($event.target.value)" class="
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
                        <option v-for="instituteType in instituteTypes" :key="instituteType" :value="instituteType">
                            {{ instituteType }}
                        </option>
                    </select>
                </div>
                <div class="rounded-md shadow-sm ">
                    <TInput name="name" v-model="institute.instituition_name" :errors="errors"
                        placeholder="Institute Name" inputClass="rounded-t-md" />
                    <TInput name="addr" v-model="institute.instituition_addr" :errors="errors"
                        placeholder="Institute Address" />
                    <TInput name="phone" v-model="institute.instituition_phone" :errors="errors"
                        placeholder="Institute Contact No." />
                    <TInput name="desc" v-model="institute.instituition_desc" :errors="errors"
                        placeholder="Institute Description " />
                    <TInput name="lat" v-model="institute.location.lat" :errors="errors" placeholder="Institute lat" />
                    <TInput name="lon" v-model="institute.location.lng" :errors="errors" placeholder="Institute lon" />
                    <div class="col-span-3 mb-8 mt-5">
                        <label for="userType" class="block text-sm font-medium text-gray-700 mb-3">Choose First opening
                            time
                        </label>
                        <label for="userType" class="block text-sm font-medium text-gray-700">From :
                        </label>
                        <select id="time1" name="time1" v-model="institute.opening_time.first[0]"
                            @change="pickedTime1($event.target.value)" class="
          mt-1
          mb-2
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
                            <option v-for="time1 in timeSlots1" :key="time1" :value="time1.key">
                                <p>{{ time1.time }}</p>
                            </option>
                        </select>
                        <label for="userType" class="block text-sm font-medium text-gray-700">To :
                        </label>
                        <select v-if="time1Picked" id="time2" name="time2" v-model="institute.opening_time.first[1]"
                            @change="pickedTime2($event.target.value)" class="
          mt-1
          mb-2
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
                            <option v-for="time2 in timeSlots2" :key="time2" :value="time2.key">
                                {{ time2.time }}
                            </option>
                        </select>
                    </div>
                    <div v-if="time2Picked" class="col-span-3 mb-8 mt-5">
                        <label for="userType" class="block text-sm font-medium text-gray-700 mb-3">Choose Second opening
                            time
                        </label>
                        <label for="userType" class="block text-sm font-medium text-gray-700">From :
                        </label>
                        <select id="time3" name="time3" v-model="institute.opening_time.second[0]"
                            @change="pickedTime3($event.target.value)" class="
          mt-1
          mb-2
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
                            <option v-for="time3 in timeSlots3" :key="time3" :value="time3.key">
                                {{ time3.time }}
                            </option>
                        </select>
                        <label for="userType" class="block text-sm font-medium text-gray-700">To :
                        </label>
                        <select v-if="time3Picked" id="instituition_type" name="instituition_type"
                            v-model="institute.opening_time.second[1]" @change="pickedTime4($event.target.value)" class="
          mt-1
          mb-2
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
                            <option v-for="time4 in timeSlots4" :key="time4" :value="time4.key">
                                {{ time4.time }}
                            </option>
                        </select>
                    </div>
                    <div class="inset-0 flex items-center justify-center mt-8">
                        <TButtonLoading :loading="loading" class=" relative justify-center" @click="createInstitute">
                            Create an institute
                        </TButtonLoading>
                    </div>
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
import { ref, computed } from "vue";
import store from "../../store";
import { useRouter } from "vue-router";
const router = useRouter();

const instituteTypes = ["Clinic", "Hospital"]



//set time slot in store for creation
store.commit("setTimeSlotForCreateInstitute1")
const timeSlots1 = computed(() => store.state.groupAdminManageInstitute.time_slot1);
const timeSlots2 = computed(() => store.state.groupAdminManageInstitute.time_slot2);
const timeSlots3 = computed(() => store.state.groupAdminManageInstitute.time_slot3);
const timeSlots4 = computed(() => store.state.groupAdminManageInstitute.time_slot4);
const storeInstitute = computed(() => store.state.institute.data);

const institute = {
    instituition_type: "",
    instituition_name: "",
    instituition_addr: "",
    instituition_phone: "",
    instituition_desc: "",
    location: {
        lat: "",
        lng: ""
    },
    opening_time: {
        first: [0, 0],
        second: [0, 0]
    },
    organization_id: "1",

};
const loading = ref(false);
const errors = ref({});
const time1Picked = ref(false)
const time2Picked = ref(false)
const time3Picked = ref(false)


function createInstitute(ev) {
    ev.preventDefault();

    console.log("User Input: ", institute);

    store
        .dispatch("createInstitute", institute)
        .then(() => {

            const param = {
                owner_id: storeInstitute.value.id,
                opening_time: {
                    first: [storeInstitute.value.opening_time.first[0], storeInstitute.value.opening_time.first[1]],
                    second: [storeInstitute.value.opening_time.second[0], storeInstitute.value.opening_time.second[1]]
                },
                owner_type: "Institute"
            }
            console.log("ID: ", )
            console.log("res after api call: ", storeInstitute.value.opening_time.first)
            console.log("res after api call: ", storeInstitute.value.opening_time.second)
            store.dispatch("generateSlots",param);
            loading.value = false;
            router.push({
                name: "GroupAdminManageInstitute",
            });
        })
        .catch((error) => {
            console.log(error);
            loading.value = false;
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        });
}

function pickedInstituteType(ev) {
    console.log("Picked Institute: ", ev)

}
function pickedTime1(time) {
    console.log("Time 1 picked: ", time)

    store.commit("setTimeSlotForCreateInstitute2", parseInt(time))
    time1Picked.value = true;

}
function pickedTime2(time) {
    console.log("Time 2 picked: ", time)

    store.commit("setTimeSlotForCreateInstitute3", parseInt(time))
    time2Picked.value = true;

}
function pickedTime3(time) {
    console.log("Time 3 picked: ", time)

    store.commit("setTimeSlotForCreateInstitute4", parseInt(time))
    time3Picked.value = true;

}

function pickedTime4(time) {
    console.log("Time 3 picked: ", time)

}



</script>
    
<style scoped>

</style>
    