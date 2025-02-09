import {usePage} from "@inertiajs/vue3";

export default {
    install(app) {
        app.config.globalProperties.$cafes = () => {
            const page = usePage();

            return page.props.auth.user.relationships.cafes;
        }

        app.config.globalProperties.$currentCafe = () => {
            const page = usePage();

            let cafes = page.props.auth.user.relationships.cafes;
            let currentCafeId = page.props.auth.user.attributes.current_cafe_id;

            return cafes.find(cafe => cafe.id === currentCafeId);
        }
    }
}
