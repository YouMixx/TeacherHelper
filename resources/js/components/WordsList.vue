<template>
    <div class="row">
        <div class="col-12">
            <input type="text" class="form-control mb-4" v-model="search" placeholder="Search...">
        </div>
        <div v-for="word in filterWords"
            class="col-4">
            <div class="shadow rounded text-reset p-2 px-3 mb-3 d-flex flex-column">
                {{ word }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['words'],
    data() {
        return {
            search: '',
        };
    },
    mounted() {
        console.log(this.words);
        // console.log(this.words.filter(item => item.title.indexOf('test') !== -1));
        // console.log(this.filterWords());
    },
    computed: {
        filterWords() {
            if (this.search) {
                return this.words.filter(item => {
                    // console.log(item);
                    return item.includes(this.search);
                });
            }
            return this.words
        },
    }
}
</script>

<style>

</style>