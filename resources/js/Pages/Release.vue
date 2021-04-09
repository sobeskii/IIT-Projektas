<template>
    <app-layout>
        <cover-component :artist_image="primary_artist.images[0].url">
            <div class="md:h-full md:w-40 w-20 h-full">
                <img class="w-100 h-100 rounded-md" :src="release.images[0].url" />
            </div>
            <div class="flex-none w-1/2 overflow-hidden">
                <span class="bottom-2 sm:absolute">
                    <p class="whitespace-no-wrap text-white md:text-xl text-sm">{{ release.name }}</p>
                    <p class="whitespace-no-wrap text-xs md:text-base  text-white">
                        <template v-for="(artist) in release.artists" v-bind:key=artist>
                            {{ artist.name }}&nbsp;
                        </template>
                    </p>
                </span>
            </div>
            <div class="flex-none w-1/4 ">
                <span class="bottom-2 absolute">
                    <h5 class="text-white md:text-base text-xs">Community rating: </h5>
                    <p class="text-white md:text-base text-xs">
                        0 <i class="fa fa-star" aria-hidden="true"></i> <small> from  ratings 0 </small>
                    </p>
                </span>
            </div>
        </cover-component>
        <div class="max-w-5xl mx-auto flex m-2 px-3 justify-start my-2 flex-wrap md:gap-8 flex-row mt-2 md:mt-4">
            <div class="w-full md:w-1/4 flex-shrink">
                <track-list :tracks="release.tracks.items" ></track-list>
            </div>
            <div class="flex-none w-full min-w-min my-2 md:w-1/2">
                <p class="text-base md:text-xl mb-2">Release information:</p>
                <p class="text-sm md:text-base"><strong>Released:</strong></p>
                <p class="text-xs md:text-md my-1">{{ release.release_date }} </p>
                <p class="text-sm md:text-base"><strong>Label:</strong></p>
                <p class="text-xs md:text-md my-1">{{ release.label }}</p>
                <p class="text-sm md:text-base"><strong>Release type:</strong></p>
                <p class="text-xs md:text-md capitalize my-1">{{ release.album_type }}</p>
                <p class="text-sm md:text-base"><strong>Rate this release:</strong></p>
                <rating-component   :rating_data="user_rating_data"
                                    :loggedIn="$page.props.user.isLoggedIn"
                                    :user_id="($page.props.user.id == undefined) ?  null :
                                                                                    $page.props.user.id"
                                    :release_id="release.id">
                </rating-component>
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
    import RatingComponent from '../CustomComponents/RatingComponent.vue'

    export default {
        props:{
            release:Object,
            primary_artist:Object,
            user_rating_data:Object,
        },
        components: {
            AppLayout,
            CoverComponent,
            TrackList,
            RatingComponent
        },
    }
</script>

