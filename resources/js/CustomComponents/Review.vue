<template>
<div class="w-full mx-auto">
    <div class="flex w-full">
        <div class="w-full border-gray-300 border-b py-2">
            <div class="w-full text-sm md:text-base px-2">
                <div id="comment_header">
                    <strong id="username">{{ review.user.name }}</strong>,
                    <small class="text-gray-500" > {{ formatDate }} </small>
                    <small class="float-right text-muted -mt-2 lg:-mt-1">
                        <div id="user_rating" :class="review.rating+'_rating'" ></div>
                    </small>
                </div>
                <div id="py-2">
                    {{ review.review }}
                </div>
            </div>
            <div class="px-2">
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
    },
    components:{
        Like
    },
    computed:{
        formatDate(){
            return $.datepicker.formatDate('MM dd, yy', new Date(this.review.created_at));
        },
    },
}
</script>
<style scoped>
    #comment_header{
        min-height: 30px;
    }
    #user_rating {
        height: 30px;
        width:100px;
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

