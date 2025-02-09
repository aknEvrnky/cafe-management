<script>
export default {
    name: "ImageColumn",
    props: {
        src: {
            type: String,
            required: true
        }
    }
}
</script>

<template>
    <td class="p-4">
        <img :src="src" class="w-16 md:w-32 max-w-full max-h-full">
        <slot />
    </td>
</template>
