<template>
<div id="container">
    <main>
        <div class="ml-6 mt-5">
            <Link
                :href="route('chats.index')"
                class="font-medium text-sky-500 hover:opacity-50">Back</Link>
        </div>

        <div class="flex flex-col items-center mt-8 gap-5">
            <h2 class="text-xl font-medium">Edit chat</h2>
            <form @submit.prevent="createChat" class="flex flex-col w-1/3 items-center gap-3">
                <picture-input
                    ref="pictureInput"
                    width="300"
                    height="300"
                    margin="16"
                    accept="image/jpeg,image/png"
                    size="10"
                    radius="50"
                    button-class="btn"
                    :custom-strings="{
                            upload: '',
                            drag: 'Icon for your chat'
                        }"
                    @change="onChange"></picture-input>
                    <p v-if="errors.image" class="text-sm text-red-600 pl-1 pt-1">{{ errors.image }}</p>
                <div>
                    <input v-model="title" type="text" name="title" placeholder="Chat's name" class="border-2 border-black rounded-2xl">
                    <p v-if="errors.title" class="text-sm text-red-600 pl-1 pt-1">{{ errors.title }}</p>
                </div>
                <button :disabled="!(image && title)" type="submit" class="border-2 border-black px-5 py-2 rounded-3xl bg-blue-500 text-base hover:opacity-70">Create</button>
            </form>
        </div>
    </main>
</div>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import ChatLayout from '@/Layouts/ChatLayout.vue'
import PictureInput from '@/Components/PictureInput.vue'

export default {
    name: 'Edit',

    layout: ChatLayout,

    props: [
        'chat',
        'errors'
    ],

    data() {
        return {
            title: this.chat.title,
            image: null,
        }
    },

    mounted() {
        console.log(1111)
        console.log(this.chat)
    },

    methods: {
        createChat() {
            this.$inertia.post('/chats', {
                title: this.title,
                image: this.image,
            })
        },

        onChange(image) {
            if (image) {
                this.image = this.$refs.pictureInput.file
            }
        },
    },

    components: {
        Link,
        PictureInput,
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
