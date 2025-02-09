<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/Inputs/TextInput.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {useToast} from "vue-toastification";
import debounce from "lodash/debounce";
import DropdownItem from "@/Components/Dropdown/DropdownItem.vue";
import Header from "@/Components/Header.vue";

export default {
    name: "Create",
    components: {
        Header,
        DropdownItem,
        Head,
        TextInput,
        AuthenticatedLayout
    },
    methods: {
        save() {
            this.formData.post(route('cafes.store'), {
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
    watch: {
        'formData.title': debounce(function (value) {
            axios.post(route('cafes.unique-slug', {
                title: value
            }).then(response => {
                this.formData.slug = response.data.slug;
                this.toast.success('Slug başarıyla oluşturuldu.');
            }).catch(() => {
                this.formData.slug = '';
            }));
        }, 500),
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <Header title="Kafe Oluştur" return-link-title="Yönetim Paneli" :return-link-url="route('dashboard')" />

        <div class="form-area">
            <form @submit.prevent="save()" id="form">
                <div class="grid grid-cols-2 gap-x-6 gap-y-12 mb-6">
                    <TextInput title="Başlık" v-model="formData.title" name="title" required />
                    <TextInput title="Slug" v-model="formData.slug" name="slug" required />
                    <div class="col-span-2 flex justify-end">
                        <button type="submit" class="btn">Oluştur</button>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
