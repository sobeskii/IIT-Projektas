<template>
    <template v-if="reviews.length > 0">
        <p class="text-sm md:text-base"><strong>Reviews:</strong></p>
        <div class="w-full">
            <review v-for="(review) in reviews" :key="review" :review="review"></review>
        </div>
    </template>
</template>
<script>
import Review from './Review.vue'
export default{
    props: {
       reviews: Object,
    },
    components:{
        Review
    },
}
</script>

