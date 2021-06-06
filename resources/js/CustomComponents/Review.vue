<template>
<div class="w-full mx-auto">
    <div class="flex w-full border-gray-300 border-b py-2">
        <template v-if="belongsToUserProfileReaction">
            <div class="w-1/7">
                <inertia-link :href="route('release.index',review.release_id)">
                    <div class="mx-auto text-center">
                        <div class="mx-auto flex-shrink-0 rounded-lg shadow h-24 w-24 sm:w-36 sm:h-36 p-2">
                            <img class="w-full h-full rounded-md"
                            :src="review.release.images[0]['url']"
                            alt="" />
                        </div>
                        <p class="text-gray-500 py-1 text-xs sm:text-sm">
                            {{ shortenReleaseName }}
                        </p>
                        <inertia-link :href="route('artist.index',review.release.artists[0].id)" as="p" class="text-gray-500 py-1 text-xs sm:text-sm">
                            {{ shortenArtistName }}
                        </inertia-link>
                    </div>
                </inertia-link>
            </div>
        </template>
        <div class="w-full ml-2">
            <!-- Add link to release page if the ratings review is in User reaction page -->
            <template v-if="belongsToUserProfileReaction">
                <inertia-link :href="route('release.index',review.release_id)">
                    <div class="w-full text-sm md:text-base p-2">
                        <div class="h-8">
                            <strong>{{ review.user.name }}</strong>,
                            <small class="text-gray-500" > {{ formatDate }} </small>
                            <div class="float-right text-muted -mt-2 lg:-mt-1 hidden sm:block">
                                <div class="h-8 w-25 p-1" :class="review.rating+'_rating'" ></div>
                            </div>
                        </div>
                        <div class="pb-1" v-if="review.review != null">
                            {{ review.review }}
                        </div>
                    </div>
                </inertia-link>
            </template>
            <!-- Show rating with a review normally -->
            <template v-else>
                <div class="w-full text-sm md:text-base px-2">
                    <div class="h-8">
                        <strong>{{ review.user.name }}</strong>,
                        <small class="text-gray-500" > {{ formatDate }} </small>
                        <div class="float-right text-muted -mt-2 lg:-mt-1">
                            <div class="h-8 w-25 p-1" :class="review.rating+'_rating'" ></div>
                        </div>
                    </div>
                    <div class="pb-1">
                        {{ review.review }}
                    </div>
                </div>
            </template>
            <div class="px-2" v-if="review.review != null" >
                <div class="w-full">
                    <small>
                       <like    :review="review"
                                :reaction_type="true"
                                :is_clicked="review.liked"
                                :total="review.like_count"
                                :disabled="review.disliked"
                                >
                        </like>
                        <like   :review="review"
                                :reaction_type="false"
                                :is_clicked="review.disliked"
                                :total="review.dislike_count"
                                :disabled="review.liked"
                                >
                        </like>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import Like from './Like.vue'
export default{
    props:{
        review: Object,
        belongsToUserProfileReaction: {
            type:Boolean,
            default:false,
        },
    },
    components:{
        Like
    },
    computed:{
        formatDate(){
            return $.datepicker.formatDate('MM dd, yy', new Date(this.review.created_at));
        },
        shortenReleaseName(){
            return  parseInt(this.review.release.name.length) > 20              ?       this.review.release.name.substring(0,20)+"..." :
                                                                                        this.review.release.name
        },
        shortenArtistName(){
            return  parseInt(this.review.release.artists[0].name.length) > 20   ?       this.review.release.artists[0].name.substring(0,20)+"..." :
                                                                                        this.review.release.artists[0].name
        }
    },
}
</script>
<style scoped>

    .w-25 {
        width:6.5rem;
    }
    [class~="0_rating"] {background: url(../../../public/storage/assets/0s.png); }
    [class~="0.5_rating"] {background: url(../../../public/storage/assets/1s.png); }
    [class~="1_rating"] {background: url(../../../public/storage/assets/2s.png); }
    [class~="1.5_rating"] {background: url(../../../public/storage/assets/3s.png); }
    [class~="2_rating"] {background: url(../../../public/storage/assets/4s.png); }
    [class~="2.5_rating"] {background: url(../../../public/storage/assets/5s.png); }
    [class~="3_rating"] {background: url(../../../public/storage/assets/6s.png); }
    [class~="3.5_rating"] {background: url(../../../public/storage/assets/7s.png); }
    [class~="4_rating"] {background: url(../../../public/storage/assets/8s.png); }
    [class~="4.5_rating"] {background: url(../../../public/storage/assets/9s.png); }
    [class~="5_rating"] {background: url(../../../public/storage/assets/10s.png); }

</style>

