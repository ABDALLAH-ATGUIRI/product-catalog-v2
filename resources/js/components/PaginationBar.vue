<template>
    <div class="container">
        <!-- Pagination controls -->
        <ul class="pagination">
            <li class="icon">
                <button @click="prevPage">Previous</button>
            </li>
            <li v-for="i in last_page" :key="i">
                <button :class="current_page == i ? 'bg-yellow' : 'bg-gray'">
                    {{ i }}
                </button>
            </li>
            <li class="icon">
                <button @click="nextPage">Next</button>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";

const props = defineProps({
    total: { type: Number },
    current_page: { type: Number },
    last_page: { type: Number },
});
const currentPage = ref(1);

const totalPages = computed(() =>
    Math.ceil(props.items.length / props.itemsPerPage)
);

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
    }
};

const prevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--;
    }
};
</script>

<style scoped>
.container {
    padding: 50px;
}
.pagination {
    margin: 25px 0 15px 0;
}
.pagination,
.pagination li button {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}
.pagination li {
    background: #a8a8a8;
    list-style: none;
}
.pagination li button {
    text-decoration: none;
    height: 50px;
    width: 50px;
    font-size: 18px;
    padding-top: 1px;
    border: 1px solid rgba(0, 0, 0, 0.25);
    border-right-width: 0px;
    box-shadow: inset 0px 1px 0px 0px rgba(255, 255, 255, 0.35);
}
.pagination li:last-child button {
    border-right-width: 1px;
}
.pagination li button:hover {
    background: rgba(255, 255, 255, 0.2);
    border-top-color: rgba(0, 0, 0, 0.35);
    border-bottom-color: rgba(0, 0, 0, 0.5);
}
.pagination li button:focus,
.pagination li button:active {
    padding-top: 4px;
    border-left-width: 1px;
    background: rgba(255, 255, 255, 0.15);
    box-shadow: inset 0px 2px 1px 0px rgba(0, 0, 0, 0.25);
}
.pagination li.icon button {
    min-width: 120px;
}
.pagination li:first-child span {
    padding-right: 8px;
}

.bg-yellow{
    background-color: bisque;
}
</style>
