<template>
    <div>
        <label :for="name" class="label">{{ title }}</label>
        <select :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :id="name" class="input" :required="required">
            <option value="" disabled selected>Seçiniz</option>
            <option v-for="option in options" :key="getValue(option)" :value="getValue(option)">{{ getLabel(option) }}</option>
        </select>
    </div>
</template>

<script>
export default {
    name: "SelectInput",
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
        options: {
            type: Object,
            required: true
        },
        labelKey: {
            type: String,
            default: 'attributes.title'
        },
        valueKey: {
            type: String,
            default: 'id'
        }
    },
    methods: {
        getLabel(item) {
            return this.labelKey.split('.').reduce((acc, key) => acc[key], item);
        },
        getValue(item) {
            return this.valueKey.split('.').reduce((acc, key) => acc[key], item);
        }
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
