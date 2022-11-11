<template>
    <div v-if="$route.params.subType == 1">
        <div>
            <img class="mx-auto h-17 w-auto" src="/src/assets/Logo2.png" alt="Workflow" />
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Basic Plan
            </h2>
            <h4 class="mt-6 text-center text-l font-extrabold text-gray-900 mb-8">
                $39.99/month
            </h4>
        </div>

        <Alert v-if="Object.keys(errors).length" class="flex-col items-stretch text-sm">
            <div v-for="(field, i) of Object.keys(errors)" :key="i">
                <div v-for="(error, ind) of errors[field] || []" :key="ind">
                    * {{ error }}
                </div>
            </div>
        </Alert>

        <input type="hidden" name="remember" value="true" />
        <div class="rounded-md shadow-sm -space-y-px">
            <TInput name="companyName" v-model="user.company_name" :errors="errors" placeholder="Company Name"
                inputClass="rounded-t-md" />
            <TInput name="name" v-model="user.name" :errors="errors" placeholder="Full Name" />
            <TInput type="email" name="email" v-model="user.email" :errors="errors" placeholder="Email Address" />
            <TInput type="password" name="password" v-model="user.password" :errors="errors" placeholder="Password" />
            <TInput type="password" name="password_confirmation" v-model="user.password_confirmation" :errors="errors"
                placeholder="Confirm Password" inputClass="rounded-b-md" />
        </div>
        <div>

            <p>Credit Card Number</p>
            <TInput name="name" v-model="valueFields.cardName" :errors="errors" placeholder="Number" />
            <p>Name on Card</p>
            <TInput name="name" v-model="valueFields.cardNumber" :errors="errors" placeholder="Name" />
            <div class="flex justify-between text-m mb-2">
                <div class="col-span-3 mt-3 mb-5">
                    <label for="month" class="block text-sm font-medium text-gray-700"> Month
                    </label>
                    <select id="month" name="month" v-model="valueFields.cardMonth" class="
          mt-1
          block
          w-full
          py-2
          px-8
          border border-gray-300
          bg-white
          rounded-md
          shadow-sm
          focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
          sm:text-sm
        ">
                        <option v-for="month in Months" :key="month" :value="month.key">
                            {{ month.name }}
                        </option>
                    </select>
                </div>
                <div class="col-span-3 mt-3 mb-5">
                    <label for="year" class="block text-sm font-medium text-gray-700"> Year
                    </label>
                    <select id="year" name="year" v-model="valueFields.cardYear" class="
          mt-1
          block
          w-full
          py-2
          px-9
          border border-gray-300
          bg-white
          rounded-md
          shadow-sm
          focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
          sm:text-sm
        ">
                        <option v-for="yr in Year" :key="yr" :value="yr">
                            {{ yr }}
                        </option>
                    </select>
                </div>
                <div class="col-span-3 mt-3 mb-5">
                    <label for="genderType" class="block text-sm font-medium text-gray-700"> CVC
                    </label>
                    <TInput name="name" v-model="valueFields.cardCvv" :errors="errors" placeholder="" />
                </div>
            </div>
            <PaymentModal :user="user" :valueFields="valueFields" :type="1">

            </PaymentModal>


        </div>
    </div>
    <div v-if="$route.params.subType == 2">
        <div>
            <img class="mx-auto h-17 w-auto" src="/src/assets/Logo2.png" alt="Workflow" />
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Premium Plan
            </h2>
            <h4 class="mt-6 text-center text-l font-extrabold text-gray-900 mb-8">
                $59.99/month
            </h4>
        </div>

        <Alert v-if="Object.keys(errors).length" class="flex-col items-stretch text-sm">
            <div v-for="(field, i) of Object.keys(errors)" :key="i">
                <div v-for="(error, ind) of errors[field] || []" :key="ind">
                    * {{ error }}
                </div>
            </div>
        </Alert>

        <input type="hidden" name="remember" value="true" />
        <div class="rounded-md shadow-sm -space-y-px">
            <TInput name="companyName" v-model="user.company_name" :errors="errors" placeholder="Company Name"
                inputClass="rounded-t-md" />
            <TInput name="name" v-model="user.name" :errors="errors" placeholder="Full Name" />
            <TInput type="email" name="email" v-model="user.email" :errors="errors" placeholder="Email Address" />
            <TInput type="password" name="password" v-model="user.password" :errors="errors" placeholder="Password" />
            <TInput type="password" name="password_confirmation" v-model="user.password_confirmation" :errors="errors"
                placeholder="Confirm Password" inputClass="rounded-b-md" />
        </div>
        <div>

            <p>Credit Card Number</p>
            <TInput name="name" v-model="valueFields.cardName" :errors="errors" placeholder="Number" />
            <p>Name on Card</p>
            <TInput name="name" v-model="valueFields.cardNumber" :errors="errors" placeholder="Name" />
            <div class="flex justify-between text-m mb-2">
                <div class="col-span-3 mt-3 mb-5">
                    <label for="month" class="block text-sm font-medium text-gray-700"> Month
                    </label>
                    <select id="month" name="month" v-model="valueFields.cardMonth" class="
          mt-1
          block
          w-full
          py-2
          px-8
          border border-gray-300
          bg-white
          rounded-md
          shadow-sm
          focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
          sm:text-sm
        ">
                        <option v-for="month in Months" :key="month" :value="month.key">
                            {{ month.name }}
                        </option>
                    </select>
                </div>
                <div class="col-span-3 mt-3 mb-5">
                    <label for="year" class="block text-sm font-medium text-gray-700"> Year
                    </label>
                    <select id="year" name="year" v-model="valueFields.cardYear" class="
          mt-1
          block
          w-full
          py-2
          px-9
          border border-gray-300
          bg-white
          rounded-md
          shadow-sm
          focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
          sm:text-sm
        ">
                        <option v-for="yr in Year" :key="yr" :value="yr">
                            {{ yr }}
                        </option>
                    </select>
                </div>
                <div class="col-span-3 mt-3 mb-5">
                    <label for="genderType" class="block text-sm font-medium text-gray-700"> CVC
                    </label>
                    <TInput name="name" v-model="valueFields.cardCvv" :errors="errors" placeholder="" />
                </div>
            </div>
            <PaymentModal :user="user" :valueFields="valueFields" :type="2">

            </PaymentModal>


        </div>
    </div>
    <div v-if="$route.params.subType == 3">
        <div>
            <img class="mx-auto h-17 w-auto" src="/src/assets/Logo2.png" alt="Workflow" />
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Deluxe Plan
            </h2>
            <h4 class="mt-6 text-center text-l font-extrabold text-gray-900 mb-8">
                $89.99/month
            </h4>
        </div>

        <Alert v-if="Object.keys(errors).length" class="flex-col items-stretch text-sm">
            <div v-for="(field, i) of Object.keys(errors)" :key="i">
                <div v-for="(error, ind) of errors[field] || []" :key="ind">
                    * {{ error }}
                </div>
            </div>
        </Alert>

        <input type="hidden" name="remember" value="true" />
        <div class="rounded-md shadow-sm -space-y-px mb-4">
            <TInput name="companyName" v-model="user.company_name" :errors="errors" placeholder="Company Name"
                inputClass="rounded-t-md" />
            <TInput name="name" v-model="user.name" :errors="errors" placeholder="Full Name" />
            <TInput type="email" name="email" v-model="user.email" :errors="errors" placeholder="Email Address" />
            <TInput type="password" name="password" v-model="user.password" :errors="errors" placeholder="Password" />
            <TInput type="password" name="password_confirmation" v-model="user.password_confirmation" :errors="errors"
                placeholder="Confirm Password" inputClass="rounded-b-md" />
        </div>
        <div>

            <p>Credit Card Number</p>
            <TInput name="name" v-model="valueFields.cardName" :errors="errors" placeholder="Number" />
            <p>Name on Card</p>
            <TInput name="name" v-model="valueFields.cardNumber" :errors="errors" placeholder="Name" />
            <div class="flex justify-between text-m mb-2">
                <div class="col-span-3 mt-3 mb-5">
                    <label for="month" class="block text-sm font-medium text-gray-700"> Month
                    </label>
                    <select id="month" name="month" v-model="valueFields.cardMonth" class="
          mt-1
          block
          w-full
          py-2
          px-8
          border border-gray-300
          bg-white
          rounded-md
          shadow-sm
          focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
          sm:text-sm
        ">
                        <option v-for="month in Months" :key="month" :value="month.key">
                            {{ month.name }}
                        </option>
                    </select>
                </div>
                <div class="col-span-3 mt-3 mb-5">
                    <label for="year" class="block text-sm font-medium text-gray-700"> Year
                    </label>
                    <select id="year" name="year" v-model="valueFields.cardYear" class="
          mt-1
          block
          w-full
          py-2
          px-9
          border border-gray-300
          bg-white
          rounded-md
          shadow-sm
          focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
          sm:text-sm
        ">
                        <option v-for="yr in Year" :key="yr" :value="yr">
                            {{ yr }}
                        </option>
                    </select>
                </div>
                <div class="col-span-3 mt-3 mb-5">
                    <label for="genderType" class="block text-sm font-medium text-gray-700"> CVC
                    </label>
                    <TInput name="name" v-model="valueFields.cardCvv" :errors="errors" placeholder="" />
                </div>
            </div>
            <PaymentModal :user="user" :valueFields="valueFields" :type="3">

            </PaymentModal>


        </div>
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
import PaymentModal from "../components/viewer/modals/PaymentModal.vue"

const router = useRouter();


const isOpenAlert = ref(false)


const user = {
    name: "",
    email: "",
    user_type: "Group Admin", //register is only for patient
    password: "",
    sub_type: "",
    company_name: ""

};

const valueFields = {
    cardName: '',
    cardNumber: '',
    cardMonth: '',
    cardYear: '',
    cardCvv: ''
}
const Months =
    [{
        key: 1,
        name: "Jan"
    },
    {
        key: 2,
        name: "Feb"
    },
    {
        key: 3,
        name: "Mar"
    },
    {
        key: 4,
        name: "Apr"
    },
    {
        key: 5,
        name: "May"
    },
    {
        key: 6,
        name: "June"
    },
    {
        key: 7,
        name: "July"
    },
    {
        key: 8,
        name: "Aug"
    },
    {
        key: 9,
        name: "Sept"
    },
    {
        key: 10,
        name: "Oct"
    },
    {
        key: 11,
        name: "Nov"
    },
    {
        key: 12,
        name: "Dec"
    },
    ]

const Year = []
for (let x = 2022; x < 2042; x++) {
    Year.push(x)
}



const loading = ref(false);
const errors = ref({});


</script>
  