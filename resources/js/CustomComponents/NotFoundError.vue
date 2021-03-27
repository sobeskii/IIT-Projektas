<template>
    <div class="lg:text-center mx-auto absolute bottom-3/4 left-1/3">
      <p class="mt-4 max-w-2xl text-xl text-gray-400 lg:mx-auto text-center">
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
