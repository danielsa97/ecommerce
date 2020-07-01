<template>
    <b-card>
        <div class="d-flex wrap justify-content-center">
            <input type="file" @focus.prevent="null" ref="input_file" class="d-none" @input="fileChange"
                   :multiple="multiple">
            <div class="img-box bg-light border rounded m-1"
                 v-if="images.length"
                 v-for="image in images"
                 :key="image.name">
                <button class="btn btn-remove btn-danger" @click.prevent="removeImage(image)">&times;</button>
                <img :src="image.url" alt="Image" class="rounded cursor-pointer">
            </div>
            <button v-if="images.length === 0  || multiple"
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
                images: [],
            };
        },
        mounted() {
            let images = this.value ? (Array.isArray(this.value) ? this.value : [this.value]) : [];
            images.forEach(async image => {
                let url = route('image.index', {image});
                let blob = await fetch(url).then(r => r.blob());
                this.images.push({
                    name: image,
                    url: url,
                    file: new File([blob], image, {type: blob.type})
                });
            });
        },
        watch: {
            images(value) {
                this.$emit('input', value.length === 1 && !this.multiple ? value[0].file : value.map(image => image.file));
            }
        },
        methods: {
            removeImage(image) {
                const index = this.images.findIndex(img => img === image);
                if (index !== -1) this.images.splice(index, 1);
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
                        this.images.push({
                            name: fileName,
                            url: objectUrl,
                            file: new File([blob], fileName, {type: blob.type})
                        });
                    });
                } else {
                    this.$toast.error("Arquivo inválido");
                }
                target.value = "";
            }
        }

    }
</script>

<style scoped>
    .wrap {
        flex-wrap: wrap;
    }

    .img-box, .btn-box {
        width: 70px;
        height: 70px;
    }

    .img-box img {
        position: relative;
        top: 50%;
        left: 50%;
        transform: translateY(-50%) translateX(-50%);
        max-width: 65px;
        max-height: 65px;
        height: auto;
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
        z-index: 100;
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
