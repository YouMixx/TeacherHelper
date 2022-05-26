<template>
    <div class="container">
        <div class="row gx-2 gy-2" v-if="books != null">
            <h1>Ваши словари:</h1>
            <div v-for="(book, index) in books"
                :key="index"
                class="col-4">
                <router-link
                    class="text-decoration-none text-reset"
                    :to="{ name: 'TranslatedWords', params: {bookId: index}}">
                        <div class="shadow rounded text-reset p-2 px-3 d-flex flex-column">
                            <h4 class="m-0">{{ book.name }}</h4>
                            <span>Количество слов: {{ book.count }}</span>
                            <span>Дата создания: {{ book.date_created }}</span>
                        </div>
                </router-link>
            </div>
            <span @click="ClearBooks" class="text-decoration-none text-reset text-center mt-4 cursor-pointer">Удалить все словари</span>
        </div>
        <p v-else>У вас пока-что нет словарей :(</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            books: null,
        };
    },
    mounted() {
        axios.post(`/get-wordbooks`)
            .then((res) => {
                this.books = res.data.books;
            });
    },
    computed: {
        
    },
    methods: {
        ClearBooks() {
            axios.post(`/clear-books`)
            .then((res) => {
                if(res.data.status) {
                    this.books = null;
                    this.$toast.success('Словари были успешно удалены.');
                }
            }).catch((err) => {
                this.$toast.error('Произошла ошибка.');
            });
        },
    }
}
</script>

<style>

</style>