<template>
    <header class="d-flex flex-wrap justify-content-center py-2 mb-4 border-bottom bg-black p-4 unselectable">
        <div class="row justify-content-between align-items-center w-100">
            <div class="col-xl-4 col-4 pt-1">
                <a href="/" class="d-flex align-items-center mb-md-0 me-md-auto text-decoration-none text-white">
                    <span class="fs-4">{{ app_name }}</span>
                </a>
            </div>

            <div class="col-xl-4 col-12 order-xl-2 order-3" 
                @click="switchLanguageInChildren"
                v-if="currentRouteName == 'TranslatedWords'">
                <div class="language-switch d-flex justify-content-center align-items-center" >
                    <span id="first">{{ language[0] }}</span> 
                    <img src="/images/swap.png" alt="" class="mx-3">
                    <span id="second">{{ language[1] }}</span>
                </div>
            </div>
            <div class="col-xl-4 col-8 order-2 d-flex justify-content-end align-items-center">
                <router-link
                    class="nav-link"
                    :to="{ name: 'LoadPage' }"
                    >
                    Загрузить словарь
                </router-link>
                <router-link
                    class="nav-link"
                    :to="{ name: 'WordBooks' }"
                    >
                    Выбрать словарь
                </router-link>
                <router-link
                    class="nav-link"
                    :to="{ name: 'WordsList' }"
                    >
                    Словарь
                </router-link>
            </div>
        </div>
    </header>
</template>

<script>
import EventBus from '../event-bus.js'

export default {
    data() {
        return {
            app_name: process.env.MIX_APP_NAME,
            language: ['ENGLISH', 'RUSSIAN'],
        };
    },
    mounted() {
    },
    computed: {
        currentRouteName() {
            return this.$route.name;
        }
    },
    methods: {
        switchLanguageInChildren() { 
            // Меняем переменные местами. Удобно, не надо использовать лишние if else.
            this.language = [this.language[0], this.language[1]] = [this.language[1], this.language[0]];
            EventBus.$emit("switchLanguage");
        },
    }
}
</script>

<style>

</style>