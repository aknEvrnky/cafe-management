<script>
export default {
    name: "TableRow",
    props: {
        isFirstItem: {
            type: Boolean,
            required: false,
            default: false
        },
        isLastItem: {
            type: Boolean,
            required: false,
            default: false
        }
    }
}
</script>

<template>
    <tr :class="{ 'border-b': !isFirstItem || !isLastItem, 'row':  !isLastItem}">
        <slot />
    </tr>
</template>

<style scoped>
    .row {
        @apply odd:bg-white even:bg-gray-50 border-gray-200;
    }
</style>
