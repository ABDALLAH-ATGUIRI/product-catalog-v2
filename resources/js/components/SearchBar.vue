<template lang="">
    <div id="app">
        <div class="filter-bar">
            <select v-model="searchTerm.category" @change="search">
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
                v-model="searchTerm.product_name"
                type="text"
                placeholder="Product Name"
                @change="search"
            />

            <input
                v-model.number="searchTerm.price_min"
                placeholder="Min Price"
                type="number"
                id="minPrice"
                min="0"
                @change="search"
            />
            <input
                v-model.number="searchTerm.price_max"
                placeholder="Max Price"
                type="number"
                id="maxPrice"
                min="0"
                @change="search"
            />
        </div>
    </div>
</template>
<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

const emit = defineEmits();
const categories = ref([]);
const searchTerm = ref({
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

const search = (e) => {
    e.preventDefault();
    emit("search", searchTerm.value);
};
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
