<template>

  <div class="inset-0 flex items-center justify-center">
    <button type="button" @click="openModal"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">
      Make Appointment
    </button>
  </div>

  <TransitionRoot appear :show="isOpen" as="template">

    <Dialog v-if="type == 'on-site'" as="div" @close="closeModal" class="relative z-10">
      <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
        leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-black bg-opacity-25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
          <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95">
            <DialogPanel
              class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
              <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mb-9">
                  <div class="order-1 lg:order-1">
                    On-Site Appointment
                  </div>
                  <div class="order-2 lg:order-2 ">
                    <button type="button" class="float-right" @click="closeModal()"> X
                    </button>
                  </div>

                </div>
              </DialogTitle>
              <div class="mt-1">


                <div class="col-span-3">
                  <label  for="instituition" class="block text-sm font-medium text-gray-700">Select an institute
                  </label>
                  <select id="instituition" name="instituition"  @change="emits('update:institute', $event.target.value)" class="
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
                    <option v-for="place in instituition" :key="place" :value="place" >
                      {{ upperCaseFirst(place) }}
                    </option>
                  </select>
                </div>
                
                  <div class="col-span-3" v-if=" instituitionPicked != null" >
                    <label  for="doctorChoose" class="block text-sm font-medium text-gray-700">Choose Doctor(optional)
                    </label>
                    <select  id="doctorChoose" name="doctorChoose" v-model="doctorChoose" class="
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
                      <option v-for="doctor in doctorChoose" :key="doctor" :value="doctor">
                        {{ upperCaseFirst(doctor) }}
                      </option>
                    </select>
                  </div>
                </div>

              <div class="mt-4">
                <button type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="makeOnSiteAppointment">
                  Make on-site appointment
                </button>
              </div>


            </DialogPanel>

          </TransitionChild>
        </div>
      </div>
    </Dialog>
    <Dialog v-else-if="type == 'home-visit'" as="div" @close="closeModal" class="relative z-10">

      <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
        leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-black bg-opacity-25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
          <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95">
            <DialogPanel
              class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
              <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                Home-Visit Appointment
              </DialogTitle>
              <div class="mt-2">
                <p class="text-sm text-gray-500">
                  Your payment has been successfully submitted. We’ve sent you
                  an email with all of the details of your order.
                </p>
              </div>

              <div class="mt-4">
                <button type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="closeModal">
                  home-visit
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>

    </Dialog>


  </TransitionRoot>
</template>
  
<script setup>
import { ref } from 'vue'
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogTitle,
} from '@headlessui/vue'
import TButtonLoading from '../core/TButtonLoading.vue';
import TInput from '../core/TInput.vue';

const instituition = ["Bukit Panjang Clinic", "Newton Clinic"]
let instituitionPicked = "";
const emits = defineEmits(["update:institute"]);
const props = defineProps({
  type: String
});
const isOpen = ref(false)

let model = ref({});

  emits("update:institute", instituitionPicked);


function closeModal() {
  isOpen.value = false
}
function openModal() {
  isOpen.value = true
}
function makeOnSiteAppointment() {
  console.log("successfully submitted")
  closeModal()
  console.log(instituitionPicked)
}
function upperCaseFirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

</script>