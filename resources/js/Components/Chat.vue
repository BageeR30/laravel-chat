<template>
    <div class="container mx-auto">
        <div class="border rounded">
            <div>
                <div class="w-full">
                    <div id='chat' class="relative w-full p-6 overflow-y-auto h-[70vh]">
                        <ul class="space-y-2">
                            <li
                                v-for="(msg, index) in chatlog" :key="index"
                                class="flex"
                                :class="'justify-' + (msg.from_user == user_id ? 'end' : 'start')"
                            >
                                <div class="relative max-w-xl px-4 py-2 text-gray-700 rounded shadow" :class="{'bg-blue-200': msg.from_user == user_id}">
                                    <span class="block">
                                        {{ msg.text }}
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <form @submit.prevent="sendMessage" class="flex items-center justify-between w-full p-3 border-t border-gray-300">
                        <input
                            v-model="message"
                            type="text"
                            placeholder="Message"
                            class="block w-full py-2 pl-4 mx-3 bg-gray-100 rounded-full outline-none focus:text-gray-700"
                            name="message"
                        />
                        <button type="submit">
                            <svg
                                class="w-5 h-5 text-gray-500 origin-center transform rotate-90"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            message: '',
            user_id: this.$page.props.auth.user.id,
        };
    },
    props: {
        to_user: Object,
        chatlog: {
            type:Array,
            default: []
        }
    },
    created() {
        Echo.private("chat." + this.$page.props.auth.user.id).listen(
            "MessageSend",
            (e) => {
                if (e.user_from.id == window.location.href.split("/").pop())
                    this.addMessage({text: e.message, from_user: e.user_from.id});
            }
        );
    },
    mounted() {
        this.scrollToBottom()
    },
    updated() {
        this.scrollToBottom()
    },
    methods: {
        addMessage(msg) {
            this.chatlog.push(msg);
        },
        sendMessage() {
            if (this.message == '') return
            axios.post("/message", {
                    to: window.location.href.split("/").pop(),
                    message: this.message,
                })
                .then((res) => {
                    if (res.status === 204) 
                        this.addMessage({text: this.message, from_user: this.user_id});
                })
                .then(() => (this.message = ''));
        },
        scrollToBottom() {
            let chat = document.getElementById('chat');
            chat.scrollTop = chat.scrollHeight;
        },

    },
};
</script>

<style>
.scrollbar-w-2::-webkit-scrollbar {
    width: 0.25rem;
    height: 0.25rem;
}

.scrollbar-track-blue-lighter::-webkit-scrollbar-track {
    --bg-opacity: 1;
    background-color: #f7fafc;
    background-color: rgba(247, 250, 252, var(--bg-opacity));
}

.scrollbar-thumb-blue::-webkit-scrollbar-thumb {
    --bg-opacity: 1;
    background-color: #edf2f7;
    background-color: rgba(237, 242, 247, var(--bg-opacity));
}

.scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
    border-radius: 0.25rem;
}
</style>