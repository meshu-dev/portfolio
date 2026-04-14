import { createInertiaApp } from '@inertiajs/vue3';
import AuthLayout from './layouts/AuthLayout.vue';
import UserLayout from './layouts/UserLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    progress: {
        color: '#4B5563',
    },
    layout: (name) => {
        if (name.startsWith('Login')) {
            return AuthLayout
        }
        return UserLayout
    },
});
