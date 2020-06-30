<template>
    <b-card>
        <div class="d-flex wrap justify-content-center">
            <input type="file" ref="input_file" class="d-none" @input="fileChange">

            <div class="img-box border rounded m-1" v-if="images.length" v-for="(image, index) in images"
                 :key="index">
                <button class="btn btn-remove btn-danger" @click.prevent="removeImage(image)">&times;</button>
                <img :src="`/image/${image}`" alt="image" class="preview rounded cursor-pointer">
            </div>
            <div class="img-box border rounded m-1"
                 v-if="addedImages.length"
                 v-for="img in addedImages"
                 :key="img.name">
                <button class="btn btn-remove btn-danger" @click.prevent="removeImage(img, 'addedImages')">
                    &times;
                </button>
                <img :src="img.url" alt="image" class="preview rounded cursor-pointer">
            </div>
            <button v-if="(images.length + addedImages.length) === 0  || multiple"
                    class="btn m-1 btn-primary btn-box"
                    @click.prevent="openFile">
                <i class="fa fa-plus"/>
            </button>
        </div>
    </b-card>
</template>

<script>

    export default {
        name: "InputImage",
        props: {
            value: undefined,
            multiple: {
                type: Boolean,
                required: false,
                default: false
            }
        },
        data() {
            return {
                images: this.value ? (Array.isArray(this.value) ? this.value : [this.value]) : [],
                addedImages: []
            };
        },
        mounted() {
            this.$emit('input', null);
        },
        watch: {
            addedImages(value) {
                this.$emit('input', value.length === 1 && !this.multiple ? value[0].file : value.map(image => image.file));
            }
        },
        methods: {
            removeImage(image, list = 'images') {
                const index = this[list].findIndex(img => img === image);
                if (index !== -1) this[list].splice(index, 1);
            },
            openFile() {
                this.$refs.input_file.click();
            },
            fileChange({target}) {
                let files = Array.from(target.files);
                let validExt = ['jpeg', 'jpg', 'png'];
                let validFiles = files.some(file => {
                    let ext = file.type.split('/').pop() || false;
                    return file.type && validExt.includes(ext.toString().toLowerCase());
                });
                if (validFiles) {
                    files.forEach(async file => {
                        let objectUrl = URL.createObjectURL(file);
                        let blob = await fetch(objectUrl).then(r => r.blob());
                        let fileName = 'img_' + Math.random().toString(16).substr(7);
                        this.addedImages.push({
                            name: fileName,
                            url: objectUrl,
                            file: new File([blob], fileName, {type: blob.type})
                        });
                        target.value = "";
                    });
                } else {
                    this.$toast.error("Tipo de arquivo não suportado");
                    target.value = "";
                }
            }
        }

    }
</script>

<style scoped>
    .wrap {
        flex-wrap: wrap;
    }

    .img-box, .preview, .btn-box {
        width: 70px;
        height: 70px;
    }

    .img-box:hover > .btn-remove {
        display: block;
    }

    .btn-remove {
        display: none;
        position: absolute;
        margin-top: -15px;
        margin-left: 55px;
        width: 30px;
        height: 30px;
        border-radius: 50px;
        font-size: 20px;
        line-height: 10px;
        padding: 0;
    }

    .cursor-pointer {
        cursor: pointer;
    }
</style>
