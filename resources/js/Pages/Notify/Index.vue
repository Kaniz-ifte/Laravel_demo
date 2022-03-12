<template>
  <div>
    <Head title="Notify" />
    <h1 class="mb-8 text-3xl font-bold">Notify </h1>
    <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="notify">
      <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <select-input v-model="form.pair" :error="form.errors.pair" class="pb-8 pr-6 w-full lg:w-1/2" label="Currency Pair ">
          <option :value="null" />
          <option :key="index" v-for="(pair, index) in pairs" :value="name">{{ pair.name }}  </option>
        </select-input>
        <text-input v-model="form.price" :error="form.errors.price" class="pb-8 pr-6 w-full lg:w-1/2" label="Price" disabled/>
        <text-input v-model="form.tp" :error="form.errors.tp" class="pb-8 pr-6 w-full lg:w-1/2" label="Take profit" />
        <text-input v-model="form.sl" :error="form.errors.sl" class="pb-8 pr-6 w-full lg:w-1/2" label="Stop loss" />
      </div>
      <div class="flex justify-between px-10 py-4 bg-gray-100 border-t border-gray-100">
        <loading-button :loading="form.processing" class="px-6 py-3 text-white whitespace-nowrap text-sm font-bold leading-4 bg-indigo-600 hover:bg-orange-400 focus:bg-orange-400 rounded" type="submit">Buy</loading-button>
        <loading-button :loading="form.processing" class="px-6 py-3 text-white whitespace-nowrap text-sm font-bold leading-4 bg-red-600 hover:bg-red-400 focus:bg-red-400 rounded" type="submit">Sale</loading-button>
      </div>
    </form>
    
    <h1 class="mb-8 mt-12 text-3xl font-bold">History </h1>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Date</th>
          <th class="pb-4 pt-6 px-6">Pair</th>
          <th class="pb-4 pt-6 px-6">Stop Loss</th>
          <th class="pb-4 pt-6 px-6">Take profit</th>
          <th class="pb-4 pt-6 px-6">Position</th>
        </tr>
        <tr v-for="notification in notifications.data" :key="notification.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <p class="flex items-center px-6 py-4 focus:text-indigo-500">{{ notification.message_at }}</p>
          </td>
          <td class="border-t">
            <p class="flex items-center px-6 py-4 focus:text-indigo-500">{{ notification.pair }}</p>
          </td>
          <td class="border-t">
            <p class="flex items-center px-6 py-4 focus:text-indigo-500">{{ notification.sl }}</p>
          </td>
          <td class="border-t">
            <p class="flex items-center px-6 py-4 focus:text-indigo-500">{{ notification.tp }}</p>
          </td>
          <td class="border-t">
            <p class="flex items-center px-6 py-4 focus:text-indigo-500">{{ notification.position }}</p>
          </td>
        </tr>
        <tr v-if="notifications.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No notifications found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="notifications.links" />
  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import SelectInput from '@/Shared/SelectInput'
import TextInput from '@/Shared/TextInput'
import Pagination from '@/Shared/Pagination'

export default {
  components: {
    Head,
    SelectInput,
    TextInput,
    Pagination
  },
  layout: Layout,
  props: {
    pairs: Object,
    notifications: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        pair: null,
        price: 0.00,
        tp: 0.00,
        st: 0.00,
      }),
    }
  },
  watch: {
    
  },
  methods: {
    register() {
      this.form.post('/notify')
    },
  },
}
</script>
