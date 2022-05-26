<template>
    <div class="row" v-if="this.words['RUS']">
        <div class="col-12 text-center py-1">
            <span class="word-count">Слово {{ count+1 }}/{{ this.words[this.lang].length }}</span>
        </div>
        <div class="col-12 col-lg-8 m-auto mb-4 shadow rounded translate__text"> 
            <div class="word-show text-center py-1">
                <span>{{ word_show }}</span>
            </div>
            <div class="word-hide text-center py-1">
                <span>{{ word_hide }}</span>
            </div>
        </div>
        <div class="col-12 col-lg-8 m-auto d-flex justify-content-center">
            <div class="btn btn-primary mx-2" id="btn-show-translate" @click="SwitchActionTranslate()">
                <span v-if="action == 'show'">Показать перевод</span>
                <span v-if="action == 'hide'">Скрыть перевод</span>
            </div>
            <div class="btn btn-primary mx-2 btn-speak" id="btn-show-translate" @click="SpeakWord()">
                <img src="/images/speak.png" alt="">
            </div>
            <div class="btn btn-primary mx-2" @click="NextWord()">Следующее слово</div>
        </div>
        <div class="col-12 col-lg-8 m-auto text-center pt-2">
            <span class="form-text cursor-pointer" @click="Reset()">Начать заново</span>
        </div>
    </div>
</template>

<script>
import EventBus from '../event-bus.js'

export default {
    name: 'TranslatedWords',
    data() {
        return {
            count: 0,
            action: 'show',
            lang: 'ENG',
            t_lang: 'RUS',
            words: [],
            word_show: '',
            word_hide: '****',
        };
    },
    mounted() {
        EventBus.$on("switchLanguage", () => {
            this.SwitchLanguage();
        });
        axios.post(`/get-wordbook/${this.$route.params.bookId}`)
            .then((res) => {
                console.log(res.data);
                this.words = res.data.words;
                this.word_show = this.words[this.lang][this.count];
            });
    },
    methods: {
        SwitchActionTranslate() {
            // Функция нужна для кнопки "Показать перевод".
            // Не стал придумывать ничего нового, дефолтный if else тут сойдет.
            if(this.action == 'show') {
                this.word_hide = this.words[this.t_lang][this.count];
                this.action = 'hide';
            } else {
                this.word_hide = '****';
                this.action = 'show';
            }
        },
        NextWord() {
            if(this.words[this.lang].length == this.count+1) {
                this.count = -1;
            }
            this.count++;
            this.action = 'hide';
            this.SwitchActionTranslate();
            this.Update();
        },
        SwitchLanguage() {
            // Функция смены языка, вызывается с HeaderMenu.vue.
            this.lang = [this.t_lang, this.t_lang = this.lang][0]; // Меняем переменные местами
            this.word_show = this.words[this.lang][this.count]; // Меняем word_show, т.к. теперь у нас новый язык
            if(this.action == 'hide') { // И если у нас сейчас нижнее слово не скрыто, нам нужно обновить и его.
                this.word_hide = this.words[this.t_lang][this.count];
            }
        },
        Reset() {
            // Обнуляем и вызываем апдейт
            this.count = 0;
            this.Update();
        },
        Update() {
            // Функция апдейт нужна для изменения отображаемых переменных в шаблоне после изменений данных (lang, count).
            this.word_show = this.words[this.lang][this.count];
            this.word_hide = '****';
        },
        SpeakWord() {
            window.speechSynthesis.cancel();

            let word = this.words[this.lang][this.count];
            const utterance = new SpeechSynthesisUtterance(word);

            window.speechSynthesis.speak(utterance);
        }
    }
}
</script>
