<template>
    <button :type="type" @click="this.clickFunc()" :class="btnClass">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            btnClass:{
                type:String,
                default:"inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150",
            },
            type: {
                type: String,
                default: 'submit',
            },
            clickFunc:{
                type:Function,
                default: fn => { return false },
            }
        }
    }
</script>
