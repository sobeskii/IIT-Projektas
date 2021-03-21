<template>
<div class="max-w-md lg:max-w-3xl bg-white rounded-lg shadow mx-auto p-8 mt-16" >
    <div class="p-4">
        <label for="search">
            Search
        </label>
        <input id="search" type="text" v-model="term" @keyup="search" class="ml-2 px-2 py-1 text-sm rounded border">
    </div>
    <table class="w-full">
        <tr class="bg-gray-900 text-white">
        <th class="px-2 py-1 text-sm font-bold text-left">Artist name</th>
        <th class="px-2 py-1 text-sm font-bold text-left">Album name</th>
        </tr>
        <tr v-for="(album,i) in albums.albums.items" v-bind:key=album :class="{'bg-gray-300': i % 2 == 0 }">
            <td class="px-2 py-1 text-sm text-left">
                <template v-for="(artist) in album.artists" v-bind:key=artist>
                    {{ artist.name }}&nbsp;
                </template>
            </td>
            <td class="px-2 py-1 text-sm text-left">{{ album.name }}</td>
        </tr>
    </table>
    <pagination :term="this.term" :route="route('search.index')" :total="albums.albums.total" :perPage="15" ></pagination>
</div>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import _ from 'lodash'
import Pagination from '@/CustomComponents/Pagination'

export default {
layout:AppLayout,
    props:{
        albums:Object,
        request_items:Object,
    },
    data (){
        return {
            term: this.request_items.term,
            offset:this.request_items.offset,
        }
    },
    components:{
        Pagination,
    },
    methods:{
        search:_.throttle(function(){
            this.$inertia.replace(route('search.index',{term:this.term,offset:this.offset}))
            this.offset = 0

        },200),
    },
}
</script>
