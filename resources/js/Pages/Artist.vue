<template>
    <app-layout>
        <cover-component :cover="artist.images[0].url">
            <div class="flex-none w-1/2 overflow-hidden">
                <span class="bottom-2 sm:absolute">
                    <p class="whitespace-no-wrap text-2xl md:text-4xl  text-white">
                        <a :href="artist.external_urls['spotify']" target="_blank" class="text-green-500">
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
            <div class="max-w-5xl mx-auto flex m-2 px-3 justify-start my-4 flex-wrap flex-row mt-1 md:mt-2">
                <p class="text-base md:text-xl my-2">Releases:</p>
                <custom-table   divClass="container mx-auto relative h-full"
                                :searchOptions="false"
                                animationType="all 1s ease" >

                    <template v-slot:head >
                        <th
                            class="px-2 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-2/3  w-1/2 tracking-wider">
                            Album
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
                        <template v-for="release in dataSlice" v-bind:key="release.id" >
                            <artist-release-content :data="release"></artist-release-content>
                        </template>
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

