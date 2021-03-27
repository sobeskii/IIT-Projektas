<template>
    <tr>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0 w-40 h-40">
                    <img class="w-full h-full rounded-md"
                        :src="data.images[0]['url']"
                        alt="" />
                </div>
            </div>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white ">
            <p class="whitespace-no-wrap text-gray-500 text-lg">
                <template v-for="(artist) in data.artists" v-bind:key=artist>
                    {{ artist.name }}&nbsp;
                </template>
            </p>
            <p class="whitespace-no-wrap text-gray-500 text-base">{{ data.name }}</p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">{{ data.release_date }}</p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="capitalize text-gray-900 whitespace-no-wrap">
                {{ data.type }}
            </p>
        </td>
    </tr>
</template>
<script>
export default {
    props:{
        data:Object
    },
}
</script>
