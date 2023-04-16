<template>
    <div id="container">
      <aside>
        <header>
          <input type="text" placeholder="search">
        </header>
        <ul v-if="chats">
          <template v-for="chat in chats">
            <li @click.prevent="getMessages(chat)">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/chat_avatar_01.jpg" alt="">
                <div>
                <h2>{{ chat.title }}</h2>
                <h3>
                    <span class="status orange"></span>
                    offline
                </h3>
                </div>
            </li>
          </template>
        </ul>
      </aside>
      <main>
        <header>
          <template v-if="currentChat">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/chat_avatar_01.jpg" alt="">
            <div>
                <h2>{{ currentChat.title }}</h2>
                <h3>already {{ Object.keys(messages).length }} messages</h3>
            </div>
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_star.png" alt="">
          </template>
        </header>
        <ul id="chat">
          <template v-if="messages">
            <template v-for="message in messages">
                <template v-if="message.user.id == user.id">
                    <li class="me">
                        <div class="entete">
                        <h3>{{ message.date }}</h3>
                        <h2>{{ message.user.name }}</h2>
                        <span class="status blue"></span>
                        </div>
                        <div class="triangle"></div>
                        <div class="message">
                            {{ message.body }}
                        </div>
                    </li>
                </template>
                <template v-if="message.user.id !== user.id">
                      <li class="you">
                            <div class="entete">
                            <h3>{{ message.date }}</h3>
                            <h2>{{ message.user.name }}</h2>
                            <span class="status green"></span>
                            </div>
                            <div class="triangle"></div>
                            <div class="message">
                                {{ message.body }}
                            </div>
                        </li>
                </template>

            </template>

          </template>
        </ul>
        <footer>
          <textarea v-model="body" placeholder="Type your message"></textarea>
          <a @click.prevent="sendMessage" href="#">Send</a>
        </footer>
      </main>
    </div>
</template>

<script>
export default {
    name: 'Index',

    props: [
        'chats',
        'user',
    ],

    data() {
        return {
            body: '',
            messages: null,
            currentChat: null,
        }
    },

    methods: {
        sendMessage() {
            axios.post(`/chats/${this.currentChat.id}/messages`, { body: this.body })
                .then(response => {
                    this.messages.push(response.data)

                    this.body = ''
                })
        },

        getMessages(chat) {
            axios.get(`/chats/${chat.id}/messages`)
                .then(response => {
                    this.messages = response.data
                    this.currentChat = chat
                })
        },
    }
}
</script>

<style>
@import url('@/../css/chat.css');
</style>
