<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/Inputs/TextInput.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {useToast} from "vue-toastification";
import debounce from "lodash/debounce";
import DropdownItem from "@/Components/Dropdown/DropdownItem.vue";
import Header from "@/Components/Header.vue";
import FileUploadInput from "@/Components/Inputs/FileUploadInput.vue";
import TextareaInput from "@/Components/Inputs/TextareaInput.vue";
import SelectInput from "@/Components/Inputs/SelectInput.vue";

export default {
    name: "Create",
    components: {
        SelectInput,
        FileUploadInput,
        Header,
        DropdownItem,
        Head,
        TextInput,
        TextareaInput,
        AuthenticatedLayout
    },
    props: {
        productCategories: {
            type: Object,
            required: true
        }
    },
    methods: {
        save() {
            this.formData.post(route('products.store'), {
                onSuccess: () => {
                    this.formData.reset();
                    this.toast.success('Ürün başarıyla oluşturuldu.');
                },
                onError: () => {
                    this.formData.reset();
                },
                preserveScroll: true,
                forceFormData: true
            });
        }
    },
    setup() {
        const toast = useToast();
        const formData = useForm({
            product_category_id: '',
            title: '',
            slug: '',
            description: '',
            price: '',
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
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <Header title="Ürün Oluştur" return-link-title="Ürünler" :return-link-url="route('products.index')" />

        <div class="form-area">
            <form @submit.prevent="save()" id="form" enctype="multipart/form-data">
                <div class="grid grid-cols-2 gap-x-6 gap-y-12 mb-6">
                    <SelectInput title="Kategori" name="product_category_id" :options="productCategories" v-model="formData.product_category_id" />

                    <TextInput title="Başlık" v-model="formData.title" name="title" :required="true" />

                    <TextInput title="Slug" v-model="formData.slug" name="slug" :required="true" />

                    <TextInput title="Fiyat" v-model="formData.price" name="price" type="number" :required="true" />

                    <TextareaInput title="Açıklama" v-model="formData.description" name="description" :required="true" />

                    <FileUploadInput
                        title="Görsel"
                        v-model="formData.image"
                        name="image"
                        :required="true"
                        :preview="null"
                    />

                    <div class="col-span-2 flex justify-end">
                        <button type="submit" class="btn">Oluştur</button>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.btn {
    @apply text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center;
}
</style>
