<template>
    <tr>
        <td class="px-5 py-5 border-b border-gray-200 hidden sm:table-cell bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">{{ data.id }}</p>

        </td>
        <td class="px-5 py-5 border-b border-gray-200 lg:text-lg text-sm bg-white ">
            <p class="text-gray-900 whitespace-no-wrap">{{ data.name }}</p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white sm:text-sm text-xs">
            <p class="text-gray-900 whitespace-no-wrap">{{ data.email }}</p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white hidden sm:table-cell text-sm">
            <p class="capitalize text-gray-900 whitespace-no-wrap">{{ roleToString }}</p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white hidden sm:table-cell text-sm">
            <p class="capitalize text-gray-900 whitespace-no-wrap">{{ formatDate }}</p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <jet-button v-if="data.role == 1"
                        @click="confirmingUserBan = true"
                        btnClass="inline-flex items-center justify-center px-2 py-1 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-300 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                <i class="fas fa-lock"></i>&nbsp;Ban
            </jet-button>
            <jet-button v-if="data.role == 0"
                        @click="confirmingUserUnban = true"
                        btnClass="inline-flex items-center justify-center px-2 py-1 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gren-300 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150">
                <i class="fas fa-lock-open"></i>&nbsp;Unban
            </jet-button>
        </td>
    </tr>
    <!-- Ban Account Confirmation Modal -->
    <jet-dialog-modal :show="confirmingUserBan" @close="confirmingUserBan">
        <template #title>
            Ban Account
        </template>

        <template #content>
            Are you sure you want to ban this user?
        </template>

        <template #footer>
            <jet-secondary-button @click="confirmingUserBan = false">
                Cancel
            </jet-secondary-button>
            <jet-danger-button class="ml-2" @click="banUser">
                Ban user
            </jet-danger-button>
        </template>
    </jet-dialog-modal>
    <!-- Unban Account Confirmation Modal -->
    <jet-dialog-modal :show="confirmingUserUnban" @close="confirmingUserUnban">
        <template #title>
            Unban Account
        </template>

        <template #content>
            Are you sure you want to unban this user?
        </template>

        <template #footer>
            <jet-secondary-button @click="confirmingUserUnban = false">
                Cancel
            </jet-secondary-button>
            <jet-button btnClass="inline-flex items-center ml-2 justify-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gren-300 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150"
                        @click="unbanUser">
                Unban user
            </jet-button>
        </template>
    </jet-dialog-modal>
</template>
<script>
    import JetButton from '@/Jetstream/Button.vue'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {   JetButton,
                        JetDialogModal,
                        JetDangerButton,
                        JetSecondaryButton
                    },
        data() {
            return {
                confirmingUserBan: false,
                confirmingUserUnban: false,
            }
        },
        props:{
            data:Object
        },
        methods:{
            banUser(){
                this.$inertia.visit(route('admin.ban',this.data.id), { preserveState: true })
                this.confirmingUserBan = false
            },
            unbanUser(){
                this.$inertia.visit(route('admin.unban',this.data.id), { preserveState: true })
                this.confirmingUserUnban = false
            },
        },
        computed:{
            roleToString(){
                return  (this.data.role   ==  1) ?   'User'  :
                        (this.data.role   ==  2) ?   'Administrator' :
                        (this.data.role   ==  0) ?   'Banned'    :
                        'User'
            },
            formatDate(){
                return new Date(this.data.created_at).toJSON().slice(0, 19).replace('T', ' ')
            }
        }
    }
</script>
