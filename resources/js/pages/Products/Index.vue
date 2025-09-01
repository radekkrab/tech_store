<template>
    <div class="min-h-screen bg-gray-50">
        <Head title="Каталог PDF-файлов" />

        <!-- Хедер -->
        <div class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <h1 class="text-3xl font-bold text-gray-900">Каталог PDF-файлов</h1>
                <p class="mt-2 text-gray-600">Выберите нужный материал для скачивания</p>
            </div>
        </div>

        <!-- Фильтры -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Поиск -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Поиск</label>
                        <input
                            v-model="filters.search"
                            type="text"
                            placeholder="Название или описание..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            @input="debouncedSearch"
                        />
                    </div>

                    <!-- Категории -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Категория</label>
                        <select
                            v-model="filters.category"
                            class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            @change="updateFilters"
                        >
                            <option value="">Все категории</option>
                            <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                    </div>

                    <!-- Теги -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Тег</label>
                        <select
                            v-model="filters.tag"
                            class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            @change="updateFilters"
                        >
                            <option value="">Все теги</option>
                            <option
                                v-for="tag in tags"
                                :key="tag.id"
                                :value="tag.id"
                            >
                                {{ tag.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Сброс фильтров -->
                <div class="mt-4">
                    <button
                        @click="resetFilters"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium"
                    >
                        Сбросить фильтры
                    </button>
                </div>
            </div>

            <!-- Загрузка -->
            <div v-if="loading" class="text-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto"></div>
                <p class="mt-4 text-gray-600">Загрузка продуктов...</p>
            </div>

            <!-- Продукты -->
            <div v-else-if="products.data && products.data.length > 0">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div
                        v-for="product in products.data"
                        :key="product.id"
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300"
                    >
                        <div class="p-6">
                            <!-- Категория -->
                            <div class="mb-2">
                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                  {{ product.category.name }}
                </span>
                            </div>

                            <!-- Название -->
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                {{ product.name }}
                            </h3>

                            <!-- Описание -->
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ product.description }}
                            </p>

                            <!-- Теги -->
                            <div class="flex flex-wrap gap-1 mb-4">
                <span
                    v-for="tag in product.tags"
                    :key="tag.id"
                    class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded"
                >
                  {{ tag.name }}
                </span>
                            </div>

                            <!-- Цена и кнопка -->
                            <div class="flex items-center justify-between">
                <span class="text-2xl font-bold text-green-600">
                  {{ formatPrice(product.price) }}
                </span>
                                <Link
                                    :href="route('products.show', product.id)"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors duration-200"
                                >
                                    Подробнее
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Пагинация -->
                <div class="mt-8">
                    <Pagination :links="products.links" />
                </div>
            </div>

            <!-- Нет продуктов -->
            <div v-else class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">📚</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Продукты не найдены</h3>
                <p class="text-gray-600">Попробуйте изменить параметры поиска</p>
                <button
                    @click="resetFilters"
                    class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md"
                >
                    Сбросить фильтры
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted, watch } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { debounce } from 'lodash'
import Pagination from '@/components/Pagination.vue'
import { route } from 'ziggy-js';

const props = defineProps({
    categories: Array,
    tags: Array,
    filters: Object
})

const loading = ref(true)
const products = reactive({ data: [], links: [] })
const filters = ref({
    search: props.filters.search || '',
    category: props.filters.category || '',
    tag: props.filters.tag || ''
})

// Загрузка продуктов из API
const fetchProducts = async () => {
    loading.value = true
    try {
        const params = new URLSearchParams()
        if (filters.value.search) params.append('filter[search]', filters.value.search)
        if (filters.value.category) params.append('filter[category]', filters.value.category)
        if (filters.value.tag) params.append('filter[tags]', filters.value.tag)

        const response = await fetch(`/api/products?${params}`)
        const data = await response.json()

        products.data = data.data
        products.links = data.links
        products.meta = data.meta
    } catch (error) {
        console.error('Error fetching products:', error)
    } finally {
        loading.value = false
    }
}

// Форматирование цены
const formatPrice = (price) => {
    return new Intl.NumberFormat('ru-RU', {
        style: 'currency',
        currency: 'RUB',
        minimumFractionDigits: 0
    }).format(price)
}

// Обновление фильтров с debounce
const debouncedSearch = debounce(() => {
    updateFilters()
}, 500)

const updateFilters = () => {
    router.get(route('products.index'), filters.value, {
        preserveState: true,
        replace: true
    })
}

const resetFilters = () => {
    filters.value = {
        search: '',
        category: '',
        tag: ''
    }
    updateFilters()
}

// Загрузка при монтировании и изменении фильтров
onMounted(fetchProducts)
watch(filters, fetchProducts, { deep: true })
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
