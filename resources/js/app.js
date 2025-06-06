import './bootstrap';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js'
import 'admin-lte/dist/js/adminlte.min.js';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { createPinia } from 'pinia';
import { createRouter, createWebHistory } from 'vue-router';
import Routes from './routes.js';
import App from './App.vue';
import { useAuthUserStore } from './stores/AuthUserStore.js';
import Select2 from 'vue3-select2-component';
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import { useSettingStore } from './stores/SettingStore.js';

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

router.beforeEach(async (to, from) => {
    console.log('App.js Duluan bagian router.beforeEach');
    const authUserStore = useAuthUserStore();
    const settingStore = useSettingStore();

    console.log('authUserStore.isAuthenticated');
    console.log(authUserStore.isAuthenticated);
    if (authUserStore.isAuthenticated) {
        const mustChangePassword = authUserStore.user.must_change_password;

        // Jika user harus ganti password dan bukan di halaman ganti password, arahkan
        if (mustChangePassword && to.name !== 'user.change-password') {
            return { name: 'user.change-password' };
        }

        // Jika user TIDAK perlu ganti password tapi mencoba akses halaman ganti password, tolak
        if (!mustChangePassword && to.name === 'user.change-password') {
            return { name: 'user.dashboard' }; // atau arahkan ke halaman lain seperti dashboard
        }
    }


    // Refresh docs update state jika perlu
    

    if (authUserStore.docsUpdateState) {
        await authUserStore.getDocsUpdateState();
    }
    if (authUserStore.isAuthenticated) {
        await settingStore.getSetting();
    }

    // Layout untuk route user
    if (to.name?.startsWith('admin.')) {
        authUserStore.activeLayout = 'admin';
        document.body.classList.add('sidebar-mini');
        document.body.classList.remove('layout-top-nav');
    } else {
        authUserStore.activeLayout = 'user';
        document.body.classList.add('layout-top-nav');
        document.body.classList.remove('sidebar-mini');
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

app.use(pinia);
app.use(router);
app.use(vuetify);
app.component('Select2', Select2);
app.mount('#app');
