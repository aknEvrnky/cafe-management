<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Table from "@/Components/Table/Table.vue";
import Header from "@/Components/Header.vue";
import DropdownItem from "@/Components/Dropdown/DropdownItem.vue";
import TableRow from "@/Components/Table/TableRow.vue";
import TextColumn from "@/Components/Table/TextColumn.vue";
import ImageColumn from "@/Components/Table/ImageColumn.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    components: {
        ImageColumn,
        TextColumn,
        TableRow,
        DropdownItem,
        Table,
        AuthenticatedLayout,
        Header,
        Link,
    },
    props: {
        productCategories: {
            type: Object,
            required: true
        }
    },
    methods: {
        deleteConfirm() {
            return window.confirm('Bu kategoriyi silmek istediğinize emin misiniz? Buna bağlı tüm ürünler de silinecektir.');
        },
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <Header title="Ürün Kategorileri" dropdown-text="Yönet">
            <template v-slot:dropdown-content>
                <DropdownItem :url="route('product-categories.create')" text="Yeni Kategori Ekle" />
            </template>
        </Header>

        <Table :head-list="['Kategori Adı', 'Görsel', 'Slug', 'Aksiyon']">
            <TableRow v-for="(productCategory, index) in productCategories" :key="productCategory.id" :is-first-item="index === 0" :is-last-item="index === productCategories.length - 1">
                <TextColumn>
                    {{ productCategory.attributes.title }}
                </TextColumn>

                <ImageColumn :src="productCategory.attributes.image" />

                <TextColumn>
                    {{ productCategory.attributes.slug }}
                </TextColumn>

                <TextColumn>
                    <div class="flex gap-x-5 items-center">
                        <Link :href="route('product-categories.edit', productCategory)">Düzenle</Link>
                        <Link :onBefore="() => deleteConfirm()" method="delete" :href="route('product-categories.destroy', productCategory)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Sil</Link>
                    </div>
                </TextColumn>
            </TableRow>
        </Table>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
