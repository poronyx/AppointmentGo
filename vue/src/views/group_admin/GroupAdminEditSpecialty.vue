<template>
    <PageComponent title="Group Admin Edit Specialty">
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
                    <TInput name="name" v-model="editSpecialty.name" :errors="errors"
                        placeholder="Name of Specialty" inputClass="rounded-t-md" />
                    <TInput name="addr" v-model="editSpecialty.description" :errors="errors"
                        placeholder="Specialty Description" />
                    
                    <div class="inset-0 flex items-center justify-center mt-8">
                        <TButtonLoading :loading="loading" class=" relative justify-center" @click="updateSpecialty(editSpecialty)">
                            Update Specialty
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
import { computed } from "vue";

const router = useRouter();
const editSpecialty = computed(() => store.state.specialty.editData);


const loading = ref(false);
const errors = ref({});

function updateSpecialty(specialty) {

    console.log("User Input: ",specialty);

    store
    .dispatch("updateSpecialty", specialty)
    .then(() => {
      loading.value = false;
      router.push({
        name: "GroupAdminManageSpecialty",
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

</script>
    
<style scoped>

</style>
    