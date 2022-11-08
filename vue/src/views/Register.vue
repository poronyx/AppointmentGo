<template>
  <div>
    <div>
      <img
        class="mx-auto h-17 w-auto"
        src="/src/assets/Logo2.png"
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
        <div class="col-span-3 mt-5 mb-5">
                        <label for="genderType" class="block text-sm font-medium text-gray-700">Choose a Gender
                        </label>
                        <select id="genderType" name="genderType" v-model="user.gender" class="
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
        <TInput
          type="date"
          name="date_of_birth"
          v-model="user.date_of_birth"
          :errors="errors"
          placeholder="dd/mm/yyyy"
        />
        <TInput
          name="address"
          v-model="addr.address"
          :errors="errors"
          placeholder="Please Enter your address"
        />
        <input
          type="text"
          name="postcode"
          v-model="addr.postcode"
          minlength="6"
          maxlength="6"
          class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
          placeholder="Postal Code"
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
const genderTypes = ["Male", "Female", "Others"]

const addr = {
  "postcode" : "",
  "address" : ""
}

const user = {
  name: "",
  email: "",
  race: "",
  phone_number: "",
  nric: "",
  gender: "",
  user_type: "Patient", //register is only for patient 
  date_of_birth: "",
  password: "",
  address: addr,
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
