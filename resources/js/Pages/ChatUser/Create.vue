<template>
    <div id="container">
        <main>
            <div class="ml-8 mt-5 flex gap-3">
                <Link
                    :href="route('chats.index')"
                    class="font-medium text-sky-500 hover:opacity-50">Back</Link>
                <Link
                    :href="route('chat.users.index', chat.id)"
                    class="font-medium text-sky-500 hover:opacity-50">Settings</Link>
            </div>
            <div class="flex flex-col items-center gap-4 w-full mt-5">
                <div>
                    <h3 class="text-lg font-medium text-center">Add user in this chat</h3>
                </div>
                <form @submit.prevent="includeUser" class="flex flex-col items-center gap-3">
                    <select v-model="choisedUser" name="user_id">
                        <template v-for="user in users">
                            <option :value="user.id">{{ user.name }}</option>
                        </template>
                    </select>
                    <button type="submit" class="border-2 border-black px-5 py-2 rounded-3xl bg-blue-500 text-base hover:opacity-70">Add user</button>
                </form>
            </div>
        </main>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import ChatLayout from '@/Layouts/ChatLayout.vue'

export default {
    name: 'AddUser',

    layout: ChatLayout,

    props: [
        'users',
        'chat',
    ],

    data() {
        return {
            choisedUser: null,
        }
    },

    methods: {
        includeUser() {
            this.$inertia.post(`/chats/${this.chat.id}/users`, {
                user_id: this.choisedUser,
            })
        },
    },

    components: {
        Link,
    },
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
