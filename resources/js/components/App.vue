<template>
    <div class="wrapper">
        <header-menu />
        <main class="py-4">
            <div class="container">
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>

<script>
import HeaderMenu from './HeaderMenu.vue';

export default {
    components: {
        HeaderMenu,
    },
    data() {
        return {
            app_name: process.env.MIX_APP_NAME,
        };
    },
    mounted() {
        
    },
    computed: {
        
    },
    methods: {
    }
}
</script>

<style>

</style>