<template>
    <div>
        <label :for="name" class="label">{{ title }}</label>
        <textarea :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :id="name" class="input" :placeholder="title" :required="required">
        </textarea>
    </div>
</template>

<script>
export default {
    name: "TextareaInput",
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
            type: String,
            required: true
        },
    }
}
</script>

<style scoped>
.label {
    @apply block mb-2 text-sm font-medium text-gray-900;
}
.input {
    @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5;
}
</style>
