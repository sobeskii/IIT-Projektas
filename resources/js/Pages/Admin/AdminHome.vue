<template>
    <app-layout :adminPanelActive="true">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin Panel
            </h2>
            <div class="flex mt-2">
                <inertia-link :href="route('admin.index')" class="font-semibold pr-2 text-base text-gray-500 leading-tight">
                    Users
                </inertia-link> &nbsp;
            </div>
        </template>
        <div class="w-full lg:max-w-6xl rounded-sm mx-auto p-2 lg:py-4 lg:px-8 h-full" >
            <custom-table   :hasRecords="users.data.length > 0"
                            divClass="container mx-auto relative h-full"
                            :searchOptions="true"
                            errorText="There are no users"
                            errorIcon="far fa-frown"
                             >
                <template v-slot:search_input>
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
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
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 hidden sm:table-cell uppercase md:w-1/12 w-1/12">
                        ID
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-1/5 w-1/4">
                        User
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-1/3 hidden sm:table-cell w-1/5">
                        Email
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-1/5 w-1/4">
                        Role
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase hidden sm:table-cell md:w-1/5 w-1/5 ">
                        Created at
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-1/5 w-1/5 ">
                        Options
                    </th>
                </template>
                <template v-slot:content>
                    <template v-for="(user) in users.data" :key="user.id" >
                        <admin-table-item :data="user"></admin-table-item>
                    </template>
                </template>
                <template v-if="users.total > perPage" v-slot:pagination>
                    <pagination :paginationNext="nextPage" :paginationPrevious="previousPage" >
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
    import Pagination from '@/CustomComponents/Pagination'
    import CustomTable from '@/CustomComponents/Table'
    import NotFoundError from '@/CustomComponents/NotFoundError'
    import AdminTableItem from '@/Pages/Admin/AdminTableItem.vue'
    import _ from 'lodash'
    export default {
        props:{
            users:Object,
            request_items:Object,
        },
        data (){
            return {
                perPage:this.request_items.perPage,
                term: this.request_items.term,
            }
        },
        components: {
            AppLayout,
            Pagination,
            CustomTable,
            NotFoundError,
            AdminTableItem,
        },
        methods:{
            search:_.throttle(function(){
                this.$inertia.get(route('admin.index',{
                        term:this.term,
                        perPage:this.perPage
                    }
                ))
            },800),
            changePerPage(){
                this.$inertia.get(route('admin.index'),{
                    perPage:this.perPage,
                },
                {
                    preserveState: true
                })
            },
            nextPage(){
                if(this.users.current_page != this.users.last_page){
                    this.$inertia.get(route('admin.index'),{
                        page:this.users.current_page + 1,
                        perPage:this.perPage,
                    },
                    {
                        preserveState: true
                    })
                }
            },
            previousPage(){
                if(this.users.current_page != 1){
                    this.$inertia.get(route('admin.index'),{
                        page:this.users.current_page - 1,
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
                let entryLimit = (this.request_items.perPage * this.users.current_page);
                entryLimit = (entryLimit > this.users.total) ? this.users.total : entryLimit;
                return "Showing " +
                parseInt( (this.perPage * (this.users.current_page - 1)  + 1) ) +" to " +
                entryLimit + " of "+ this.users.total;
            },

        }
    }
</script>

