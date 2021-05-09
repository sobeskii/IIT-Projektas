<template>
    <div class="my-2 px-4 sm:px-8  flex sm:flex-row flex-col" v-if="searchOptions">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div class="relative">
                <slot name="selection"></slot>
            </div>
        </div>
        <div class="block relative">
            <slot name="search_input"> </slot>
        </div>
    </div>
    <div :class="divClass">
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-1 overflow-x-auto " v-if="hasRecords">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full w-full leading-normal table-fixed">
                    <thead>
                        <tr>
                            <slot name="head"></slot>
                        </tr>
                    </thead>
                    <tbody>
                        <slot name="content"></slot>
                    </tbody>
                </table>
                <slot name="pagination" v-if="hasRecords"></slot>
            </div>
        </div>
        <not-found-error icon='fa fa-search'
                            errorText="Start typing to initiate the search..."
                            v-else>
        </not-found-error>
    </div>

</template>
<script>
import NotFoundError from './NotFoundError.vue'
export default {
  components: { NotFoundError },
    props:{
        title:String,
        hasRecords:{
            type:Boolean,
            default: true,
        },
        searchOptions:{
            type:Boolean,
            default:true,
        },
        divClass:String,
    },
}
</script>
