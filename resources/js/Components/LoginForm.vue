<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "LoginForm",
    components: {
        Link,
    },
    data() {
        return {
            email: "",
            password: "",
            rememberMe: false,
        };
    },
    props: {
        appName : {
            type: String,
            required: true,
        }
    },
    methods: {
        submit() {
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
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <!-- todo: update href laterly -->
        <Link :href="route('login')" class="flex items-center mb-6 text-2xl font-semibold text-gray-900" v-text="appName" />

        <div class="w-full bg-white rounded-lg shadow sm:max-w-lg xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Hesabınıza giriş yapın
                </h1>
                <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Adresiniz</label>
                        <input v-model="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="cafem@mycafem.com" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Şifre</label>
                        <input v-model="password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " required>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input v-model="rememberMe" id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember" class="text-gray-500">Beni Hatirla</label>
                            </div>
                        </div>
                        <!-- todo: update href here -->
                        <Link href="#" class="text-sm font-medium text-primary-600 hover:underline" v-text="'Sifremi unuttum'" />
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign in</button>
                    <!-- todo: update href here -->
                    <p class="text-sm font-light text-gray-500">
                        Hesabiniz yok mu? <Link href="#" class="font-medium text-primary-600 hover:underline" v-text="'Kayit Ol'" />
                    </p>
                </form>
            </div>
        </div>
    </div>
</template>
