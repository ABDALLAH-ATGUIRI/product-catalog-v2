<template>
    <main role="">
        <navbar></navbar>
        <div class="flex">
            <search-bar @search="handleSearch"></search-bar>
            <div
                v-if="products.total > 0"
                class="relative w-full grid grid-cols-5 gap-8 p-4"
            >
                <div v-for="item in products.data" :key="item" >
                    <product-card :product="item"></product-card>
                </div>
                <div class="fixed bottom-0 w-full col-span-5">
                    <pagination-bar
                        :total="products.total"
                        :current_page="products.current_page"
                        :last_page="products.last_page"
                        @pageChange="handlePageChange"
                    ></pagination-bar>
                </div>
            </div>
            <div v-else class="empty-data">
                <p>not found products</p>
            </div>
        </div>
    </main>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";
import ProductCard from "../../components/ProductCard.vue";
import SearchBar from "../../components/SearchBar.vue";
import PaginationBar from "../../components/PaginationBar.vue";
import Navbar from "../../components/Navbar.vue";

const products = ref({});

const handleSearch = (searchTerm) => {
    axios
        .post(`/api/product/search`, searchTerm)
        .then((response) =>
            Object.assign(products.value, response.data.products)
        )
        .catch((error) => {
            console.error("Error fetching products:", error);
        });
};

onMounted(() => {
    handleSearch();
});
const handlePageChange = (pageNumber) => {};
</script>
