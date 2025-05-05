import { computed, ref, watch } from 'vue';
import axios from 'axios';
import { defineStore } from 'pinia';
import { useStorage } from '@vueuse/core';
import { useRoute, useRouter } from 'vue-router';
import { useAuthUserStore } from './AuthUserStore';

export const useLayoutStore = defineStore('LayoutStore', () => {
  const authUserStore = useAuthUserStore();
  const route = useRoute();
  const router = useRouter();

  const roleNames = computed(() => authUserStore.user?.role_names || []);
  const canMultipleRole = computed(() =>
    authUserStore.user?.can_multiple_role === true ||
    authUserStore.user?.can_multiple_role === 1
  );

  const isAdminRole = computed(() =>
    roleNames.value.includes('SUPERADMIN') ||
    roleNames.value.includes('ADMIN') ||
    roleNames.value.includes('REVIEWER')
  );

  const isUserRole = computed(() => roleNames.value.includes('USER'));

  const isAdminRoute = computed(() => route.name?.startsWith('admin.'));
  const isUserRoute = computed(() => route.name?.startsWith('user.'));

  const activeLayout = useStorage(
    'LayoutStore:activeLayout',
    ref(isAdminRoute.value ? 'admin' : 'user')
  );


  // ✅ Allow switching manually if user has multiple roles
  function switchLayout() {
    activeLayout.value = activeLayout.value === 'admin' ? 'user' : 'admin';
    router.push({
      name: activeLayout.value === 'admin' ? 'admin.dashboard' : 'user.dashboard',
    });
  }

  return {
    roleNames,
    canMultipleRole,
    isAdminRole,
    isUserRole,
    isAdminRoute,
    isUserRoute,
    activeLayout,
    switchLayout,
  };
});
