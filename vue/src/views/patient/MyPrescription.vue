<template>
    <PageComponent title="My Prescription">
        <div v-if="loading" class="flex justify-center">Loading...</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-5 text-gray-700">
            <DashboardCard class="order-1 lg:order-1" style="animation-delay: 0.2s">
                <form class="flex items-center">
                    <label for="voice-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="flex absolute inset-y-0 left-0 top-3 pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for presctiptions..." required>
                        


                    </div>
                </form>
                <Listbox as="div" v-model="selected">
                            <ListboxLabel class="block text-sm font-medium text-gray-700">Search by Specialty:</ListboxLabel>
                            <div class="relative mt-1">
                                <ListboxButton
                                    class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                    <span class="flex items-center">
                                        
                                        <span class="ml-3 block truncate">{{ selected.name }}</span>
                                    </span>
                                    <span
                                        class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                                        <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                    </span>
                                </ListboxButton>

                                <transition leave-active-class="transition ease-in duration-100"
                                    leave-from-class="opacity-100" leave-to-class="opacity-0">
                                    <ListboxOptions
                                        class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                        <ListboxOption as="template" v-for="person in people" :key="person.id"
                                            :value="person" v-slot="{ active, selected }">
                                            <li
                                                :class="[active ? 'text-white bg-indigo-600' : 'text-gray-900', 'relative cursor-default select-none py-2 pl-3 pr-9']">
                                                <div class="flex items-center">
                                                    <img :src="person.avatar" alt=""
                                                        class="h-6 w-6 flex-shrink-0 rounded-full" />
                                                    <span
                                                        :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">{{
                                                        person.name }}</span>
                                                </div>

                                                <span v-if="selected"
                                                    :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                                </span>
                                            </li>
                                        </ListboxOption>
                                    </ListboxOptions>
                                </transition>
                            </div>
                        </Listbox>
            </DashboardCard>

            <DashboardCard class="order-2 lg:order-2" style="animation-delay: 0.1s">

                <table class="min-w-auto divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-bold text-mid text-gray-500 uppercase">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold text-mid text-gray-500 uppercase">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-bold text-mid text-gray-500 uppercase">
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                <a href="#">Fight Against Covid</a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                Guidelines to help keep our nation safe from Covid-19
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                2022/09/12
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                <a href="#">Summer Flu</a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                <a>Its the season that most of us will get sick and everybody should be safe</a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                2022/09/9
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                <a href="#">Get your covid jabs with us</a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                With the constant spread of covid-19, our clinic now provide different vaccines to help
                                against the virus
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                                2022/07/23
                            </td>
                        </tr>
                    </tbody>
                </table>
            </DashboardCard>

        </div>
    </PageComponent>
</template>
    
<script setup>
import { EyeIcon, PencilIcon } from "@heroicons/vue/solid"
import DashboardCard from "../../components/core/DashboardCard.vue";
import TButton from "../../components/core/TButton.vue";
import PageComponent from "../../components/PageComponent.vue";
import { computed } from "vue";
import { useStore } from "vuex";
import { ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/solid'

const store = useStore();

const loading = computed(() => store.state.dashboard.loading);
const data = computed(() => store.state.dashboard.data);
const user = computed(() => store.state.user.data);

store.dispatch("getDashboardData");

const people = [
  {
    id: 1,
    name: 'Wade Cooper',
    
  },
  {
    id: 2,
    name: 'Arlene Mccoy',
    
  },
  {
    id: 3,
    name: 'Devon Webb',
    
  },
  {
    id: 4,
    name: 'Tom Cook',
    
  },
  {
    id: 5,
    name: 'Tanya Fox',
    
  },
]

const selected = ref(people[3])

</script>
    
<style scoped>

</style>
    