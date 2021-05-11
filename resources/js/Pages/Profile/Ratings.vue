<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
            <div class="flex mt-2">
                <inertia-link :href="route('profile.show')" class="font-semibold pr-2 text-base text-gray-500 leading-tight">
                    Settings
                </inertia-link> &nbsp;
                <inertia-link :href="route('user.reactions')" class="font-semibold px-2 text-base text-gray-500 leading-tight">
                    Reactions
                </inertia-link> &nbsp;
                <inertia-link :href="route('user.ratings')" class="font-semibold px-2 text-base text-gray-500 leading-tight">
                    Reviews and ratings
                </inertia-link>
            </div>
        </template>
        <div class="max-w-6xl mx-auto flex m-2 px-3 justify-start my-2 flex-wrap flex-row mt-1">
            <p class="text-base md:text-xl mt-2">Reviews and ratings:</p>
            <review-thread  :loadMore="LoadMoreReviews"
                            :reviewsShowing="reviewsToShow"
                            :reviews="ratings"
                            :belongsToUserProfileReaction="true"
                            ></review-thread>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import ReviewThread from '../../CustomComponents/ReviewThread.vue'

    export default {
        props:{
            ratings:Object,
        },
        components: {
            AppLayout,
            ReviewThread,
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
        }
    }
</script>
