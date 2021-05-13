<template>
    <tr>
        <td class="px-4 py-4 border-b border-gray-200 bg-white sm:text-3xl text-xl">
            <small class="text-gray-500">{{ tableNumber }}</small>
        </td>
        <td class="px-3 py-2 border-b border-gray-200 bg-white">
            <div class="flex items-center sm:text-base text-sm">
                <inertia-link :href="route('release.index',data.release_id)" class="flex items-center overflow-ellipsis">
                    <div class="flex-shrink-0 sm:w-32 sm:h-32 w-14 h-14 p-2">
                            <img class="w-full h-full rounded-md"
                            :src="data.release.images[0]['url']"
                            alt="" />
                    </div>
                    <div>
                        <p class="pl-8 whitespace-no-wrap text-sm sm:text-base text-gray-500">
                            <template v-for="(artist) in data.release.artists" v-bind:key=artist.id>
                                <inertia-link :href="route('artist.index',artist.id)">
                                    {{ artist.name }}&nbsp;
                                </inertia-link>
                            </template>
                        </p>
                        <p class="text-gray-900 whitespace-no-wrap text-sm sm:text-xl pl-8">{{data.release.name}}</p>
                        <p class="text-gray-500 whitespace-no-wrap text-xs sm:text-sm pl-8"><small> {{data.release.release_date}} </small></p>
                    </div>
                </inertia-link>
            </div>
        </td>
        <td class="px-4 py-4 border-b hidden sm:table-cell border-gray-200 bg-white sm:text-xl text-base">
            <small class="text-gray-500">{{ data.count }}</small>
        </td>
        <td class="px-4 py-4 border-b border-gray-200 bg-white sm:text-base text-sm">
            <p class="capitalize text-gray-500 whitespace-no-wrap">
                {{ ratingAverage }}  <i class="fa fa-star text-yellow-300" aria-hidden="true"></i>
            </p>
        </td>
        <td class="px-4 py-4 border-b border-gray-200 bg-white sm:text-xl text-base">
            <a rel="noreferrer" :href="data.release.external_urls['spotify']" target="_blank" class="text-green-500">
                <i class="fab fa-spotify" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
</template>
<script>

export default {
    props:{
        data:Object,
        index:Number,
    },
    computed:{
        ratingAverage(){
            return Number((this.data.average).toFixed(2));
        },
        tableNumber(){
            return (this.index + 1)
        }
    }
}
</script>
