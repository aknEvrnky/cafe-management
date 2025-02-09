<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/Inputs/TextInput.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {useToast} from "vue-toastification";
import debounce from "lodash/debounce";
import DropdownItem from "@/Components/Dropdown/DropdownItem.vue";
import Header from "@/Components/Header.vue";
import FileUploadInput from "@/Components/Inputs/FileUploadInput.vue";

export default {
    name: "Edit",
    components: {
        FileUploadInput,
        Header,
        DropdownItem,
        Head,
        TextInput,
        AuthenticatedLayout
    },
    props: {
        productCategory: {
            type: Object,
            required: true
        }
    },
    methods: {
        update() {
            this.formData.put(route('product-categories.update', this.productCategory),{
                onSuccess: () => {
                    this.formData.reset();
                    this.toast.success('Kafe başarıyla güncellendi.');
                },
                onError: () => {
                    this.formData.reset();
                    this.formData.keyword_groups = [];
                },
            });
        },
        deleteConfirm() {
            return window.confirm('Bu kategoriyi silmek istediğinize emin misiniz? Buna bağlı tüm ürünler de silinecektir.');
        },
    },
    setup(props) {
        const toast = useToast();
        const formData = useForm({
            title: props.productCategory.attributes.title,
            slug: props.productCategory.attributes.slug,
            image: null,
        });

        return {
            formData,
            toast
        }
    },
    watch: {
        'formData.title': debounce(function (value) {
            this.formData.slug = value.toLowerCase().replace(/ /g, '-');
        }, 500)
    },
}
</script>

<template>
    <AuthenticatedLayout>
        <Header :title="`${productCategory.attributes.title} - Kategorisini Düzenle`" dropdown-text="Yönet" return-link-title="Ürün Kategorileri" :return-link-url="route('product-categories.index')">
            <template v-slot:dropdown-content>
                <DropdownItem :url="route('product-categories.create')" text="Yeni Kategori Ekle" />
                <DropdownItem :onBefore="() => deleteConfirm()" method="delete" :url="route('product-categories.destroy', productCategory)">
                    <span class="text-red-500">
                        Kategoriyi Sil
                    </span>
                </DropdownItem>
            </template>
        </Header>

        <div class="form-area">
            <form @submit.prevent="update()" id="form">
                <div class="grid grid-cols-2 gap-x-6 gap-y-12 mb-6">
                    <TextInput title="Başlık" v-model="formData.title" name="title" :required="true" />
                    <TextInput title="Slug" v-model="formData.slug" name="slug" :required="true" />
                    <FileUploadInput title="Görsel" :preview="productCategory.attributes.image" v-model="formData.image" name="image" :required="true" />
                    <div class="col-span-2 flex justify-end">
                        <button type="submit" class="btn">Güncelle</button>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
