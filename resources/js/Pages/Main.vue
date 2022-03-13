<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>

<template>

    <Head title="Chat" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>
        <div class="flex h-[70vh]">
            <aside
                class="w-70 m-10"
                aria-label="Sidebar"
                scroll-region
            >
                <div class="h-[70vh] overflow-y-auto py-4 px-3 bg-gray-50 rounded" scroll-region>
                    <ul class="space-y-2">

                        <li v-for="user in users" v-bind:key="user.id">
                            <Link 
                                :class="{'bg-blue-200': $page.url.split('/').pop() == user.id }"
                                :href="route('main', user.id)"
                                class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg  hover:bg-gray-100"
                                preserve-scroll
                                preserve-state
                            >
                                <svg
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">{{ user.name }}</span>
                            </Link>
                        </li>

                    </ul>
                </div>
            </aside>

            <chat :chatlog="chatlog" />

        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import Chat from "../Components/Chat.vue";
export default {
    components: { Chat },
    props: {
        users: Object,
        chatlog: Array
    },
};
</script>
