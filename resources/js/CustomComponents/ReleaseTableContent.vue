<template>
    <tr>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0 lg:w-36 lg:h-36 w-20 h-20">
                    <inertia-link :href="route('release.index',data.id)">
                        <img class="w-full h-full rounded-md"
                        :src="data.images[0]['url']"
                        alt="" />
                    </inertia-link>
                </div>
            </div>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 lg:text-lg text-sm bg-white ">
            <p class="whitespace-no-wrap text-gray-500">
                <template v-for="(artist) in data.artists" v-bind:key=artist>
                    {{ artist.name }}&nbsp;
                </template>
            </p>
            <p class="whitespace-no-wrap text-gray-500 text-base">
                <inertia-link :href="route('release.index',data.id)">
                    {{ data.name }}
                </inertia-link>
            </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white sm:text-sm text-xs">
            <p class="text-gray-900 whitespace-no-wrap">{{ data.release_date }}</p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white hidden sm:table-cell text-sm">
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
