<template>
    <transition name="slide-fade">
        <div v-if="toast && visible" class="absolute flex max-w-xs z-20 w-full mt-4 mr-4 top-0 right-0 bg-white rounded shadow p-4">
            <div class="mr-2 text-green-500">
                <i class="far fa-check-circle" aria-hidden="true"></i>
            </div>
            <div class="flex-1 text-gray-800">
                {{ toast.message }}
            </div>
            <div class="ml-2">
                <button @click="visible = false" class="align-top text-gray-500 hover:text-gray-700 focus:outline-none focus:text-indigo-600">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </transition>
</template>
<script>
    export default{
        props: {
            toast:Object,
        },
        data(){
            return{
                visible: false,
                timeout: null,
            }
        },
        watch: {
            toast:{
                deep:true,
                handler(){
                    this.visible = true;

                    if(this.timeout){
                        clearTimeout(this.timeout);
                    }

                    this.timeout = setTimeout(()=> this.visible = false, 2000);
                }
            }
        }
    }
</script>
<style scoped>
    /* Enter and leave animations can use different */
    /* durations and timing functions.              */
    .slide-fade-enter-active {
        transition: all 0.3s ease-out;
    }

    .slide-fade-leave-active {
        transition: all 0.4s cubic-bezier(1, 0.5, 0.8, 1);
    }

    .slide-fade-enter-from,
    .slide-fade-leave-to {
        transform: translateX(20px);
        opacity: 0;
    }
</style>
