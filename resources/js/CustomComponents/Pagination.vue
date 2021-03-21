<template>
<div class="min-w-full">
    <ul class="flex justify-center">
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-500 rounded-lg">
            <button href="#" @click="previousPage()" >
                <span class="mx-1">previous</span>
            </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
            <a class="font-bold" href="#">1</a>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
            <a class="font-bold" href="#">2</a>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
            <a class="font-bold" href="#">3</a>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
            <button href="#" @click="nextPage()" >
                Next
            </button>
        </li>
    </ul>
</div>
</template>
<script>
export default {
    props:{
        term:String,
        total:Number,
        perPage:Number,
        route,
    },
    methods:{
        nextPage(){
            if(this.total > (this.$parent.offset+this.perPage)){
                this.$parent.offset = this.perPage + this.$parent.offset;
                this.$inertia.get(route('search.index'),{term:this.term,offset:this.$parent.offset},{ preserveState: true })
            }
        },
        previousPage(){
            if(this.$parent.offset >= this.perPage){
                this.$parent.offset =  this.$parent.offset - this.perPage;
                this.$inertia.get(route('search.index'),{term:this.term,offset:this.$parent.offset},{ preserveState: true })
            }
        },
    },
}
</script>
