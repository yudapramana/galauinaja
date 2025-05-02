<script setup>
import { useRouter, useRoute } from 'vue-router';
import { computed, watch } from 'vue';
import { useAuthUserStore } from './stores/AuthUserStore';
import { useSettingStore } from './stores/SettingStore';
import { useLayoutStore } from './stores/LayoutStore';
import AdminLayout from './LayoutAdmin.vue';
import GuestLayout from './LayoutGuest.vue';

const route = useRoute();
const router = useRouter();
const authUserStore = useAuthUserStore();
const settingStore = useSettingStore();
const layoutStore = useLayoutStore();

const {
  activeLayout,
  canMultipleRole,
  isAdminRole,
  isUserRole,
  isAdminRoute,
  isUserRoute
} = layoutStore;

const currentThemeMode = computed(() => {
  return settingStore.theme === 'dark' ? 'dark-mode' : '';
});

const showAdminLayout = computed(() =>
  activeLayout.value === 'admin' &&
  (isAdminRole.value || (canMultipleRole.value && isAdminRoute.value))
);

const showUserLayout = computed(() =>
  activeLayout.value === 'user' &&
  (isUserRole.value || (canMultipleRole.value && isUserRoute.value))
);

// Auto-switch layout on route change if can't switch manually
// watch(
//   () => route.name,
//   () => {
//     if (!canMultipleRole.value) {
//       if (isAdminRoute.value) activeLayout.value = 'admin';
//       else if (isUserRoute.value) activeLayout.value = 'user';
//     }
//   },
//   { immediate: true }
// );

// function switchLayout() {
//   activeLayout.value = activeLayout.value === 'admin' ? 'user' : 'admin';
//   router.push({ name: activeLayout.value === 'admin' ? 'admin.dashboard' : 'user.dashboard' });
// }
</script>

<template>
  <div v-if="authUserStore.isAuthenticated" class="wrapper" :class="currentThemeMode" id="app">
    <v-app app>
      <!-- <div v-if="canMultipleRole" class="p-2 text-right bg-light">
        <button @click="switchLayout" class="btn btn-sm btn-primary">
          Switch to {{ activeLayout === 'admin' ? 'User' : 'Admin' }} View
        </button>
      </div> -->

      <AdminLayout v-if="showAdminLayout" />
      <GuestLayout v-else-if="showUserLayout" />
      <div v-else class="p-4 text-center text-danger">
        <p>Layout tidak tersedia untuk role ini.</p>
      </div>
    </v-app>
  </div>

  <div v-else class="login-page" :class="currentThemeMode">
    <router-view></router-view>
  </div>
</template>



<!-- 
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

 -->