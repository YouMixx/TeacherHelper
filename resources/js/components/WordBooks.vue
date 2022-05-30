<template>
    <div class="container">
        <h1>Ваши словари:</h1>
        <div class="row gx-2 gy-2" v-if="books != null">
            <div v-for="(book, index) in books"
                :key="index"
                class="col-md-6 col-xl-4 col-12">
                <router-link
                    class="text-decoration-none text-reset"
                    :to="{ name: 'TranslatedWords', params: {bookId: index}}">
                        <div class="shadow rounded text-reset p-2 px-3 d-flex flex-column position-relative">
                            <router-link
                                class="text-decoration-none text-reset close"
                                :to="{ name: 'EditWordBook', params: {bookId: index}}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </router-link>
                            <!-- <span class="close"><i class="fa fa-pencil" aria-hidden="true"></i></span> -->
                            <h4 class="m-0">{{ book.name }}</h4>
                            <span>Количество слов: {{ book.count }}</span>
                            <span>Дата создания: {{ book.date_created }}</span>
                        </div>
                </router-link>
            </div>
            <div class="clear-books text-center mt-4">
                <span @click="ClearBooks" class="cursor-pointer">Удалить все словари</span>
            </div>
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