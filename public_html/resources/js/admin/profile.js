require('./app');

Vue.component('main_component', require('./view_components/MainComponetnt.vue'));
import store from './stores/store.js'
import router from './routes/profile_route';
router.afterEach((to, from) => {
    // App.sidebarMainResize();
});

import i18next from 'i18next';
import VueI18Next from '@panter/vue-i18next';
Vue.use(VueI18Next);
i18next.init();
const i18n = new VueI18Next(i18next);

// import VueI18n from 'vue-i18n';
// Vue.use(VueI18n);
// const i18n = new VueI18n();



export const vue_app = new Vue({
    router,
    store,
    i18n,
    el: '#app'
});