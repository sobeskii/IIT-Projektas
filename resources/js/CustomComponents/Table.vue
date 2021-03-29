<template>
    <div class="my-2 flex sm:flex-row flex-col">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div class="relative">
                <slot name="selection"></slot>
            </div>
        </div>
        <div class="block relative">
            <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                    <path
                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                    </path>
                </svg>
            </span>
            <slot name="search_input"> </slot>
        </div>
    </div>
    <div :class="divClass">
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto" v-if="hasRecords">
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
                <slot name="pagination"></slot>
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
        hasRecords:Boolean,
        divClass:String
    },
}
</script>
