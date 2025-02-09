<script>
export default {
    name: "Table",
    props: {
        headList: {
            type: Array,
            required: true
        }
    }
}
</script>

<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th v-for="item in headList" scope="col" class="px-6 py-3">
                    {{ item }}
                </th>
            </tr>
            </thead>
            <tbody>
                <slot />
            </tbody>
        </table>
    </div>

</template>

<style scoped>

</style>
