<template>
    <div
        class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
        <span class="text-xs xs:text-sm text-gray-900">
            <slot name="entrycount">
            </slot>
        </span>
        <div class="inline-flex mt-2 xs:mt-0">
            <button @click="this.loadMore()"
                    class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                Load more
            </button>
        </div>
    </div>
</template>
<script>
export default {
    props: [ 'loadMore' ],
}
</script>
