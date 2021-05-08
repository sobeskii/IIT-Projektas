<template>
    <div>
        <div class="frame w-full h-80">
            <img class="w-full object-cover object-center h-full" :src="cover" />
            <div class="cover_item">
                <div class="max-w-5xl mx-auto flex m-2 px-3 justify-start h-full gap-5 flex-row">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:{
        cover:String,
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
    left: 5px;
    right: 5px;
}
</style>
