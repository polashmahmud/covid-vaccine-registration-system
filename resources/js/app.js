import '../css/app.css';
import './bootstrap';
import "vue-toastification/dist/index.css";

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import VueTheMask from 'vue-the-mask';
import Toast, {POSITION} from "vue-toastification";
import {notification} from "@/Plugins/notification.js";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VueTheMask)
            .use(Toast, {position: POSITION.BOTTOM_RIGHT})
            .use(notification)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
