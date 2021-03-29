<template>
    <app-layout>
        <cover-component :album_image="release.images[0].url" :artist_image="primary_artist.images[0].url" :data="release" ></cover-component>
    </app-layout>
</template>

<style scoped>

</style>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CoverComponent from '../CustomComponents/CoverComponent.vue'

    export default {
        props:{
            release:Object,
            primary_artist:Object,
        },
        components: {
            AppLayout,
            CoverComponent
        },
    }
</script>

