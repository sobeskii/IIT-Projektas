<template>
    <div class="flex w-full mt-4 mr-4 rounded shadow p-4"   :class="[(isError    ?   'bg-red-600' : 'bg-green-400'),
                                                                     cancelled   ?   'hidden' : '']">
        <div class="mr-2 text-white">
            <i :class="isError ? 'fa fa-exclamation-triangle' : 'far fa-check-circle'" aria-hidden="true"></i>
        </div>
        <div class="flex-1 text-white">
            {{ message }}
        </div>
        <div class="ml-2">
            <button @click="setInvisible()" class="align-top text-white hover:text-gray-700 focus:outline-none focus:text-gray-800">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</template>
<script>
    export default{
        props: {
            message:String,
            isError:{
                type:Boolean,
                default:false,
            }
        },
        data(){
            return {
                cancelled:false,
            }
        },
        methods:{
            setInvisible(){
                this.cancelled = true;

                if(this.cancelled){
                    clearTimeout(this.cancelled);
                }
                this.cancelled = setTimeout(()=> this.cancelled = false, 1500);
            }
        }
    }
</script>

