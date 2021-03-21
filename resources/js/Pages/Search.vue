<template>
<div class="max-w-lg lg:max-w-6xl bg-white rounded-lg shadow mx-auto p-8 mt-6" >
    <custom-table :title="'Search for release'">
        <template v-slot:search_input>
            <input placeholder="Search"
                        class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                        type="text"
                        v-model="term"
                        @keyup="search"
                        id="search"
                        />
        </template>
        <template v-slot:selection>
            <select
                v-model.number="perPage"
                @change=changePerPage()
                class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option>5</option>
                <option>10</option>
                <option>15</option>
                <option>20</option>
            </select>
        </template>
        <template v-slot:head>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Album cover
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Artist
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Name
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Type
            </th>
        </template>
        <template v-slot:content>
            <tr v-for="(album,i) in albums.albums.items" v-bind:key=album :class="{'bg-gray-300': i % 2 == 0 }">
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-40 h-40">
                            <img class="w-full h-full rounded-md"
                                :src="album.images[0]['url']"
                                alt="" />
                        </div>
                    </div>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                        <template v-for="(artist) in album.artists" v-bind:key=artist>
                            {{ artist.name }}&nbsp;
                        </template>
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">{{ album.name }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="capitalize text-gray-900 whitespace-no-wrap">
                        {{ album.album_type }}
                    </p>
                </td>
            </tr>
        </template>
        <template v-slot:pagination>
            <pagination :term="this.term" :route="route('search.index')" :total="albums.albums.total" :perPage="this.perPage" ></pagination>
        </template>
    </custom-table>
</div>

</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import _ from 'lodash'
import Pagination from '@/CustomComponents/Pagination'
import CustomTable from '@/CustomComponents/Table'

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
            perPage:this.request_items.perPage,
        }
    },
    components:{
        Pagination,
        CustomTable,
    },
    methods:{
        search:_.throttle(function(){
            this.$inertia.replace(route('search.index',{
                    term:this.term,
                    offset:this.offset,
                    perPage:this.perPage
                }
            ))
            this.offset = 0
        },200),
        changePerPage(){
            this.$inertia.get(route('search.index'),{
                term:this.term,
                offset:this.offset,
                perPage:this.perPage,
            },
            {
                preserveState: true
            })
        }
    },
}
</script>
