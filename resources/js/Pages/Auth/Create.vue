<script>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import LoginForm from "@/Components/LoginForm.vue";

export default {
	name: "Create",
	components: {GuestLayout, LoginForm},
	props: {
		appName: {
			type: String,
			required: true,
		}
	},
}
</script>

<template>
	<GuestLayout>
		<LoginForm :appName="appName" />
	</GuestLayout>
</template>

<style scoped>

</style>
