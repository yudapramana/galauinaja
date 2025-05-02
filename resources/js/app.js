import './bootstrap';


import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';

import 'admin-lte/dist/js/adminlte.min.js';

import 'admin-lte/plugins/summernote/summernote-bs4.min.js';

import { createApp } from 'vue/dist/vue.esm-bundler.js';

import { createPinia } from 'pinia';

import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router';

import Routes from './routes.js';

import Login from './pages/auth/Login.vue';

import App from './App.vue';

import { useAuthUserStore } from './stores/AuthUserStore.js';
import { useSettingStore } from './stores/SettingStore.js';
import { useMonthYearStore } from './stores/MonthYearStore.js';
import PrimeVue from 'primevue/config';
import { useDashboardStore } from './stores/DashboardStore.js';
import { useMasterDataStore } from './stores/MasterDataStore.js';
import Select2 from 'vue3-select2-component';
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import SummernoteEditor from 'vue3-summernote-editor';


const vuetify = createVuetify({
    components,
    directives
})

const pinia = createPinia();
const app = createApp(App);

const router = createRouter({
    routes: Routes,
    history: createWebHistory(),
});

/**
router.beforeEach(async (to, from) => {
    const authUserStore = useAuthUserStore();
    if(authUserStore.docsUpdateState){
        await authUserStore.getDocsUpdateState();
    }

    console.log('to.name');
    console.log(to.name);
    if (to.name?.startsWith('user.')) {
        console.log('masuk ubah body');
        document.body.classList.add('layout-top-nav');
        document.body.classList.remove('sidebar-mini');
      } 

    const role = authUserStore.user.role;

    const isAdminRoute = to.name?.startsWith('admin.');
    const isUserRoute = to.name?.startsWith('user.');

    // Admin atau Superadmin tidak boleh akses route user
    if ((role === 'SUPERADMIN' || role === 'ADMIN') && isUserRoute) {
        // Cegah akses dan arahkan ke halaman sebelumnya atau root
        return from.name ? false : { name: 'admin.dashboard' };
    }

    // User biasa tidak boleh akses route admin
    if (!(role === 'SUPERADMIN' || role === 'ADMIN') && isAdminRoute) {
        return from.name ? false : { name: 'user.dashboard' };
    }

    return true; // lanjutkan navigasi
});
 */

router.beforeEach(async (to, from) => {
    const authUserStore = useAuthUserStore();

    // Refresh docs update state jika perlu
    if (authUserStore.docsUpdateState) {
        await authUserStore.getDocsUpdateState();
    }

    // Layout untuk route user
    if (to.name?.startsWith('user.')) {
        document.body.classList.add('layout-top-nav');
        document.body.classList.remove('sidebar-mini');
    } else {
        document.body.classList.add('sidebar-mini');
        document.body.classList.remove('layout-top-nav');
    }

    const roleNames = authUserStore.user?.role_names || [];
    const canMultipleRole = authUserStore.user?.can_multiple_role == 1;

    console.log('canMultipleRole :' + canMultipleRole);

    const isAdminRoute = to.name?.startsWith('admin.');
    const isUserRoute = to.name?.startsWith('user.');

    const isSuperadmin = roleNames.includes('SUPERADMIN');
    const isAdmin = roleNames.includes('ADMIN');
    const isPrivileged = isSuperadmin || isAdmin;

    // ❌ Jika tidak boleh multiple role:
    if (!canMultipleRole) {
        // Admin/Superadmin dilarang akses route user
        if (isPrivileged && isUserRoute) {
            return from.name ? false : { name: 'admin.dashboard' };
        }

        // User biasa dilarang akses route admin
        if (!isPrivileged && isAdminRoute) {
            return from.name ? false : { name: 'user.dashboard' };
        }
    }

    return true;
});


// console.log('Navigating to:', to.path);

    // to.matched.forEach(record => {
    //     if (record.children) {
    //         console.log('Children of', record.path, ':');
    //         record.children.forEach(child => {
    //             console.log('  -', child.path);
    //         });
    //     }
    // });

app.use(pinia);
app.use(router);
app.use(PrimeVue);
app.use(vuetify);
app.component('Select2', Select2);
app.component('SummernoteEditor', SummernoteEditor);


// if(window.location.pathname === '/login') {
//     const currentApp = createApp({});
//     currentApp.component('Login', Login);
//     currentApp.mount('#login');
// } else {
//     app.mount('#app');
// }

app.mount('#app');
