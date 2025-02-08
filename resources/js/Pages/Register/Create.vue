<script>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import RegisterForm from "@/Components/RegisterForm.vue";
import {Head} from "@inertiajs/vue3";

export default {
    name: "Create",
    components: {
        Head,
        RegisterForm,
        GuestLayout,
    },
}
</script>

<template>
    <GuestLayout>
        <Head title="Kayıt Ol" />
        <RegisterForm />
    </GuestLayout>
</template>

<style scoped>

</style>
