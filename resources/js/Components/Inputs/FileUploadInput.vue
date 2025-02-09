<script>
import UploadCloud from "@/Components/SVG/UploadCloud.vue";
import Cross from "@/Components/SVG/Cross.vue";

export default {
    name: "FileUploadInput",
    components: {Cross, UploadCloud},
    props: {
        title: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        required: {
            type: Boolean,
            default: false
        },
        modelValue: {
            type: [File, null],
            default: null
        },
        preview: {
            type: String,
            default: null
        }
    },
    data() {
        return {
            localPreview: null,
            fileName: null
        }
    },
    computed: {
        displayPreview() {
            return this.localPreview || this.preview;
        },
        displayFileName() {
            if (this.fileName) return this.fileName;
            if (this.preview) return this.preview.split('/').pop();
            return null;
        },
        isInputRequired() {
            // Eğer preview varsa veya dosya seçilmişse required olmamalı
            return this.required && !this.preview && !this.modelValue;
        }
    },
    methods: {
        handleFileChange(event) {
            const file = event.target.files[0];
            if (!file) return;

            this.fileName = file.name;
            this.$emit('update:modelValue', file);

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    this.localPreview = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                this.localPreview = null;
            }
        },
        clearFile() {
            this.localPreview = null;
            this.fileName = null;
            this.$emit('update:modelValue', null);
        }
    },
    emits: ['update:modelValue']
}
</script>

<template>
    <div class="w-full">
        <label class="label">{{ title }}</label>
        <label :for="name" class="flex flex-col items-center justify-center w-full h-36 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 relative">
            <div v-if="!displayPreview && !fileName" class="flex flex-col items-center justify-center pt-5 pb-6">
                <UploadCloud class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" />
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Yüklemek için tıklayın</span> ya da buraya sürükleyin</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>

            <div v-else class="flex flex-col items-center justify-center w-full h-full p-4">
                <img v-if="displayPreview" :src="displayPreview" class="max-h-24 object-contain mb-2" alt="Preview" />
                <p class="text-sm text-gray-600 truncate max-w-full">{{ displayFileName }}</p>
                <button @click.prevent="clearFile" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <Cross class="h-5 w-5" />
                </button>
            </div>

            <input :id="name" type="file" class="hidden" :required="isInputRequired" @change="handleFileChange" accept="image/*" />
        </label>
    </div>
</template>

<style scoped>
    .label {
        @apply block mb-2 text-sm font-medium text-gray-900;
    }
</style>
