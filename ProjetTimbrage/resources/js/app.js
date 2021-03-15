require('./bootstrap');

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
import Toasted from 'vue-toasted';
import VCalendar from 'v-calendar';
import { MonthPickerInput } from 'vue-month-picker'

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);
Vue.use(Toasted ,{
    iconPack : 'fontawesome', // set your iconPack, defaults to material. material|fontawesome|custom-class
    fullWidth : true,
    position : 'bottom-center'
});
Vue.use(VCalendar, {
    componentPrefix: 'vc',  // Use <vc-calendar /> instead of <v-calendar />
  });
Vue.use(MonthPickerInput);

const app = document.getElementById('app');

Vue.config.devtools = true;

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
