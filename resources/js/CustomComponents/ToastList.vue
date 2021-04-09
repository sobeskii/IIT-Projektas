<template>
    <div class="absolute max-w-xs z-20 w-full mt-4 mr-4 right-0 top-0">
        <transition-group name="list">
            <template v-if="visible">
                <template v-for="(msg,name,index) in toast" :key="index">
                    <toast :message="msg" :isError="isError"></toast>
                </template>
            </template>
        </transition-group>
    </div>
</template>
<script>
    import Toast from "./Toast"
    export default{
        components:{
            Toast,
        },
        props: {
            toast:Object,
            isError:{
                type:Boolean,
                default:false,
            }
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
    .list-enter-active,
    .list-leave-active {
        transition: all 1s ease;
    }
    .list-enter-from,
    .list-leave-to {
        opacity: 0;
        transform: translateX(30px);
    }
</style>
