import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

// Fontawesome Components
import {
    FontAwesomeIcon,
    FontAwesomeLayers,
    FontAwesomeLayersText,
} from "@fortawesome/vue-fontawesome";
import "./sources/icons";

// i18n
import { createI18n } from "vue-i18n";
import Langs from "./Langs/langs";
const i18n = createI18n({
    locale: "tr",
    fallbackLocale: "en",
    datetimeFormats: {
        en: Langs().translates.en.datetimeFormats,
        tr: Langs().translates.tr.datetimeFormats,
    },
    numberFormats: {
        en: Langs().translates.en.numberFormats,
        tr: Langs().translates.tr.numberFormats,
    },
    messages: {
        ...Langs().translates,
    },
});

// Components
import TContentCard from "@/Components/TContentCard.vue";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        const App = createApp({ render: () => h(app, props) });

        App.config.globalProperties.t = i18n.global.t;

        return App.use(i18n)
            .component("font-awesome-icon", FontAwesomeIcon)
            .component("font-awesome-layers", FontAwesomeLayers)
            .component("font-awesome-layers-text", FontAwesomeLayersText)
            .component("TContentCard", TContentCard)
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });
