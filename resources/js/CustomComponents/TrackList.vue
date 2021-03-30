<template>
    <p class="text-base sm:text-xl mb-2">Track list:</p>
    <table class="w-full divide-y divide-gray-200">
        <tbody class="bg-white divide-y divide-gray-200 text-xs">
            <tr v-for="track in tracks" v-bind:key="track">
                <td class="px-2 py-2">
                    {{ track.track_number }}
                </td>
                <td class="px-2 py-2 overflow-ellipsis">
                    {{ track.name }}
                </td>
                <td class="px-2 py-2 ">
                    {{ millisToMinutesAndSeconds(track.duration_ms) }}
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
    export default{
        props:{
            tracks:Object,
        },
        methods:{
            millisToMinutesAndSeconds(millis) {
                var minutes = Math.floor(millis / 60000);
                var seconds = ((millis % 60000) / 1000).toFixed(0);
                return minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
            }
        },
    }
</script>

