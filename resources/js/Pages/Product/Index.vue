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
        products: {
            type: Object,
            required: true
        }
    },
    methods: {
        deleteConfirm() {
            return window.confirm('Bu ürünü silmek istediğinize emin misiniz?');
        },
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <Header title="Ürünler" dropdown-text="Yönet">
            <template v-slot:dropdown-content>
                <DropdownItem :url="route('products.create')" text="Yeni Ürün Ekle" />
            </template>
        </Header>

        <Table :head-list="['Ürün Adı', 'Kategori Adı', 'Görsel', 'Fiyat', 'Açıklama', 'Aksiyon']">
            <TableRow v-for="(product, index) in products" :key="product.id" :is-first-item="index === 0" :is-last-item="index === products.length - 1">
                <TextColumn>
                    {{ product.attributes.title }}
                </TextColumn>

                <TextColumn>
                    {{ product.relationships.product_category.attributes.title }}
                </TextColumn>

                <ImageColumn :src="product.attributes.image" />

                <TextColumn>
                    {{ product.attributes.price }}
                </TextColumn>

                <TextColumn>
                    {{ product.attributes.description }}
                </TextColumn>

                <TextColumn>
                    <div class="flex gap-x-5 items-center">
                        <Link :href="route('products.edit', product)">Düzenle</Link>
                        <Link :onBefore="() => deleteConfirm()" method="delete" :href="route('products.destroy', product)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Sil</Link>
                    </div>
                </TextColumn>
            </TableRow>
        </Table>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
