<template>
    <main role="main">
        <search-bar @search="handleSearch"></search-bar>
        <div v-if="products.total > 0" class="catalog">
            <div v-for="item in products.data" :key="item">
                <product-card :product="item"></product-card>
            </div>
        </div>
        <div v-else class="empty-data">
            <p>not found products</p>
        </div>
        <pagination-bar
            :total="products.total"
            :current_page="products.current_page"
            :last_page="products.last_page"
            @pageChange="handlePageChange"
        ></pagination-bar>
    </main>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";
import ProductCard from "../../components/ProductCard.vue";
import SearchBar from "../../components/SearchBar.vue";
import PaginationBar from "../../components/PaginationBar.vue";

const products = ref({});

const handleSearch = (searchTerm) => {
    axios
        .post(`/api/product/search`, searchTerm)
        .then((response) => {
            Object.assign(products.value, response.data.products);
            console.log(response.data.products);
        })
        .catch((error) => {
            console.error("Error fetching products:", error);
        });
};

onMounted(() => {
    handleSearch();
});
const handlePageChange = (pageNumber) => {};
</script>

<style scoped>
main {
    width: 80%;
    display: grid;
    flex-direction: column;
    align-items: center;
    margin-left: auto;
    margin-right: auto;
}
.catalog {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    grid-column-gap: 5px;
    grid-row-gap: 10px;
    gap: 10px;
}

.empty-data {
    height: 800px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-data > p {
    color: rgb(160, 160, 160);
    font-weight: 300;
    font-size: 12px;
}
</style>
