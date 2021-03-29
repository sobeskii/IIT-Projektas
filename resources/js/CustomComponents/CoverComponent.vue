<template>
    <div>
        <div class="frame w-full h-80">
            <img class="w-full object-cover object-center h-full" :src="artist_image" />
            <div class="cover_item">
                <div class="max-w-5xl mx-auto p-2 flex justify-start gap-5 flex-row">
                    <div class="h-40 w-40">
                        <img class="w-100 h-100" :src="album_image" />
                    </div>
                    <div>
                        <span class="absolute bottom-1">
                        <p class="whitespace-no-wrap text-white">
                            <template v-for="(artist) in data.artists" v-bind:key=artist>
                                {{ artist.name }}&nbsp;
                            </template>
                        </p>
                        <p class="whitespace-no-wrap text-white text-base">{{ data.name }}</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default{
    props:{
        data:Object,
        album_image:String,
        artist_image:String,
    }
}
</script>
<style scoped>
.frame {
    position: relative;
    background-repeat: no-repeat;
    background-size: cover;
    overflow: hidden;
}
.frame:after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    left: 0;
    background:  url(../../../public/storage/assets/frame.png);
    background-repeat: no-repeat;
    background-size: cover;
}
.cover_item{
    position: absolute;
    z-index: 1;
    bottom: 0.5px;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
}
</style>
