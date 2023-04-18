<template>
    <main id="container">
        <div class="flex flex-col items-center mt-8 gap-5">
            <h2 class="text-xl font-medium">Create chat</h2>
            <form method="post" action="#" class="flex flex-col w-1/3 items-center gap-3">
                <input type="text" placeholder="Chat's name" class="border-2 border-black rounded-2xl">
                <button type="sumbit" class="border-2 border-black px-5 py-2 rounded-3xl bg-blue-500 text-base hover:opacity-70">Create</button>
            </form>
        </div>
    </main>
</template>

<script>
export default {
    name: 'Create',
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
