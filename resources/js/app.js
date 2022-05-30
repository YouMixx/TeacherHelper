import VueRouter from 'vue-router';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

import App from './components/App'
import ManePage from './components/ManePage'
import WordsList from './components/WordsList'
import WordBooks from './components/WordBooks'
import LoaderPage from './components/LoaderPage'
import TranslatedWords from './components/TranslatedWords'
import EditWordBook from './components/EditWordBook'
import PageNotFound from './components/PageNotFound'

require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('translated-words', require('./components/TranslatedWords.vue').default);
Vue.component('words-list', require('./components/WordsList.vue').default);
Vue.component('word-books', require('./components/WordBooks.vue').default);
// Vue.component('mane-page', require('./components/ManePage.vue').default);

Vue.use(VueToast);
Vue.use(VueRouter);

const routes = [
    {
        path: '',
        component: App,
        children: [
            {
                path: '/',
                name: 'ManePage',
                component: ManePage,
            },
            {
                path: '/wordbooks',
                name: 'WordBooks',
                component: WordBooks,
            },
            {
                path: '/words-list',
                name: 'WordsList',
                component: WordsList,
            },
            {
                path: '/load',
                name: 'LoadPage',
                component: LoaderPage,
            },
            {
                path: '/translated/:bookId',
                name: 'TranslatedWords',
                component: TranslatedWords,
            },
            {
                path: '/edit-book/:bookId',
                name: 'EditWordBook',
                component: EditWordBook,
            },
            {
                path: '*',
                name: 'PageNotFound',
                component: PageNotFound,
            },
        ]
    }
];

const router = new VueRouter({
    routes: routes,
    mode: 'history',
});

const app = new Vue({
    // el: '#app',
    router
}).$mount('#app');
