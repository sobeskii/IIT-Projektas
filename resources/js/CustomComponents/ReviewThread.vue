<template>
    <p class="text-sm md:text-base" v-if="!belongsToUserProfileReaction"><strong>Reviews:</strong></p>
    <template v-if="reviews.length > 0">
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
    <template v-else>
        <not-found-error    icon='fas fa-comment-slash'
                            :errorText="emptyMsg"
                            :margin="setMargin"
                        >
        </not-found-error>
    </template>
</template>
<script>
import Review from './Review.vue'
import LoadMore from './LoadMore.vue'
import NotFoundError from '@/CustomComponents/NotFoundError'

export default{
    props: {
        belongsToUserProfileReaction: {
            type:Boolean,
            default:false,
        },
        loadMore: Function,
        reviews: Object,
        reviewsShowing:Number,
        emptyMsg:String,
    },
    components:{
        Review,
        LoadMore,
        NotFoundError
    },
    computed:{
        parseEntryCount(){
            return "Showing " + parseInt(this.reviewsShowing) + " out of " +  this.reviews.length
        },
        dataSlice() {
            return this.reviews.slice(0,this.reviewsShowing)
        },
        setMargin(){
            return !this.belongsToUserProfileReaction    ?   ""  :   "sm:mt-20"
        }
    },
}
</script>

