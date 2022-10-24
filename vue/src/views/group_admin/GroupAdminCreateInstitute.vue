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
import { ref } from "vue";
import store from "../../store";
import { useRouter } from "vue-router";
const router = useRouter();

const instituteTypes = ["Clinic", "Hospital"]
const institute = {
    instituition_type: "",
    instituition_name: "",
    instituition_addr: "",
    instituition_phone: "",
    instituition_desc: "",
    location: {
        lat: "", 
        lng: ""
    }

};
const loading = ref(false);
const errors = ref({});

function createInstitute(ev) {
    ev.preventDefault();

    console.log("User Input: ",institute);

    store
    .dispatch("createInstitute", institute)
    .then(() => {
      loading.value = false;
      router.push({
        name: "PatientDashboard",
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

</script>
    
<style scoped>

</style>
    