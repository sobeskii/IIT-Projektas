<template>
    <app-layout :chartsActive="true">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Best rated release chart
            </h2>
        </template>
        <div class="w-full lg:max-w-5xl rounded-sm mx-auto p-2 lg:py-4 lg:px-8 h-full" >
            <custom-table   :hasRecords="releases.data.length > 0"
                            divClass="container mx-auto relative h-full"
                            :searchOptions="false"
                            errorText="There are no rated releases currently"
                            errorIcon="far fa-frown"
                             >
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
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-1/12 w-1/12">
                        #
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-2/3 w-1/2">
                        Release
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-1/4 hidden sm:table-cell w-1/4">
                        Rating count
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase md:w-1/5 w-1/4">
                        Rating
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 md:w-1/5 w-1/5 ">
                    </th>
                </template>
                <template v-slot:content>
                    <template v-for="(release,index) in releases.data" :key="release.release.id" >
                        <home-release-content :index="placementInChart(index)" :data="release"></home-release-content>
                    </template>
                </template>
                <template v-if="releases.total > perPage" v-slot:pagination>
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
import HomeReleaseContent from '../CustomComponents/HomePageTableContent.vue'
import NotFoundError from '@/CustomComponents/NotFoundError'

export default {
    props:{
        releases:Object,
        request_items:Object,
    },
    data (){
        return {
            perPage:this.request_items.perPage,
        }
    },
    components:{
        Pagination,
        CustomTable,
        HomeReleaseContent,
        NotFoundError,
        AppLayout,
    },
    methods:{
        changePerPage(){
            this.$inertia.get(route('release.chart'),{
                perPage:this.perPage,
            },
            {
                preserveState: true
            })
        },
        nextPage(){
            if(this.releases.current_page != this.releases.last_page){
                this.$inertia.get(route('release.chart'),{
                    page:this.releases.current_page + 1,
                    perPage:this.perPage,
                },
                {
                    preserveState: true
                })
            }
        },
        previousPage(){
            if(this.releases.current_page != 1){
                this.$inertia.get(route('release.chart'),{
                    page:this.releases.current_page - 1,
                    perPage:this.perPage,
                },
                {
                    preserveState: true
                })
            }
        },
        placementInChart(index){
            return index + (this.perPage * (this.releases.current_page - 1));
        }
    },
    computed:{
        parseEntryCount(){
            let entryLimit = (this.request_items.perPage * this.releases.current_page);
            entryLimit = (entryLimit > this.releases.total) ? this.releases.total : entryLimit;
            return "Showing " +
            parseInt( (this.perPage * (this.releases.current_page - 1)  + 1) ) +" to " +
            entryLimit + " of "+ this.releases.total;
        },
    },
}
</script>
<style scoped>
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateY(30px);
}
</style>
