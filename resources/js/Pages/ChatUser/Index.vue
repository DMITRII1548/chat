<template>
    <div id="container">
        <main class="mt-3 ml-5 w-full">
            <div class="flex flex-col items-center w-full font-medium mb-3">
                <div><h3 class="text-xl">Settings</h3></div>
            </div>
            <div class="flex gap-2 mb-4">
                <Link
                    :href="route('chats.index')"
                    class="font-medium text-sky-500 hover:opacity-50">Back</Link>
                <Link
                    :href="route('chat.users.create', chat.id)"
                    class="font-medium text-sky-500 hover:opacity-50">Add user</Link>
                <Link
                    :href="route('chats.edit', chat.id)"
                    class="font-medium text-sky-500 hover:opacity-50">Edit Chat</Link>
            </div>
            <div class="w-full flex flex-col items-center">
                <h3 class="text-lg font-medium">Users in the chat</h3>
            </div>
            <div class="flex flex-col items-center w-full gap-2 mt-4">
                <div v-for="user in users" class="text-base font-normal border-t border-gray-400 w-1/3 pt-2 flex justify-between">
                    <div class="text-green-700">{{ user.name }}</div>
                    <a
                        @click.prevent="destroyUser(user.id)"
                        href="#"
                        class="text-sm text-red-600 hover:opacity-80">Delete</a>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import ChatLayout from '@/Layouts/ChatLayout.vue'

export default {
    name: 'Settings',

    layout: ChatLayout,

    props: [
        'chat',
        'users',
    ],

    components: {
        Link,
    },

    methods: {
        destroyUser(userId) {
            this.$inertia.delete(`/chats/${this.chat.id}/users/${userId}`)
        }
    }
}
</script>

<style scoped>
#container{
    width:750px;
    min-height:calc(100vh - 10px);
    background:#eff3f7;
    margin:0 auto;
    border-radius:5px;
    overflow:hidden;
    margin-top: 5px;
    margin-bottom: 5px;
}
</style>
