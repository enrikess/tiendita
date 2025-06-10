import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { renderToString } from '@vue/server-renderer';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createSSRApp, h, type DefineComponent } from 'vue';
import { route as ziggyRoute } from 'ziggy-js';

// Definición de tipos para el entorno
interface ImportMetaEnv {
    readonly VITE_APP_NAME: string;
    [key: string]: string | boolean | undefined;
}

interface ImportMeta {
    readonly env: ImportMetaEnv;
    readonly glob: <T>(pattern: string) => Record<string, () => Promise<T>>;
}

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createServer((page: any) =>
    createInertiaApp({
        page,
        render: renderToString,
        title: (title) => `${title} - ${appName}`,
        resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
        setup({ App, props, plugin }) {
            const app = createSSRApp({ render: () => h(App, props) });

            // Configure Ziggy for SSR...
            const ziggyConfig = {
                ...page.props.ziggy,
                location: new URL(page.props.ziggy.location),
            };

            // Create route function...
            const route: any = (name: string, params?: any, absolute?: boolean) =>
                ziggyRoute(name, params, absolute, ziggyConfig as any);

            // Make route function available globally...
            app.config.globalProperties.route = route;

            // Make route function available globally for SSR...
            if (typeof window === 'undefined') {
                // En SSR, podemos asignar a globalThis para evitar problemas con 'global'
                (globalThis as any).route = route;
            }

            app.use(plugin);

            return app;
        },
    }),
);
