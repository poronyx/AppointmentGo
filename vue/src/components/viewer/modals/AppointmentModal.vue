<template>

  <div class="inset-0 flex items-center justify-center">
    <button type="button" @click="openModal"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">
      Make Appointment
    </button>
  </div>

  <TransitionRoot appear :show="isOpen" as="template">

    <Dialog v-if="type == 'on-site'" as="div" @close="closeModal" class="relative z-10" :key="on - site">
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
                  <label for="instituition" class="block text-sm font-medium text-gray-700">Select an institute
                  </label>
                  <select id="instituition" name="instituition" v-model="makeAppointmentData.instituition_id"
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
                    <option v-for="institute in institutes" :key="institute" :value="institute.id">
                      {{ institute.instituition_name }}
                    </option>
                  </select>
                </div>

                <div v-if="showDoc" class="col-span-3">

                  <label for="doctorChoose" class="block text-sm font-medium text-gray-700">Choose a Doctor
                  </label>
                  <select id="doctorChoose" name="doctorChoose" v-model="makeAppointmentData.owner_id"
                    @change="pickedDoctor($event.target.value)" class="
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
                    <option v-for="doc in doctorsFromInst" :key="doc" :value="doc.id">
                      {{ doc.name }}
                    </option>
                  </select>
                </div>
              </div>
              <div v-if="showDates" class="col-span-3">
                <label for="dates" class="block text-sm font-medium text-gray-700">Pick a Date
                </label>
                <TInput type="date" name="date_of_birth" v-model="makeAppointmentData.date" :errors="errors"
                  placeholder="dd/mm/yyyy" @change="pickedDate(makeAppointmentData, 'on-site')" />
              </div>
              <div v-if="showSlots" class="col-span-3">

                <label for="timeSlots" class="block text-sm font-medium text-gray-700">Pick a time
                </label>
                <select id="timeSlots" name="timeSlots" v-model="makeAppointmentData.time"
                  @change="pickedTimeSlot(time)" class="
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
                  <option v-for="time in slotAvailablityData" :key="time" :value="time.key">
                    {{ time.time }}
                  </option>
                </select>
              </div>

              <div v-if="showButton" class="mt-4">
                <label for="timeSlots" class="block text-sm font-medium text-gray-700">Symptoms
                </label>
                <input id="email-address" name="email" type="email" autocomplete="email" required="" v-model="makeAppointmentData.symptoms"
                class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm mb-6"
                placeholder="Symptoms" />
                <button type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="makeOnSiteAppointment">
                  Make on-site appointment
                </button>
              </div>
              <TransitionRoot appear :show="isOpenAlert" as="template">
                <Dialog as="div" class="relative z-10" :key="on - site">
                  <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
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
                                On-site Appointment Successfully made!!
                              </div>
                              <div class="order-2 lg:order-2 ">
                                <button type="button" class="float-right" @click="closeModal()"> X
                                </button>
                              </div>

                            </div>
                          </DialogTitle>
                          <div class="mt-1">
                            <div class="col-span-3">
                              <label for="instituition" class="block text-sm font-medium text-gray-700">
                                Your booking details will be sent to you shortly via email
                              </label>
                            </div>
                          </div>

                          <div class="mt-4">
                            <button type="button"
                              class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                              @click="routeToHome">
                              Confirm
                            </button>
                          </div>


                        </DialogPanel>

                      </TransitionChild>
                    </div>
                  </div>


                </Dialog>
              </TransitionRoot>
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
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mb-9">
                  <div class="order-1 lg:order-1">
                    Home-visit Appointment
                  </div>
                  <div class="order-2 lg:order-2 ">
                    <button type="button" class="float-right" @click="closeModal()"> X
                    </button>
                  </div>

                </div>
              </DialogTitle>
              <div class="mt-1">


                <div class="col-span-3">
                  <label for="specialty" class="block text-sm font-medium text-gray-700">Select Specialty
                  </label>
                  <select id="specialty" name="specialty" v-model="specialtyChosen"
                    @change="pickedSpec($event.target.value)" class="
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
                    <option v-for="spec in specialties" :key="spec" :value="spec.id">
                      {{ spec.name }}
                    </option>
                  </select>
                </div>

                <div v-if="showDoc" class="col-span-3">

                  <label for="doctorChoose" class="block text-sm font-medium text-gray-700">Choose a Doctor
                  </label>
                  <select id="doctorChoose" name="doctorChoose" v-model="makeAppointmentData.owner_id"
                    @change="pickedDoctor($event.target.value)" class="
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
                    <option v-for="doc in doctorsFromSpecialty" :key="doc" :value="doc.id">
                      {{ doc.name }}
                    </option>
                  </select>
                </div>
              </div>
              <div v-if="showDates" class="col-span-3">
                <label for="dates" class="block text-sm font-medium text-gray-700">Pick a Date
                </label>
                <TInput type="date" name="date_of_birth" v-model="makeAppointmentData.date" :errors="errors"
                  placeholder="dd/mm/yyyy" @change="pickedDate(makeAppointmentData, 'home-visit')" />
              </div>
              <div v-if="showSlots" class="col-span-3">

                <label for="timeSlots" class="block text-sm font-medium text-gray-700">Pick a time
                </label>
                <select id="timeSlots" name="timeSlots" v-model="makeAppointmentData.time"
                  @change="pickedTimeSlot(time)" class="
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
                  <option v-for="time in slotAvailablityData" :key="time" :value="time.key">
                    {{ time.time }}
                  </option>
                </select>
              </div>
              

              <div v-if="showButton" class="mt-4">
                <label for="timeSlots" class="block text-sm font-medium text-gray-700">Symptoms
                </label>
                <input id="email-address" name="email" type="email" autocomplete="email" required="" v-model="makeAppointmentData.symptoms"
                class="relative w-full h-9 px-3 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm mb-6"
                placeholder="Symptoms" />
                <button type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="makeHomeVisitAppointment">
                  Make home-visit appointment
                </button>
              </div>
              <TransitionRoot appear :show="isOpenAlert" as="template">
                <Dialog as="div" class="relative z-10" :key="on - site">
                  <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
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
                                Home-visit Appointment Successfully made!!
                              </div>
                              <div class="order-2 lg:order-2 ">
                                <button type="button" class="float-right" @click="closeModal()"> X
                                </button>
                              </div>

                            </div>
                          </DialogTitle>
                          <div class="mt-1">
                            <div class="col-span-3">
                              <label for="instituition" class="block text-sm font-medium text-gray-700">
                                Your booking details will be sent to you shortly via email
                              </label>
                            </div>
                          </div>

                          <div class="mt-4">
                            <button type="button"
                              class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                              @click="routeToHome">
                              Confirm
                            </button>
                          </div>


                        </DialogPanel>

                      </TransitionChild>
                    </div>
                  </div>


                </Dialog>
              </TransitionRoot>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>

    </Dialog>


  </TransitionRoot>
</template>
  
<script setup>
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogTitle,
} from '@headlessui/vue'
import { useRouter } from "vue-router";
import TInput from "../../core/TInput.vue";
import { computed, ref } from "@vue/reactivity";
import { useStore } from "vuex";


const store = useStore();

const user = computed(() => store.state.user.data);
const institutes = computed(() => store.state.institute.instituition_list);
const doctorsFromInst = computed(() => store.state.patientMakeAppointment.doctorsFromInstitute);
const doctorsFromSpecialty = computed(() => store.state.patientMakeAppointment.doctorsFromSpecialty);
const makeAppointmentData = computed(() => store.state.patientMakeAppointment.makeAppointmentData);
const slotAvailablityData = computed(() => store.state.patientMakeAppointment.slotAvailability);
const specialties = computed(() => store.state.specialty.specialty_list);

store.dispatch("getUser");
store.dispatch("getInstituteData");
store.dispatch("getSpecialtyData");

const patientID = user.value.id
console.log(patientID)







const doctorData = []

//Get a list of all Doctors

// store.dispatch("getAllDoctors").then((res) => {

//   console.log("all doctors appointment: ", res.data.doctors)
//   for (let doctor in res.data.doctors) {
//     console.log(res.data.doctors[doctor])
//     doctorData.push(res.data.doctors[doctor])
//   }
//   console.log("doctors Data", doctorData)
// })

let specialtyChosen = ""
let instituitionPicked = ""


const onSite = [{
  instituition: "Bukit Panjang Clinic",
  doctors: ["Doct. Tan Seng Heng", "Doct. Lim Wong Kee"]

}, {
  instituition: "Newton Clinic",
  doctors: ["Doct. Kim Song Min"],
}
]

let date_appointment = "";
let specialty = ["Common Practitioner", "Cardiology", "Allergy and immunology", "Physiology", "Anesthesiology", "Dermatology"]
let doctorList = ["--Not Specified--", "Doct. Tan Seng Heng", "Doct. Lim Wong Kee"];
let doctorPicked = "";
let timePicked = "";
let specPicked = "";
let timeSlots = ["8:00-8:30", "8:30-9:00", "9:00-9:30", "9:30-10:00", "10:00-10:30", "10:30-11:00",
  "11:00-11:30", "11:30-12:00", "3:00-3:30", "3:30-4:00", "4:00-4:30", "4:30-5:00", "5:00-5:30", "5:30-6:00"]

const props = defineProps({
  type: String
});

const isOpen = ref(false)
const isOpenAlert = ref(false)
const showDoc = ref(false)
const showButton = ref(false)
const showDates = ref(false)
const showSlots = ref(false)
const router = useRouter();
const errors = ref({});

function pickedInstitute(picked) {
  instituitionPicked = picked

  console.log("Inst picked id: ", picked)

  showDoc.value = true;

  const param = {
    instituition_id: picked
  }
  //Get Doctor From picked institute
  store.dispatch("getDoctorsFromInstitute", param).then((res) => {

    console.log("Doctors After picking institute: ", res.doctors)
    for (let doctor in res.doctors) {
      doctorData.push(res.doctors[doctor])
    }

  })
}

function pickedDoctor(picked) {
  console.log(picked)
  doctorPicked = picked
  showDates.value = true;
}
function pickedDate(event, appointmentType) {
  showSlots.value = true

  let param = {}
  if (appointmentType == "on-site") {
    param = {
      "institute_id": event.instituition_id,
      "owner_id": event.owner_id,
      "date": event.date,
      "appointment_type": "on-site"
    }
  } else if (appointmentType == "home-visit") {
    param = {
      "owner_id": event.owner_id,
      "date": event.date,
      "appointment_type": "home-visit"
    }
  }

  //Get Available slots from selected date doctor
  console.log("Appointment Data", event.instituition_id)
  console.log("Appointment Data", event.owner_id)
  console.log("Appointment Data", event.date)
  store
    .dispatch("getAvailabilityData", param).then((res) => {
      console.log(res.data.final_slots)
      store.commit("setAvailableSlots", res.data.final_slots)
    })
}
function pickedTimeSlot(picked) {
  console.log(picked)
  showButton.value = true;
  timePicked = picked;




}


function closeModal() {
  isOpen.value = false
  isOpenAlert.value = false
  resetFields()
}
function openModal() {
  isOpen.value = true
}
function makeOnSiteAppointment() {



  const param = {
    "appointment_type": "on-site",
    "patient_id": makeAppointmentData.value.patient_id,
    "instituition_id": makeAppointmentData.value.instituition_id,
    "owner_id": makeAppointmentData.value.owner_id,
    "appointment_date": makeAppointmentData.value.date,
    "time": makeAppointmentData.value.time,
    "symptoms": makeAppointmentData.value.symptoms
  }

  console.log("successfully submitted", param)

  store
    .dispatch("makeAppointment", param).then((res) => {
      console.log("making appointment res", res)

      resetFields()
      isOpenAlert.value = true

    })

}

function resetFields() {
  makeAppointmentData.value.instituition_id = ""
  makeAppointmentData.value.owner_id = ""
  makeAppointmentData.value.date = ""
  makeAppointmentData.value.time = ""
  showDoc.value = false;
  showDates.value = false;
  showSlots.value = false
  showButton.value = false;
}
function makeHomeVisitAppointment() {
  console.log("successfully submitted")
  const param = {
    "appointment_type": "home-visit",
    "patient_id": makeAppointmentData.value.patient_id,
    "owner_id": makeAppointmentData.value.owner_id,
    "appointment_date": makeAppointmentData.value.date,
    "time": makeAppointmentData.value.time,
    "symptoms": makeAppointmentData.value.symptoms
  }

  console.log("successfully submitted", param)

  store
    .dispatch("makeAppointment", param).then((res) => {
      console.log("making appointment res", res)

      resetFields()
      isOpenAlert.value = true

    })
}

function pickedSpec(picked) {
  console.log(picked)
  console.log("selected: ", picked)
  specPicked = picked;
  showDoc.value = true;

  const param = {
    specialty_id: picked
  }

  //Get Doctor From picked institute
  store.dispatch("getDoctorsFromSpecialty", param).then((res) => {

    console.log("Doctors After picking Specialty: ", res.doctors)
    for (let doctor in res.doctors) {
      doctorData.push(res.doctors[doctor])
    }

  })
}

function routeToHome() {

  router.push({
    name: "PatientDashboard",
  });
}

</script>