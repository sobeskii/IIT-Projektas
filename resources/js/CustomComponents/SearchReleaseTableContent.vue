<template>
    <tr>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0 lg:w-32 lg:h-32 w-14 h-14">
                    <inertia-link :href="route('release.index',data.id)">
                        <img class="w-full h-full rounded-md"
                        :src="data.images[1]['url']"
                        :alt="data.name" />
                    </inertia-link>
                </div>
            </div>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 lg:text-lg text-sm bg-white ">
            <p class="whitespace-no-wrap text-gray-500">
                <template v-for="(artist) in data.artists" v-bind:key=artist.id>
                    <inertia-link :href="route('artist.index',artist.id)">
                        {{ artist.name }}&nbsp;
                    </inertia-link>
                </template>
            </p>
            <p class="whitespace-no-wrap text-gray-500 text-base">
                <inertia-link :href="route('release.index',data.id)">
                    {{ shortenReleaseName }}
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
    computed:{
        shortenReleaseName(){
            return  parseInt(this.data.name.length) > 20 ?      this.data.name.substring(0,20)+"..." :
                                                                this.data.name
        }
    }
}
</script>
