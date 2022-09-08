<template>
  <div>
    <div>
      <img
        class="mx-auto h-12 w-auto"
        src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
        alt="Workflow"
      />
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Register for free
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        Or
        {{ " " }}
        <router-link
          :to="{ name: 'Login' }"
          class="font-medium text-indigo-600 hover:text-indigo-500"
        >
          login to your account
        </router-link>
      </p>
    </div>
    <form class="mt-8 space-y-6" @submit="register">
      <Alert
        v-if="Object.keys(errors).length"
        class="flex-col items-stretch text-sm"
      >
        <div v-for="(field, i) of Object.keys(errors)" :key="i">
          <div v-for="(error, ind) of errors[field] || []" :key="ind">
            * {{ error }}
          </div>
        </div>
      </Alert>

      <input type="hidden" name="remember" value="true" />
      <div class="rounded-md shadow-sm -space-y-px">
        <TInput
          name="name"
          v-model="user.name"
          :errors="errors"
          placeholder="Full Name"
          inputClass="rounded-t-md"
        />
        <TInput
          type="email"
          name="email"
          v-model="user.email"
          :errors="errors"
          placeholder="Email Address"
        />
        <TInput
          name="race"
          v-model="user.race"
          :errors="errors"
          placeholder="Race"
        />
        <input
          type="text"
          name="phone_number"
          v-model="user.phone_number"
          minlength="8"
          maxlength="8"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          placeholder="Phone number"
        />
        <TInput
          name="nric"
          v-model="user.nric"
          :errors="errors"
          placeholder="NRIC/FIN"
        />
        <TInput
          type="selected"
          name="gender"
          v-model="user.gender"
          :errors="errors"
          placeholder="Gender"
        />
        <TInput
          type="date"
          name="date_of_birth"
          v-model="user.date_of_birth"
          :errors="errors"
          placeholder="dd/mm/yyyy"
        />
        <TInput
          type="password"
          name="password"
          v-model="user.password"
          :errors="errors"
          placeholder="Password"
        />
        <TInput
          type="password"
          name="password_confirmation"
          v-model="user.password_confirmation"
          :errors="errors"
          placeholder="Confirm Password"
          inputClass="rounded-b-md"
        />
      </div>
      <div>
        <TButtonLoading
          :loading="loading"
          class="w-full relative justify-center"
        >
          Sign up
        </TButtonLoading>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { LockClosedIcon } from "@heroicons/vue/solid";
import store from "../store";
import { useRouter } from "vue-router";
import TButtonLoading from "../components/core/TButtonLoading.vue";
import TInput from "../components/core/TInput.vue";
import Alert from "../components/Alert.vue";

const router = useRouter();
const user = {
  name: "",
  email: "",
  race: "",
  phone_number: "",
  nric: "",
  gender: "",
  user_type: "patient", //register is only for patient 
  date_of_birth: "",
  password: "",
};
const loading = ref(false);
const errors = ref({});

function register(ev) {
  ev.preventDefault();
  loading.value = true;
  store
    .dispatch("register", user)
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

</script>
