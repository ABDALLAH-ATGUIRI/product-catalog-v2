<template>
    <div
        class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
    >
        <div class="flex flex-1 justify-between sm:hidden">
            <a
                href="#"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >Previous</a
            >
            <a
                href="#"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >Next</a
            >
        </div>
        <div
            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    {{ " " }}
                    <span class="font-medium">{{ current_page }}</span>
                    {{ " " }}
                    to
                    {{ " " }}
                    <span class="font-medium">{{ current_page * 10 }}</span>
                    {{ " " }}
                    of
                    {{ " " }}
                    <span class="font-medium">{{ total }}</span>
                    {{ " " }}
                    results
                </p>
            </div>
            <div>
                <nav
                    class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                    aria-label="Pagination"
                >
                    <a
                        href="#"
                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                    >
                        <span class="sr-only">Previous</span>
                        <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                    </a>
                    <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
                    <a
                        v-for="(item, index) in last_page"
                        :key="index"
                        href="#"
                        :class="`relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold focus:z-20 ${
                            current_page == item
                                ? 'text-white bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 '
                                : ' text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50  focus:outline-offset-0'
                        }`"
                        >{{ item }}</a
                    >

                    <a
                        href="#"
                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0"
                    >
                        <span class="sr-only">Next</span>
                        <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                    </a>
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/20/solid";

const props = defineProps(["total", "current_page", "last_page"]);
</script>
