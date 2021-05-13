<template>
    <app-layout>
        <div class="py-4 bg-white w-full md:w-3/5 mx-auto md:rounded-2xl">
            <div class="w-full md:max-w-7xl mx-auto px-4 md:px-6 lg:px-8 pb-4">
                <div class="text-center">
                    <h1 class="text-2xl md:text-3xl text-green-600 font-semibold tracking-wide">Discover, Rate and Review Music</h1>
                    <p class="mt-1 sm:mt-2 max-w-2xl text-base sm:text-xl text-gray-500 lg:mx-auto">
                        Lorem ipsum dolor sit amet consect adipisicing elit. Possimus magnam voluptatum cupiditate veritatis in accusamus quisquam.
                    </p>
                </div>
            </div>
            <p class="text-base md:text-xl my-2 mx-2">Top 15 Best Rated Releases:</p>
            <custom-table   divClass="container mx-auto relative h-full"
                            :searchOptions="false"
                            :hasPagination="false" >
                <template v-slot:head >
                    <th
                        class="md:w-1/12 w-1/12">
                    </th>
                    <th
                        class="md:w-2/3 w-1/2">
                    </th>
                    <th
                        class="md:w-1/4 hidden sm:table-cell w-1/4">
                    </th>
                    <th
                        class="md:w-1/5 w-1/4">
                    </th>
                    <th
                        class="md:w-1/5 w-1/5">
                    </th>
                </template>
                <template v-slot:content>
                    <template v-for="(release,index) in releases" :key="release.id" >
                        <home-release-content :index="index" :data="release"></home-release-content>
                    </template>
                </template>
            </custom-table>
        </div>
    </app-layout>
</template>
<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetInput from '@/Jetstream/Input'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import CustomTable from '@/CustomComponents/Table'
    import HomeReleaseContent from '../CustomComponents/HomePageTableContent.vue'


    export default {
        props:{
            releases:Object,
        },
        components: {
            CustomTable,
            AppLayout,
            JetInput,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            HomeReleaseContent,
        },
    }
</script>
