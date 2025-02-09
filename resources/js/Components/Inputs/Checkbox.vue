<script>
export default {
    name: "Checkbox",
    props: {
        title: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        modelValue: {
            type: Boolean,
            required: true
        }
    }
}
</script>

<template>
    <div class="flex items-start">
        <div class="flex items-center h-5">
            <input :value="modelValue" @input="$emit('update:modelValue', $event.target.checked)" :id="name" type="checkbox" class="checkbox">
        </div>
        <div class="ml-3 text-sm">
            <label :for="name" class="text-gray-500">Beni Hatırla</label>
        </div>
    </div>
</template>

<style scoped>
    .checkbox {
        @apply w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-blue-300;
    }
</style>
