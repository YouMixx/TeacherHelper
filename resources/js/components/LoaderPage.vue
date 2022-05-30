<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 m-auto shadow py-2">
                <div class="mb-3">
                    <div class="col-md-12">
                        <label>Введите имя словаря</label>
                        <input type="text" class="form-control" required v-model="name">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col-md-12">
                        <label for="csv_file">Выберите и загрузите файл CSV формата</label>
                        <input
                            type="file"
                            accept=".csv"
                            class="form-control"
                            @change="uploadFiles"
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" @click.prevent="submit()">
                            Загрузить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: null,
            file: [],
        };
    },
    mounted() {
        
    },
    computed: {
        
    },
    methods: {
        uploadFiles(e) {
            this.file = e.target.files[0];
        },
        submit() {
            // Validation
            if(this.file.length == 0) {
                this.$toast.error('Вы не выбрали файл.');
                return;
            }

            const allowedExtensions = ['csv', 'xml'];
            const fileExtension = this.file.name.split('.').pop();

            if(this.name == null) {
                this.$toast.error('Вы не ввели имя файла.');
                return;
            }

            if (this.file.size > 5 * 1024 * 1024) {
                this.$toast.error('Максимальный размер файла должен не превышать 5MB.');
                return;
            }

            if(fileExtension && !allowedExtensions.includes(fileExtension)){
                this.$toast.error('Данное расширение файла не поддерживается.');
                return;
            }

            // Sending file
            const config = { 'content-type': 'multipart/form-data' }
            const formData = new FormData()
            formData.append('name_book', this.name)
            formData.append('file', this.file)

            axios.post(`/load-file`, formData, config)
                .then((res) => {
                    if(res.data.status) {
                        this.$toast.success('Ваш файл был успешно загружен');
                        this.$router.push('/wordbooks');
                    } else {
                        this.$toast.error(res.data.message);
                    }
                }).catch((err) => {
                    this.$toast.error('Произошла ошибка. Пожалуйста, проверьте формат и содержимое файла.');
                });
        },
    }
}
</script>

<style>

</style>