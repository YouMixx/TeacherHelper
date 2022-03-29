<template>
    <div class="row">
        <div class="col-12 text-center py-1">
            <span class="word-count">Слово {{ this.count+1 }}/{{ this.words[this.lang].length }}</span>
        </div>
        <div class="col-12 col-lg-8 m-auto mb-4 shadow rounded translate__text"> 
            <div class="word-show text-center py-1">
                <span>{{ this.words[this.lang][this.count] }}</span>
            </div>
            <div class="word-hide text-center py-1">
                <span>****</span>
            </div>
        </div>
        <div class="col-12 col-lg-8 m-auto d-flex justify-content-center">
            <div class="btn btn-primary mx-2" id="btn-show-translate" @click="ShowTranslate()">Показать перевод</div>
            <div class="btn btn-primary mx-2" @click="NextWord()">Следующее слово</div>
        </div>
        <div class="col-12 col-lg-8 m-auto text-center pt-2">
            <span class="form-text span-reset" @click="Reset()">Начать заново</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['words'],
        data() {
            return {
                count: 0,
                action: 'show',
                lang: 'ENG',
                t_lang: 'RUS',
            };
        },
        mounted() {
            console.log(this.words['ENG']);
            $('.language-switch').click(this.SwitchLanguage);
        },
        methods: {
            ShowTranslate() {
                if(this.action == 'show') {
                    $('.word-hide span').text(this.words[this.t_lang][this.count]);
                    $('.word-hide').css('font-size', '1.8em');
                    $('#btn-show-translate').text('Скрыть перевод');
                    this.action = 'hide';
                } else {
                    $('.word-hide span').text('****');
                    $('.word-hide').css('font-size', '1.4em');
                    $('#btn-show-translate').text('Показать перевод');
                    this.action = 'show';
                }
                
            },
            NextWord() {
                if(this.words[this.lang].length == this.count+1) {
                    this.count = -1;
                }
                this.count++;
                this.action = 'show';
                this.Update();
            },
            SwitchLanguage() {
                /* Мне тоже не очень нравится реализация этой функции */
                if(this.lang == 'ENG') {
                    $('.language-switch #first').text('RUSSIAN');
                    $('.language-switch #second').text('ENGLISH');
                    this.lang = 'RUS';
                    this.t_lang = 'ENG';
                } else {
                    $('.language-switch #first').text('ENGLISH');
                    $('.language-switch #second').text('RUSSIAN');
                    this.lang = 'ENG';
                    this.t_lang = 'RUS';
                }
                $('.word-show span').text(this.words[this.lang][this.count]);
                if($('.word-hide span').text() != '****') {
                    $('.word-hide span').text(this.words[this.t_lang][this.count]);
                }
            },
            Reset() {
                this.count = 0;
                this.Update();
            },
            Update() {
                $('.word-show span').text(this.words[this.lang][this.count]);
                $('.word-hide span').text('****');
                $('.word-count').text(`Слово ${this.count+1}/${this.words[this.lang].length}`);
            },
        }
    }
</script>
