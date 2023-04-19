<template>
    <main id="container">
        <div class="ml-6 mt-5">
            <Link
                :href="route('chats.index')"
                class="text-lg font-medium hover:opacity-50">Back</Link>
        </div>

        <div class="flex flex-col items-center mt-8 gap-5">
            <h2 class="text-xl font-medium">Create chat</h2>
            <form @submit.prevent="createChat" class="flex flex-col w-1/3 items-center gap-3">
                <div class="">
                    <input v-model="title" type="text" name="title" placeholder="Chat's name" class="border-2 border-black rounded-2xl">
                    <p v-if="errors" class="text-sm text-red-600 pl-1 pt-1">{{ errors.title }}</p>
                </div>
                <button type="submit" class="border-2 border-black px-5 py-2 rounded-3xl bg-blue-500 text-base hover:opacity-70">Create</button>
            </form>
        </div>
    </main>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
    name: 'Create',

    props: [
        'errors',
    ],

    data() {
        return {
            title: '',
        }
    },

    methods: {
        createChat() {
            this.$inertia.post('/chats', { title: this.title })
        },
    },

    components: {
        Link,
    },
}
</script>

<style>
*{
    box-sizing:border-box;
}
body{
    background-color:#abd9e9;
    font-family:Arial;
}
#container{
    width:750px;
    height:calc(100vh - 10px);
    background:#eff3f7;
    margin:0 auto;
    border-radius:5px;
    overflow:hidden;
    margin-top: 5px;
    margin-bottom: 5px;
}
</style>
