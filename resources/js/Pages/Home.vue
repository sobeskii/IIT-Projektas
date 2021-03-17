<template>
    <app-layout>
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="py-12 bg-white mt-10 w-3/5 mx-auto rounded-2xl">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="lg:text-center">
      <h1 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Transactions</h1>
      <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
        A better way to send money
      </p>
      <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
        Lorem ipsum dolor sit amet consect adipisicing elit. Possimus magnam voluptatum cupiditate veritatis in accusamus quisquam.
      </p>
    </div>
    <search-bar></search-bar>
  </div>
</div>
    </app-layout>
</template>

<style scoped>

</style>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetInput from '@/Jetstream/Input'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import SearchBar from '../CustomComponents/Search.vue';

    export default {
        components: {
          AppLayout,
          JetInput,
          JetAuthenticationCard,
          JetAuthenticationCardLogo,
          SearchBar
        },
    }
</script>
