<template>
    <form @submit.prevent="putRating">
        <template v-if="form.errors">
            <div v-for="error in form.errors" v-bind:key="error">
                {{  error  }}
            </div>
        </template>
        <input type="hidden" v-model="form.rating">
        <div class="flex w-full sm:w-2/3">
  			<div class="w-full">
                <div class="w-full flex">
                    <div id="num_rating" class="p-2 w-1/4 sm:w-1/5 md:1/7 text-center">
                        <small>{{ rating_data.rating }}</small>
                    </div>
                    <fieldset class="rating w-2/3 lg:w-1/2 md:w-2/3 sm:w-1/2 mb-3 float-left" :id="'rating_' + release_id">
                        <template v-for="n in reverseKeys( 11 )" v-bind:key="n">
                            <template v-if="n != 0">
                                <input  type="radio"
                                        :disabled="(loggedIn) ? false : true"
                                        @click="loggedIn ?  (rate( starRating( n ) ), showButtons())
                                                                : false"
                                        :id="'star' + starRating( n )"
                                        name="rating"
                                        :value="starRating( n ) " />

                                <label  @click="loggedIn ? false : redirectToLogin()"
                                        @mouseleave="(isSet) ? showNumericValue( setValue ) : showNumericValue( 0 ) "
                                        @mouseover="showNumericValue( starRating( n ) )"
                                        :class="Number.isInteger( starRating( n ) ) ? 'full' : 'half'"
                                        :for="'star' + starRating( n )" >
                                </label>
                            </template>
                        </template>
                    </fieldset>
                </div>
                <div class="hidden rate_options w-full">
                    <div class="w-full p-3 hidden" id="review">
                        <textarea v-model="form.review" rows="5" class='w-full h-80' name="review">
                        </textarea>
  				    </div>
                    <div class="clear-both"></div>
                    <jet-button type='submit'
                                :disabled="form.processing">
                                Submit
                    </jet-button>
                    &nbsp;
                    <jet-button :clickFunc="deleteRating"
                                type='button'
                                v-if="isSet && rating_data.id != null">
                                Remove
                    </jet-button>
                    &nbsp;
                    <jet-button :clickFunc="toggleReviewTextArea"
                                type='button'>
                                Review
                    </jet-button>
                </div>
  			</div>
        </div>
    </form>
</template>
<script>
import JetButton from './../Jetstream/Button'
import { useForm } from '@inertiajs/inertia-vue3'

export default{
    props: {
        rating_data: Object,
        release_id: String,
        loggedIn : Boolean,
        user_id : Number,
    },
    setup () {
        const form = useForm({
            rating: null,
            review: null,
            release_id: null,
            user_id: null,
        })
        return { form }
    },
    components:{
        JetButton
    },

    mounted(){
        this.form.release_id = this.release_id;
        this.form.user_id = this.user_id;
        if(!this.loggedIn){
            $(".submit_rating").remove();
        }
        if(this.rating_data.rating != 0){
            this.rate( this.rating_data.rating )
            $("input[name='rating'][value='" + this.rating_data.rating + "']").attr('checked','checked');
            if(this.rating_data.review != null)
                this.form.review = this.rating_data.review;
        }
    },
    data(){
      return {
        isSet : false,
        setValue : 0,
      }
    },
    methods: {
        putRating(){
            this.form.put(route("rating.put"),{
                errorBag: 'putRating',
                onSuccess: () => {
                    this.hideButtons();
                },
                onError: (errors) => {
                    // Handle validation errors
                },
            })
        },
        deleteRating(){
            this.$inertia.post(route('rating.delete'),{
                rating_id:this.rating_data.id,
                release_id:this.release_id,
            });
        },
        rate( value ){
            $("#num_rating > small").text(value);
            this.setValue = value;
            this.form.rating = value;
            this.isSet = true;
        },
        reset(){
            $("#num_rating > small").text(0);
            this.setValue = null;
            this.form.rating = null;
            this.isSet = false;
            this.hideButtons();
            $('input[name="rating"]').attr('checked', false);
        },
        showButtons() {
            $(".rate_options").show();
        },
        hideButtons(){
            $(".rate_options").hide();
        },
        showNumericValue( value ){
            $("#num_rating > small").text(value);
        },
        starRating( iteration ){
            let starRating = iteration * 0.5;
            return starRating;
        },
        reverseKeys( n ) {
            return [...Array(n).keys()].slice().reverse()
        },
        toggleReviewTextArea(){
            $("#review").toggle();
        },
        redirectToLogin(){
            window.location.href = route('login')
        },
    },
}
</script>
<style scoped>
    .rating {
        border: none;
        float: left; }

    .rating  > input {
        display: none; }

    .rating  > label:before {
        margin: 5px;
        font-size: 1.25em;
        font-weight: 400;
        content: "\f005";
        font-family: "Font Awesome 5 Free";
        display: inline-block;
    }

    .rating  > .half:before {
        content: "\f089";
        position: absolute; }

    .rating  > label {
        color: #ddd;
        float: right; }

    .rating  > input:checked ~ label,
    .rating:not(:checked) > label:hover,
    .rating:not(:checked)  > label:hover ~ label {
        color: #FFD700 !important; }

    .rating  > input:checked + label:hover,
    .rating > input:checked ~ label:hover,
    .rating  > label:hover ~ input:checked ~ label,
    .rating  > input:checked ~ label:hover ~ label {
        color: #FFED85 !important;  }
</style>
