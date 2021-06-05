<template>
    <app-layout>
        <cover-component :cover="primary_artist.images[0].url">
            <div class="md:h-full md:w-40 w-20 h-full">
                <img class="w-100 h-100 rounded-md" :src="release.images[1].url" />
            </div>
            <div class="flex-none w-1/2 overflow-hidden">
                <span class="bottom-2 sm:absolute sm:w-2/6">
                    <p class="whitespace-no-wrap text-white md:text-xl text-sm">
                        <a rel="noreferrer" :href="release.external_urls['spotify']" target="_blank" class="text-green-500">
                            <i class="fab fa-spotify" aria-hidden="true"></i>
                        </a>
                        {{ release.name }}
                    </p>
                    <p class="whitespace-no-wrap text-xs md:text-base  text-white">
                        <template v-for="(artist) in release.artists" v-bind:key=artist>
                            <inertia-link :href="route('artist.index',artist.id)">
                                {{ artist.name }}&nbsp;
                            </inertia-link>
                        </template>
                    </p>
                </span>
            </div>
            <div class="flex-none sm:w-1/4 w-1/2">
                <span class="bottom-2 absolute">
                    <h5 class="text-white md:text-base text-xs">Community rating: </h5>
                    <p class="text-white md:text-base text-xs">
                        {{ ratingAverage }}  <i class="fa fa-star" aria-hidden="true"></i> <small> from  ratings {{ rating_data.count }} </small>
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
                                    :release_id="release.id"
                                    :artist_id="primary_artist.id"
                                    >
                </rating-component>
            <review-thread  :loadMore="LoadMoreReviews"
                            :reviewsShowing="reviewsToShow"
                            :reviews="rating_data.reviews"
                            emptyMsg="There are no reviews yet"
                            >
            </review-thread>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CoverComponent from '../CustomComponents/CoverComponent.vue'
    import TrackList from '../CustomComponents/TrackList.vue'
    import RatingComponent from '../CustomComponents/RatingComponent.vue'
    import ReviewThread from '../CustomComponents/ReviewThread.vue'

    export default {
        props:{
            release:Object,
            primary_artist:Object,
            user_rating_data:Object,
            rating_data:Object,
        },
        components: {
            AppLayout,
            CoverComponent,
            TrackList,
            RatingComponent,
            ReviewThread
        },
        data(){
            return {
                reviewsToShow: 5,
            }
        },
        methods:{
            LoadMoreReviews(){
                this.reviewsToShow  +=  5
            }
        },
        computed:{
            ratingAverage(){
                return Number((this.rating_data.average).toFixed(2));
            }
        }
    }
</script>

