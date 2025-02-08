<script>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import LoginForm from "@/Components/LoginForm.vue";
import {Head} from "@inertiajs/vue3";

export default {
	name: "Create",
	components: {Head, GuestLayout, LoginForm},
}
</script>

<template>
	<GuestLayout>
        <Head title="Giriş Yap" />
		<LoginForm />
	</GuestLayout>
</template>

<style scoped>

</style>
