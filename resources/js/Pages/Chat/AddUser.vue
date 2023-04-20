<template>
    <div id="container">
        <main>
            <div class="ml-8 mt-5 flex gap-3">
                <Link
                    :href="route('chats.settings', 1)"
                    class="font-medium text-sky-500 hover:opacity-50">Settings</Link>       
                <Link
                    :href="route('chats.settings', 1)"
                    class="font-medium text-sky-500 hover:opacity-50">Add user</Link>           
            </div>
            <div class="flex flex-col items-center gap-4 w-full mt-5">
                <div>
                    <h3 class="text-lg font-medium text-center">Add user in this chat</h3>
                </div>                
                <form class="flex flex-col items-center gap-3">
                    <select name="user_id">
                        <option value="1">user1</option>
                        <option value="2">user2</option>
                        <option value="3">user3</option>
                    </select>
                    <button type="submit" class="border-2 border-black px-5 py-2 rounded-3xl bg-blue-500 text-base hover:opacity-70">Add user</button>
                </form>
            </div>
        </main>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
    name: 'AddUser',

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
    min-height:calc(100vh - 10px);
    background:#eff3f7;
    margin:0 auto;
    border-radius:5px;
    overflow:hidden;
    margin-top: 5px;
    margin-bottom: 5px;
}
</style>
