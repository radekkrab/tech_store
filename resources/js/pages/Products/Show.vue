<template>
    <div class="min-h-screen bg-gray-50">
        <Head :title="product?.name || 'Загрузка...'" />

        <!-- Хедер -->
        <div class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                    <Link :href="route('products.index')" class="hover:text-gray-700">Каталог</Link>
                    <span>/</span>
                    <span class="text-gray-900">{{ product?.name || 'Загрузка...' }}</span>
                </nav>

                <h1 class="text-3xl font-bold text-gray-900">{{ product?.name || 'Загрузка...' }}</h1>
            </div>
        </div>

        <!-- Загрузка -->
        <div v-if="loading" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="animate-pulse">
                <div class="h-8 bg-gray-200 rounded w-3/4 mb-4"></div>
                <div class="h-4 bg-gray-200 rounded w-1/2 mb-8"></div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div class="h-6 bg-gray-200 rounded w-1/4"></div>
                        <div class="h-4 bg-gray-200 rounded"></div>
                        <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                    </div>
                    <div class="h-64 bg-gray-200 rounded"></div>
                </div>
            </div>
        </div>

        <!-- Контент -->
        <div v-else-if="product" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Левая колонка - Информация -->
                <div>
                    <!-- Категория и теги -->
                    <div class="flex flex-wrap items-center gap-2 mb-4">
            <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
              {{ product.category.name }}
            </span>
                        <span
                            v-for="tag in product.tags"
                            :key="tag.id"
                            class="bg-gray-100 text-gray-700 text-sm px-2 py-1 rounded"
                        >
              {{ tag.name }}
            </span>
                    </div>

                    <!-- Описание -->
                    <div class="prose prose-lg mb-6">
                        <p class="text-gray-600 leading-relaxed">{{ product.description }}</p>
                    </div>

                    <!-- Цена и кнопка покупки -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="text-center mb-6">
              <span class="text-4xl font-bold text-green-600">
                {{ formatPrice(product.price) }}
              </span>
                        </div>

                        <button
                            @click="addToCart"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-semibold text-lg transition-colors duration-200 mb-4"
                        >
                            Добавить в корзину
                        </button>
                    </div>
                </div>

                <!-- Правая колонка - Placeholder -->
                <div>
                    <div class="bg-white rounded-lg shadow p-8 text-center">
                        <div class="text-6xl mb-4">📄</div>
                        <p class="text-gray-600">PDF файл</p>
                        <p class="text-sm text-gray-500 mt-2">Доступен для скачивания после покупки</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ошибка -->
        <div v-else class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center">
            <div class="text-red-400 text-6xl mb-4">❌</div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Продукт не найден</h3>
            <Link
                :href="route('products.index')"
                class="text-blue-600 hover:text-blue-800"
            >
                Вернуться в каталог
            </Link>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Head, Link } from '@inertiajs/vue3'

const props = defineProps({
    productId: Number
})

const loading = ref(true)
const product = ref(null)

// Загрузка продукта из API
const fetchProduct = async () => {
    loading.value = true
    try {
        const response = await fetch(`/api/products/${props.productId}`)
        if (response.ok) {
            product.value = await response.json()
        } else {
            product.value = null
        }
    } catch (error) {
        console.error('Error fetching product:', error)
        product.value = null
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

const addToCart = () => {
    console.log('Add to cart:', product.value.id)
}

onMounted(fetchProduct)
</script>
