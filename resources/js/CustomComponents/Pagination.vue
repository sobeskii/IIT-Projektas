<template>
    <div
        class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
        <span class="text-xs xs:text-sm text-gray-900">
            {{ parseEntryCount() }}
        </span>
        <div class="inline-flex mt-2 xs:mt-0">
            <button href="#"
                @click="previousPage()"
                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                Prev
            </button>
            <button href="#"
                @click="nextPage()"
                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                Next
            </button>
        </div>
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
        parseEntryCount(){
            let entryLimit = this.$parent.$parent.offset + this.perPage + 1;
            entryLimit = (entryLimit > this.total) ? this.total : entryLimit;

            return "Showing " + parseInt(this.$parent.$parent.offset + 1) +" to " + entryLimit + " of "+ this.total;
        },
        nextPage(){
            if(this.total > (this.$parent.$parent.offset+this.perPage)){
                this.$parent.$parent.offset = this.perPage + this.$parent.$parent.offset;
                this.$inertia.get(route('search.index'),{
                    term:this.term,
                    offset:this.$parent.$parent.offset,
                    perPage:this.perPage,
                },
                {
                    preserveState: true
                })
            }
        },
        previousPage(){
            if(this.$parent.$parent.offset >= this.perPage){
                this.$parent.$parent.offset =  this.$parent.$parent.offset - this.perPage;
                this.$inertia.get(route('search.index'),{
                    term:this.term,
                    offset:this.$parent.$parent.offset,
                    perPage:this.perPage,
                },
                {
                    preserveState: true
                })
            } else{
                this.$parent.$parent.offset = 0
                this.$inertia.get(route('search.index'),{
                    term:this.term,
                    offset:this.$parent.$parent.offset,
                    perPage:this.perPage,
                },
                {
                    preserveState: true
                })
            }
        },
    },
}
</script>
