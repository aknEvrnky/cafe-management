<script>
import {Link} from "@inertiajs/vue3";
import TextInput from "@/Components/Inputs/TextInput.vue";
import Checkbox from "@/Components/Inputs/Checkbox.vue";
import Fish from "@/Components/SVG/Fish.vue";

export default {
    name: "LoginForm",
    components: {
        Fish,
        Checkbox,
        Link,
        TextInput,
    },
    data() {
        return {
            email: "",
            password: "",
            rememberMe: false,
        };
    },
    methods: {
        login() {
            this.$inertia.post(route('login'), {
                email: this.email,
                password: this.password,
                remember_me: this.rememberMe,
            });
        },
    },
}
</script>

<template>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto my-auto lg:py-0">
        <!-- todo: update href laterly -->
        <Link :href="route('login')" class="flex items-center mb-6 text-2xl font-semibold text-gray-900" v-text="$page.props.app_name" />

        <div class="w-full bg-white rounded-lg shadow sm:max-w-lg xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Hesabınıza giriş yapın
                </h1>
                <form class="space-y-4 md:space-y-6" @submit.prevent="login">
                    <TextInput title="Email Adresiniz" v-model="email" name="email" type="email" required />
                    <TextInput title="Şifreniz" v-model="password" name="password" type="password" required />
                    <div class="flex items-center justify-between">
                        <Checkbox title="Beni Hatırla" v-model="rememberMe" name="remember_me" />
                        <!-- todo: update href here -->
                        <Link href="#" class="text-sm font-medium text-blue-600 hover:underline flex space-x-1">
                            <span>Şifremi Unuttum</span> <Fish class="w-4 h-4 text-blue-600 fill-blue-600" />
                        </Link>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Giriş Yap</button>
                    <p class="text-sm font-light text-gray-500">
                        Hesabınız yok mu? <Link :href="route('register')" class="font-medium text-blue-600 hover:underline" v-text="'Kayıt Ol'" />
                    </p>
                </form>
            </div>
        </div>
    </div>
</template>
