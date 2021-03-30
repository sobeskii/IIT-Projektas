<template>
    <app-layout>
        <cover-component :artist_image="primary_artist.images[0].url">
            <div class="md:h-full md:w-40 w-20 h-full">
                <img class="w-100 h-100" :src="release.images[0].url" />
            </div>
            <div class="flex-none w-1/2">
                <span class="bottom-2 absolute">
                    <p class="whitespace-no-wrap text-white md:text-2xl text-base">{{ release.name }}</p>
                    <p class="whitespace-no-wrap text-md md:text-base  text-white">
                        <template v-for="(artist) in release.artists" v-bind:key=artist>
                            {{ artist.name }}&nbsp;
                        </template>
                    </p>
                </span>
            </div>
            <div class="flex-none w-1/4 ">
                <span class="bottom-2 absolute">
                    <h5 class="text-white md:text-xl text-xs">Community rating: </h5>
                    <p class="text-white md:text-base text-xs">
                        0 <i class="fa fa-star" aria-hidden="true"></i> <small> from  ratings 0 </small>
                    </p>
                </span>
            </div>
        </cover-component>
        <div class="max-w-5xl mx-auto flex m-2 px-3 justify-start flex-wrap md:gap-8 flex-row mt-2 md:mt-4">
            <div class="w-full md:w-1/4 flex-shrink">
                <track-list :tracks="release.tracks.items" ></track-list>
            </div>
            <div class="flex-none w-full min-w-min md:w-1/2">
                <p class="text-base md:text-xl mb-2">Release information:</p>
                <p class="text-sm md:text-base"><strong>Released:</strong></p>
                <p class="text-xs md:text-md my-1">{{ release.release_date }} </p>
                <p class="text-sm md:text-base"><strong>Label:</strong></p>
                <p class="text-xs md:text-md my-1">{{ release.label }}</p>
                <p class="text-sm md:text-base"><strong>Release type:</strong></p>
                <p class="text-xs md:text-md capitalize my-1">{{ release.type }}</p>
            </div>
        </div>
    </app-layout>
</template>

<style scoped>

</style>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CoverComponent from '../CustomComponents/CoverComponent.vue'
    import TrackList from '../CustomComponents/TrackList.vue'

    export default {
        props:{
            release:Object,
            primary_artist:Object,
        },
        components: {
            AppLayout,
            CoverComponent,
            TrackList
        },
        methods:{
            millisToMinutesAndSeconds(millis) {
                var minutes = Math.floor(millis / 60000);
                var seconds = ((millis % 60000) / 1000).toFixed(0);
                return minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
            }
        },
    }
</script>

