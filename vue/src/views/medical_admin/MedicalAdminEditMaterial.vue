<template>
    <PageComponent title="Edit Material">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <!-- Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Image
                    </label>
                    <div class="mt-1 flex items-center">
                        <img v-if="model.image_url" :src="model.image_url" :alt="model.title"
                            class="w-64 h-48 object-cover" />
                        <span v-else
                            class="flex items-center justify-center h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-[80%] w-[80%] text-gray-300"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <button type="button"
                            class="relative overflow-hidden ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <input type="file" @change="onImageChoose"
                                class="absolute left-0 top-0 right-0 bottom-0 opacity-0 cursor-pointer" />
                            Change
                        </button>
                    </div>
                </div>
                <!--/ Image -->

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" v-model="editMaterialData.title"
                        autocomplete="survey_title"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>
                <!--/ Title -->

                <!-- Description -->
                <div>
                    <label for="about" class="block text-sm font-medium text-gray-700">
                        Description
                    </label>
                    <div class="mt-1">
                        <textarea id="description" name="description" rows="3" v-model="editMaterialData.description"
                            autocomplete="survey_description"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                            placeholder="Describe your article" />
                    </div>
                </div>
                <!-- Description -->
                <!-- Description -->
                <div>
                    <label for="about" class="block text-sm font-medium text-gray-700">
                        Content
                    </label>
                    <div class="mt-1">
                        <textarea id="description" name="description" rows="3" v-model="editMaterialData.content"
                            autocomplete="survey_description"
                            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                            placeholder="Content of your article" />
                    </div>
                </div>
                <!-- Description -->

                <div class="inset-0 flex items-center justify-center">
                    <button type="button" @click="editMaterial()"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">
                        Edit Material
                    </button>
                </div>
            </div>

        </div>
    </PageComponent>
</template>
    
<script setup>
import { v4 as uuidv4 } from "uuid";
import { computed, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import { SaveIcon, TrashIcon, ExternalLinkIcon } from '@heroicons/vue/solid'
import PageComponent from "../../components/PageComponent.vue";
import { useStore } from "vuex";


const router = useRouter();
const store = useStore();

const route = useRoute();
const loading = computed(() => store.state.dashboard.loading);
const editMaterialData = computed(() => store.state.material.editData);


let model = ref({
    title: "",
    description: null,
    image: null,
    image_url: "https://appointmentgo.net/" + editMaterialData.value.image_url,
});

let fileChanged = false;

let articleData = {
    title: "",
    description: "",
    content: "",
    image: ""
}

function onImageChoose(ev) {
    fileChanged = true
    const file = ev.target.files[0];
    console.log(file)
    const reader = new FileReader();
    reader.onload = () => {
        // The field to send on backend and apply validations
        model.value.image = reader.result;

        // The field to display here
        model.value.image_url = reader.result;
        ev.target.value = "";

        console.log("Image URL", reader)
        articleData.image = reader.result
    };
    reader.readAsDataURL(file);


}
console.log("Image URL", model.value.image_url)

function editMaterial() {
    console.log(editMaterialData)
    let param = {}

    if (fileChanged) {
        param = {
            id: editMaterialData.value.id,
            file_changed: fileChanged,
            title: editMaterialData.value.title,
            description: editMaterialData.value.description,
            content: editMaterialData.value.content,
            image: articleData.image

        }
    } else {
        param = {
            id: editMaterialData.value.id,
            file_changed: fileChanged,
            title: editMaterialData.value.title,
            description: editMaterialData.value.description,
            content: editMaterialData.value.content,

        }
    }

    console.log(param)
    store.dispatch("updateMaterial", param).then((res) => {
        router.push({
            name: "MedicalAdminManageEducationalMaterial",
        });
    })


}
</script>
    
<style scoped>

</style>
    