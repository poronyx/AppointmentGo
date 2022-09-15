<template>
  <header class="bg-white shadow">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

      <h1 v-if="title" class="text-3xl font-bold text-gray-900 w-70">
        {{ title }}
      </h1>

      <TButton v-if="appointment" :to="{ name: 'PatientMakeAppointment'}" link>
        <PencilIcon class="w-5 h-5 mr-2" />
        Make an Appointment with us
      </TButton>


      <slot name="header"></slot>
    </div>

  </header>
  <main>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <!-- Replace with your content -->
      <div class="px-4 sm:px-0">
        <slot></slot>
      </div>
      <!-- /End replace -->
    </div>
  </main>
</template>

<script setup>
import { PencilIcon } from "@heroicons/vue/solid";
import TButton from "./core/TButton.vue"
const props = defineProps({
  title: String,
  appointment: String,
});
</script>

<style>

</style>
