<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/Inputs/TextInput.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {useToast} from "vue-toastification";
import debounce from "lodash/debounce";

export default {
    name: "Create",
    components: {
        Head,
        TextInput,
        AuthenticatedLayout
    },
    methods: {
        save() {
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
    setup(props) {
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
            axios.post(route('cafes.unique-slug', this.project), {
                title: value
            }).then(response => {
                this.formData.slug = response.data.slug;
                this.toast.success('Slug başarıyla oluşturuldu.');
            }).catch(() => {
                this.formData.slug = '';
            });
        }, 500),
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Kafe Oluştur" />

        <div class="form-area">
            <form @submit.prevent="save()" id="form">
                <div class="grid grid-cols-2 gap-x-6 gap-y-12 mb-6">
                    <TextInput title="Başlık" v-model="formData.title" name="title" required />
                    <TextInput title="Slug" v-model="formData.slug" name="title" required />
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
