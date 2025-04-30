<script setup>
import { useRouter, useRoute } from 'vue-router';
import { ref, onMounted, computed, watch } from 'vue';
import { useAuthUserStore } from './stores/AuthUserStore';
import { useSettingStore } from './stores/SettingStore';
import { useMasterDataStore } from './stores/MasterDataStore.js';
import { useScreenDisplayStore } from './stores/ScreenDisplayStore.js';
import AdminLayout  from './LayoutAdmin.vue'
import GuestLayout  from './LayoutGuest.vue'

const route = useRoute();
const router = useRouter();
const authUserStore = useAuthUserStore();
const settingStore = useSettingStore();
const masterDataStore = useMasterDataStore();

const currentThemeMode = computed(() => {
    return settingStore.theme === 'dark' ? 'dark-mode' : '';
});

// watch(() => [authUserStore.isAuthenticated, route.name], function () {

//     if (!authUserStore.isAuthenticated) {
//         router.push('/login');
//     } 

//     console.log('value changes detected');
//     console.log(route.name);
// });


</script>

<template>
    <div v-if="authUserStore.isAuthenticated" class="wrapper" :class="currentThemeMode" id="app">

        <v-app app>
            <AdminLayout v-if="authUserStore.user.role == 'SUPERADMIN'"/>
            <GuestLayout v-if="authUserStore.user.role == 'USER'"/>
        </v-app>
    </div>
    <div v-else class="login-page" :class="currentThemeMode">
        <router-view></router-view>
    </div>
</template>