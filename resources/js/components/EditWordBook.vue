<template>
    <div class="container">
        <h1>Редактирование словаря:</h1>
        <div class="row gx-2 gy-2" v-if="words != null">
            <slot v-for="(word, index) in words.ENG">
                <div class="col-6">
                    <input type="text" class="form-control" v-model="words.ENG[index]">
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" v-model="words.RUS[index]">
                </div>
            </slot>
            <div class="btn btn-success mt-3" @click="save()">Сохранить</div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            words: null,
        };
    },
    mounted() {
        axios.post(`/get-wordbook/${this.$route.params.bookId}`)
            .then((res) => {
                this.words = res.data.words;
                console.log(this.words);
            });
    },
    computed: {
        
    },
    methods: {
        save() {
            axios.post(`/save-wordbook/${this.$route.params.bookId}`, {words: this.words})
                .then((res) => {
                    if(res.data.status) {
                        this.$toast.success('Вы успешно сохранили словарь');
                    } else {
                        this.$toast.error(res.data.message);
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