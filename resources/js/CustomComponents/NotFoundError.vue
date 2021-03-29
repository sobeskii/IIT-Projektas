<template>
    <div class="sm:text-center mx-auto sm:mt-20 mt-8 p-4 h-96">
      <p class="max-w-2xl text-gray-400 lg:mx-auto sm:text-4xl text-2xl">
        <i :class="icon"></i> {{ errorText }}
      </p>
    </div>
</template>
<script>
export default {
    props:{
        icon: String,
        errorText: String,
    },
}
</script>
