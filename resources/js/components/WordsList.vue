<template>
    <div class="container">
        <h1>Поиск:</h1>
        <div class="content-wordlist" v-if="books !== null">
            <input type="text" class="form-control mb-4" v-model="search" placeholder="Поиск...">
            <div class="row" v-for="book in filterWords">
                <h3>{{ book['name'] }}</h3>
                <div v-for="i in book['words']['RUS'].length"
                    v-if="book['words']['RUS'][i-1] && book['words']['ENG'][i-1]"
                    class="col-md-6 col-xl-4 col-12">
                    <div class="shadow rounded text-reset p-2 px-3 mb-3 d-flex flex-column">
                        {{ book['words']['RUS'][i-1] }} - {{ book['words']['ENG'][i-1] }}
                    </div>
                </div>
            </div>
        </div>
        <p v-else>У вас пока-что нет словарей :(</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            search: '',
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
        filterWords() {
            if (this.search) {
                var temp_books = JSON.parse(JSON.stringify(this.books));
                temp_books.forEach((book, index) => {
                    var words = [];
                    if(this.isCyrillic(this.search)) {
                        words = book.words.RUS.map(item => {
                            return (item.includes(this.search)?item:null);
                        });
                        temp_books[index].words.RUS = words;
                    } else {
                        words = book.words.ENG.map(item => {
                            return (item.includes(this.search)?item:null);
                        });
                        temp_books[index].words.ENG = words;
                    }
                });
                // console.log(temp_books);
                return temp_books;
            }
            return this.books;
        }, 
    },
    methods: {
        isCyrillic(text) {
            return /[а-я]/i.test(text);  
        },
    }
}
</script>

<style>

</style>