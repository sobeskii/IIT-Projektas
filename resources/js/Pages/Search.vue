<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Search for releases
            </h2>
        </template>
        <div class="max-w-lg lg:max-w-5xl shadow rounded-sm mx-auto p-2 sm:p-8 h-full" >
            <custom-table :hasRecords="albums.items.length > 0" divClass="container mx-auto sm:px-8 relative h-full" >
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
                        class="appearance-none h-full rounded-l border block w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                        <option>20</option>
                    </select>
                </template>

                <template v-slot:head >
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase w-1/5 tracking-wider">
                        Cover
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase w-1/3 tracking-wider">
                        Release
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase w-1/5 tracking-wider">
                        Release date
                    </th>
                    <th
                        class="px-5 py-3 hidden sm:table-cell border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase w-1/6 tracking-wider">
                        Type
                    </th>
                </template>
                <template v-slot:content>
                    <template v-for="album in albums.items" v-bind:key=album>
                        <release-table-content :data="album" ></release-table-content>
                    </template>
                </template>
                <template v-if="albums.total > this.perPage" v-slot:pagination>
                    <pagination :paginationNext="nextPage" :paginationPrevious="previousPage" :route="route('search.index')" >
                        <template v-slot:entrycount>
                            {{ parseEntryCount }}
                        </template>
                    </pagination>
                </template>
            </custom-table>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import _ from 'lodash'
import Pagination from '@/CustomComponents/Pagination'
import CustomTable from '@/CustomComponents/Table'
import ReleaseTableContent from '@/CustomComponents/ReleaseTableContent'
import NotFoundError from '@/CustomComponents/NotFoundError'

export default {
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
        ReleaseTableContent,
        NotFoundError,
        AppLayout,
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
        },
        nextPage(){
            if(this.albums.total > (this.offset+this.perPage)){
                this.offset = this.perPage + this.offset;
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
        previousPage(){
            if(this.offset >= this.perPage){
                this.offset =  this.offset - this.perPage;
                this.$inertia.get(route('search.index'),{
                    term:this.term,
                    offset:this.offset,
                    perPage:this.perPage,
                },
                {
                    preserveState: true
                })
            } else{
                this.offset = 0
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
    },
    computed:{
        parseEntryCount(){
            let entryLimit = this.offset + this.perPage + 1;
            entryLimit = (entryLimit > this.albums.total) ? this.albums.total : entryLimit;

            return "Showing " + parseInt(this.offset + 1) +" to " + entryLimit + " of "+ this.albums.total;
        },
    },
}
</script>
