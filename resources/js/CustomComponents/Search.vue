<template>
    <div class="mt-10">
        <div class="max-w-3xl mx-auto m-0 pt-0 pb-0">
            <label class="block">
                <span class="text-gray-700"></span>
                <form :action="url">
                    <input type="email" class="mt-0 block w-full px-0.5 border-0 border-b-2 border-gray-200 focus:ring-0 focus:border-black" placeholder="Search for your favourite artist/album...">
                </form>
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props:['url']
    }
</script>
