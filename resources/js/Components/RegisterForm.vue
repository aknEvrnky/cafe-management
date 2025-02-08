<script>
import {Link} from "@inertiajs/vue3";
import TextInput from "@/Components/Inputs/TextInput.vue";
import Checkbox from "@/Components/Inputs/Checkbox.vue";
import Fish from "@/Components/SVG/Fish.vue";

export default {
    name: "RegisterForm",
    components: {
        Checkbox,
        Link,
        TextInput,
    },
    data() {
        return {
            name: "",
            surname: "",
            email: "",
            password: "",
            password_confirmation: "",
        };
    },
    methods: {
        register() {
            this.$inertia.post(route('register'), {
                name: this.name,
                surname: this.surname,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
            });
        }
    },
}
</script>

<template>
    <div class="flex flex-col items-center justify-center px-6 py-8 my-auto mx-auto lg:py-0">
        <!-- todo: update href laterly -->
        <Link :href="route('login')" class="flex items-center mb-6 text-2xl font-semibold text-gray-900" v-text="$page.props.app_name" />

        <div class="w-full bg-white rounded-lg shadow sm:max-w-lg xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Yeni Hesap Oluşturun
                </h1>
                <form class="space-y-4 md:space-y-6" @submit.prevent="register">
                    <TextInput title="Adınız" v-model="name" name="name" type="text" required />

                    <TextInput title="Soyadınız" v-model="surname" name="surname" type="text" required />

                    <TextInput title="Email Adresiniz" v-model="email" name="email" type="email" required />

                    <TextInput title="Şifreniz" v-model="password" name="password" type="password" required />

                    <TextInput title="Şifre Tekrarı" v-model="password_confirmation" name="password_confirmation" type="password" required />

                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Kayıt Ol</button>

                    <p class="text-sm font-light text-gray-500">
                        Hesabınız var mı? <Link :href="route('login')" class="font-medium text-blue-600 hover:underline" v-text="'Giriş Yap'" />
                    </p>
                </form>
            </div>
        </div>
    </div>
</template>
