<script>
import UploadCloud from "@/Components/SVG/UploadCloud.vue";

export default {
    name: "FileUploadInput",
    components: {UploadCloud},
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
            type: [File, String],
            required: true
        },
    },
    data() {
        return {
            preview: null,
            fileName: null
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
                    this.preview = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                this.preview = null;
            }
        },
        clearFile() {
            this.preview = null;
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
            <div v-if="!preview && !fileName" class="flex flex-col items-center justify-center pt-5 pb-6">
                <UploadCloud class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" />
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Yüklemek için tıklayın</span> ya da buraya sürükleyin</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
            </div>

            <div v-else class="flex flex-col items-center justify-center w-full h-full p-4">
                <img v-if="preview" :src="preview" class="max-h-24 object-contain mb-2" />
                <p class="text-sm text-gray-600 truncate max-w-full">{{ fileName }}</p>
                <button @click.prevent="clearFile" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <input :id="name" type="file" class="hidden" :required="required" @change="handleFileChange" accept="image/*" />
        </label>
    </div>
</template>

<style scoped>
    .label {
        @apply block mb-2 text-sm font-medium text-gray-900;
    }
</style>
