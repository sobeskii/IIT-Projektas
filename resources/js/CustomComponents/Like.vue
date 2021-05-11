<template>
        {{ total }}
        <template v-if="disabled || !$page.props.user.isLoggedIn">
            <span :id="getReactionType" :class="isActive" > </span>
        </template>
        <template v-else>
            <inertia-link   class="cursor-pointer"
                            as="button"
                            preserve-scroll method="POST"
                            :href="route( 'like', review.id )"
                            :data="{ is_like : reaction_type }">
                <span :id="getReactionType" :class="isActive" > </span>
            </inertia-link>
        </template>
</template>
<script>
export default{
    props:{
        review:Object,
        reaction_type:Boolean,
        is_clicked:Boolean,
        total:Number,
        disabled:Boolean,
    },
    computed:{
        getReactionType(){
            return this.reaction_type ? 'thumbs-up' : 'thumbs-down';
        },
        isActive(){
            return this.reaction_type ? this.is_clicked  ?
                                                             'text-green-500'  :   ''  :
                                        this.is_clicked  ?   'text-red-600'    :   '';
        }
    }
}
</script>
<style scoped>
    #thumbs-up:hover {
        color:#32CD32;
    }
    #thumbs-down:hover {
        color:#FF0000;
    }
    #thumbs-up:before {
        content: "\f164";
        margin: 5px;
        font-size: 1em;
        font-weight: 200;
        font-family: "Font Awesome 5 Free";
        display: inline-block;
    }
    #thumbs-down:before {
        content: "\f165";
        margin: 5px;
        font-size: 1em;
        font-weight: 200;
        font-family: "Font Awesome 5 Free";
        display: inline-block;
    }

</style>
