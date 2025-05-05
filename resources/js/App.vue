<script setup>
import { useRouter, useRoute } from 'vue-router';
import { computed } from 'vue';
import { useAuthUserStore } from './stores/AuthUserStore';
import { useSettingStore } from './stores/SettingStore';
import AdminLayout from './LayoutAdmin.vue';
import GuestLayout from './LayoutGuest.vue';

const route = useRoute();
const router = useRouter();
const authUserStore = useAuthUserStore();
const settingStore = useSettingStore();

// Mode tema (gelap / terang)
const currentThemeMode = computed(() =>
  settingStore.theme === 'dark' ? 'dark-mode' : ''
);

// Cek layout aktif berdasarkan store
const showAdminLayout = computed(() =>
  authUserStore.activeLayout === 'admin' && authUserStore.isAdminRole
);

const showUserLayout = computed(() =>
  authUserStore.activeLayout === 'user'
);
</script>

<template>
  <!-- Jika sudah login -->
  <div v-if="authUserStore.isAuthenticated" class="wrapper" :class="currentThemeMode" id="app">
    <v-app app>
    
      authUserStore.isAdminRole : {{ authUserStore.isAdminRole }} <br>
      authUserStore.activeLayout : {{ authUserStore.activeLayout }} <br>
      showAdminLayout : {{ showAdminLayout }} <br>
      showUserLayout : {{ showUserLayout }} <br>
     
      <AdminLayout v-if="showAdminLayout" />
      <GuestLayout v-else-if="showUserLayout" />
      <div v-else class="p-4 text-center text-danger">
        <p>Layout tidak tersedia untuk role ini.</p>
      </div>
    </v-app>
  </div>

  <!-- Jika belum login -->
  <div v-else class="login-page" :class="currentThemeMode">
    <router-view></router-view>
  </div>
</template>
