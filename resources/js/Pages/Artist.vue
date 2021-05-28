<template>
    <app-layout>
        <cover-component :cover="artist.images[0].url">
            <div class="flex-none w-1/2 overflow-hidden">
                <span class="bottom-2 sm:absolute">
                    <p class="whitespace-no-wrap text-xl text-sm:2xl md:text-4xl  text-white">
                        <a rel="noreferrer" :href="artist.external_urls['spotify']" target="_blank" class="text-green-500">
                            <i class="fab fa-spotify" aria-hidden="true"></i>
                        </a>
                        {{ artist.name }}
                    </p>
                    <p class="whitespace-no-wrap text-xs md:text-xs  text-white">
                        {{ formatFollowers }} followers on Spotify
                    </p>
                </span>
            </div>
        </cover-component>
        <div class="max-w-5xl mx-auto flex px-4 justify-start my-2 flex-wrap flex-row mt-1">
                <p class="text-base md:text-xl my-1">Releases:</p>
                <custom-table   divClass="container mx-auto h-full"
                                :searchOptions="false" >

                    <template v-slot:head >
                        <th
                            class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-2/3  w-1/2 tracking-wider">
                            Release name
                        </th>
                        <th
                            class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase w-1/4  tracking-wider">
                        </th>
                        <th
                            class="px-2 py-2 border-b-2 border-gray-200 hidden sm:table-cell bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-1/4 w-1/4  tracking-wider">
                            Rating count
                        </th>
                        <th
                            class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-1/5 w-1/4  tracking-wider">
                            Community rating
                        </th>
                        <th
                            class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-1/5 w-1/5  tracking-wider">
                        </th>
                    </template>
                    <template v-slot:content>
                        <transition-group name="list">
                            <template v-for="release in dataSlice" :key="release.id" >
                                <artist-release-content :data="release"></artist-release-content>
                            </template>
                        </transition-group>
                    </template>
                    <template v-if="releasesToShow < artist_releases.length" v-slot:pagination>
                        <load-more :loadMore="LoadMoreReleases">
                            <template v-slot:entrycount>
                                {{ parseEntryCount }}
                            </template>
                        </load-more>
                    </template>
                </custom-table>
            </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CoverComponent from '../CustomComponents/CoverComponent.vue'
    import CustomTable from '@/CustomComponents/Table'
    import ArtistReleaseContent from '../CustomComponents/ArtistReleaseTableContent.vue'
    import Pagination from '../CustomComponents/Pagination'
    import LoadMore from '../CustomComponents/LoadMore'

    export default {
        props:{
            artist:Object,
            artist_releases:Object,
        },
        components: {
            AppLayout,
            CoverComponent,
            CustomTable,
            ArtistReleaseContent,
            Pagination,
            LoadMore,
        },
        data(){
            return {
                releasesToShow: 10,
            }
        },
        methods:{
            LoadMoreReleases(){
                this.releasesToShow += 10;
            }
        },
        computed:{
            formatFollowers() {
                let num = this.artist.followers.total
                if (num >= 1000000000) {
                    return (num / 1000000000).toFixed(1).replace(/\.0$/, '') + 'G'
                }
                if (num >= 1000000) {
                    return (num / 1000000).toFixed(1).replace(/\.0$/, '') + 'M'
                }
                if (num >= 1000) {
                    return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K'
                }
                return num;
            },
            dataSlice() {
                return this.artist_releases.slice(0,this.releasesToShow)
            },
            parseEntryCount(){
                return "Showing " + parseInt(this.releasesToShow) + " out of " +  this.artist_releases.length
            },
        }
    }
</script>
<style scoped>
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateY(30px);
}
</style>

