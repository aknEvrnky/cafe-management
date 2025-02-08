<script>
import {useToast} from "vue-toastification";

export default {
    name: "GuestLayout",
    setup() {
        const toast = useToast();

        return {
            toast,
        }
    },
    watch: {
        '$page.props.flash': {
            handler (flash) {
                if (flash.success) {
                    this.toast.success(flash.success);
                }
                if (flash.error) {
                    this.toast.error(flash.error);
                }
                if (flash.warning) {
                    this.toast.warning(flash.warning);
                }
            },
            deep: true,
            immediate: true
        },
        '$page.props.errors': {
            handler (errors) {
                if (errors) {
                    for (let key in errors) {
                        this.toast.error(errors[key]);
                    }
                }
            },
            deep: true,
            immediate: true
        },
    },
}
</script>

<template>
    <div class="container mx-auto">
        <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg mx-auto">
            <slot/>
        </div>
    </div>
</template>
