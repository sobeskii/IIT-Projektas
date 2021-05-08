<template>
    <div class="my-2 flex sm:flex-row flex-col" v-if="searchOptions">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div class="relative">
                <slot name="selection"></slot>
            </div>
        </div>
        <div class="block relative">
            <slot name="search_input"> </slot>
        </div>
    </div>
    <div :class="divClass" :style="'--animation_type: ' + animationType">
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-1 overflow-x-auto " v-if="hasRecords">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full w-full leading-normal table-fixed">
                    <thead>
                        <tr>
                            <slot name="head"></slot>
                        </tr>
                    </thead>
                    <tbody>
                        <transition-group name="list">
                            <slot name="content"></slot>
                        </transition-group>
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
        hasRecords:{
            type:Boolean,
            default: true,
        },
        searchOptions:{
            type:Boolean,
            default:true,
        },
        divClass:String,
        animationType:String,
    },
}
</script>
<style scoped>
.list-enter-active,
.list-leave-active {
  transition: var(--animation_type);
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateY(30px);
}
</style>
