<template>
    <div class="form-group">
        <input type="hidden" :name="inputName" v-model="this.result">
        <div class="custom-file">
            <label class="custom-file-label" ref="fileLabel">{{ inputLabel }}</label>
            <input type="file" class="form-control" ref="fileContainer" @change="onChangeFile">
        </div>
        <div class="my-3 progress">
            <div class="progress-bar" role="progressbar" v-bind:style="{ width: progress + '%' }" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</template>

<script>
import { uploadService } from './../services';
export default {
    data() {
        return {
            label: 'Выберите файл',
            file: null,
            progress: 0,
            result: null,
        };
    },
    props: {
        inputName: String,
        inputLabel: String,
    },
    methods: {
        onChangeFile() {
            const file = this.$refs.fileContainer.files;
            this.file = file.length > 0 ? file[0] : null;
            if (null !== this.file) {
                this.label = `${this.file.name}`;
            } else {
                this.label = 'Choose File';
            }

            if (null === this.file) {
                alert('Выберите файл.');
            } else {
                this.progress = 0;
                this.result = null;
                uploadService.chunk(
                    '/api/chunk',
                    this.file,
                    // onProgress
                    percent => {
                        this.progress = percent;
                    },
                    // onError
                    err => {
                        alert('Произошла ошибка!');
                        console.log(err);
                    },
                    // onSuccess
                    res => {
                        const { data } = res;
                        this.result = data.chunk_id;
                    }
                );
            }
        }
    }
}
</script>

