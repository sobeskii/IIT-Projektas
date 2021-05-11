<template>
    <template v-if="reviews.length > 0">
        <p class="text-sm md:text-base" v-if="!belongsToUserProfileReaction"><strong>Reviews:</strong></p>
        <div class="w-full mx-auto" >
            <review v-for="(review) in dataSlice" :key="review" :review="review"
                                                                :belongsToUserProfileReaction="belongsToUserProfileReaction"></review>
            <load-more  :loadMore="loadMore" v-if="reviewsShowing < reviews.length">
                <template v-slot:entrycount>
                    {{ parseEntryCount }}
                </template>
            </load-more>
        </div>
    </template>
</template>
<script>
import Review from './Review.vue'
import LoadMore from './LoadMore.vue'
export default{
    props: {
        belongsToUserProfileReaction: {
            type:Boolean,
            default:false,
        },
        loadMore: Function,
        reviews: Object,
        reviewsShowing:Number,
    },
    components:{
        Review,
        LoadMore,
    },
    computed:{
        parseEntryCount(){
            return "Showing " + parseInt(this.reviewsShowing) + " out of " +  this.reviews.length
        },
        dataSlice() {
            return this.reviews.slice(0,this.reviewsShowing)
        },
    },
}
</script>

