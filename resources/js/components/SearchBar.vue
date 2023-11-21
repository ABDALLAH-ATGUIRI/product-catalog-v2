<template lang="">
    <div id="app">
        <div class="filter-bar">
            <select v-model="filterForm.category" @change="searchProducts">
                <template v-for="category in categories">
                    <optgroup :label="category.name">
                        <template v-for="subCategory in category.children">
                            <option :value="subCategory.id">
                                {{ subCategory.name }}
                            </option>
                        </template>
                    </optgroup>
                </template>
            </select>

            <input
                v-model="filterForm.productName"
                type="text"
                placeholder="Product Name"
                @change="searchProducts"
            />

            <input
                v-model.number="filterForm.price_min"
                placeholder="Min Price"
                type="number"
                id="minPrice"
                min="0"
                @change="searchProducts"
            />
            <input
                v-model.number="filterForm.price_max"
                placeholder="Max Price"
                type="number"
                id="maxPrice"
                min="0"
                @change="searchProducts"
            />
        </div>
    </div>
</template>
<script setup>
import axios from "axios";
import { computed, onMounted, ref } from "vue";

const categories = ref([]);
const filterForm = ref({
    category: null,
    price_min: null,
    price_max: null,
    product_name: "",
});

onMounted(() => {
    axios
        .get("/api/categories")
        .then((response) => {
            categories.value = response.data.categories;
        })
        .catch((error) => {
            console.error("Error fetching categories:", error);
        });
});

const searchProducts = computed(() => {
    axios
        .post(`/api/product/search`, filterForm.value)
        .then((data) => {
            console.log(data);
        })
        .catch((error) => {
            console.error("Error fetching products:", error);
        });
});
</script>

<style scoped>
.filter-bar {
    background-color: #333;
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 3rem;
    margin-left: auto;
    margin-right: auto;
}

.filter-bar select,
.filter-bar input {
    margin-right: 10px;
    padding: 5px;
    font-size: 16px;
    width: 200px;
}
</style>
