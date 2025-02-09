<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/Inputs/TextInput.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {useToast} from "vue-toastification";
import DropdownItem from "@/Components/Dropdown/DropdownItem.vue";
import Header from "@/Components/Header.vue";

export default {
    name: "EditCurrentCafe",
    components: {
        Header,
        DropdownItem,
        Head,
        TextInput,
        AuthenticatedLayout
    },
    methods: {
        update() {
            this.formData.post(route('cafes.store', this.project),{
                onSuccess: () => {
                    this.formData.reset();
                    this.toast.success('Kafe başarıyla oluşturuldu.');
                },
                onError: () => {
                    this.formData.reset();
                    this.formData.keyword_groups = [];
                },
            });
        }
    },
    setup() {
        const toast = useToast();
        const formData = useForm({
            title: '',
            slug: '',
        });

        return {
            formData,
            toast
        }
    },
    mounted() {
        this.formData.title = this.$currentCafe().attributes.title;
        this.formData.slug = this.$currentCafe().attributes.slug;
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <Header :title="`${$currentCafe().attributes.title} - Kafesini Düzenle`" return-link-title="Yönetim Paneli" :return-link-url="route('dashboard')">
            <template v-slot:dropdown-content>
                <DropdownItem :url="route('cafes.create')" text="Yeni Kafe Ekle" />
            </template>
        </Header>

        <div class="form-area">
            <form @submit.prevent="save()" id="form">
                <div class="grid grid-cols-2 gap-x-6 gap-y-12 mb-6">
                    <TextInput title="Başlık" v-model="formData.title" name="title" required />
                    <TextInput title="Slug" v-model="formData.slug" name="title" required />
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
