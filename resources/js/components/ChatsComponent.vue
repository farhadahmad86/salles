<template>
    <div class="row pt-5">
        <div class="col-8">
            <div class="card card-default">
                <div class="card-header">Messages</div>
                <div class="card-body p-0">
                    <ul class="list-unstyled" style="height: 300px; overflow-y: scroll" v-chat-scroll>
                        <li class="p-2" v-for="(message, index) in messages" :key="index">
                            <strong>{{message.user.name}}:</strong>
                            {{message.message}}
                        </li>
                    </ul>
                </div>
            </div>
            <input type="text" class="form-control" @keydown="sendTypingEvent" @keyup.enter="sendMessage" v-model="newMessage" name="message" placeholder="Enter your message...">
            <span class="text-muted" v-if="activeUser">{{activeUser.name}} is typing...</span>
        </div>
        <div class="col-4">
            <div class="card card-default">
                <div class="card-header">Active User</div>
                <div class="card-body">
                    <ul>
                        <li class="py-2" v-for="(user, index) in users" :key="index">
                            {{user.name}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['user'],
        data() {
            return{
                messages: [],
                newMessage: '',
                users: [],
                activeUser: false,
                typingTimer: false,
            }
        },
        created() {
            this.fetchMessages();
            Echo.join('chat')
                .here(user => {
                    this.users = user;
                    // console.log('Here');
                    // console.log(user);
                })
                .joining(user => {
                    this.users.push(user);
                    // console.log('joining');
                    // console.log(user);
                })
                .leaving(user => {
                    this.users = this.users.filter(u => u.id != user.id);
                    // console.log('leaving');
                    // console.log(user);
                })
                .listen('MessageSent', (event) => {
                    this.messages.push(event.message);
                })
                .listenForWhisper('typing', user => {
                    this.activeUser = user;
                    if(this.typingTimer){
                        clearTimeout(this.typingTimer);
                    }
                    this.typingTimer = setTimeout(() => {
                        this.activeUser = false;
                    }, 2000);
                    // console.log('typing');
                    // console.log(response);
                })
        },
        methods: {
            fetchMessages() {
                axios.get('messages').then(response => {
                    this.messages = response.data;
                })
            },
            sendMessage(){
                this.messages.push({
                    user: this.user,
                    message: this.newMessage
                });
                axios.post('messages', {message: this.newMessage});
                this.newMessage = '';
            },
            sendTypingEvent(){
                 Echo.join('chat')
                     .whisper('typing', this.user)
            }
        }
    }
</script>
