import { computed, ref, watch } from 'vue';
import { useStorage } from '@vueuse/core';
import { useRoute, useRouter } from 'vue-router';
import { useAuthUserStore } from './AuthUserStore';

export function useLayoutStore() {
  const authUserStore = useAuthUserStore();
  const route = useRoute();
  const router = useRouter();

  const roleNames = computed(() => authUserStore.user?.role_names || []);
  const canMultipleRole = computed(() => authUserStore.user?.can_multiple_role == true || authUserStore.user?.can_multiple_role == 1);

  const isAdminRole = computed(() =>
    roleNames.value.includes('SUPERADMIN') ||
    roleNames.value.includes('ADMIN') ||
    roleNames.value.includes('REVIEWER')
  );

  const isUserRole = computed(() => roleNames.value.includes('USER'));

  const isAdminRoute = computed(() => route.name?.startsWith('admin.'));
  const isUserRoute = computed(() => route.name?.startsWith('user.'));

  const activeLayout = useStorage('AuthUserStore:activeLayout', ref(isAdminRoute.value ? 'admin' : 'user'));

  // Auto switch layout on route change (only if user can't switch manually)
  watch(
    () => route.name,
    () => {
      if (!canMultipleRole.value) {
        if (isAdminRoute.value) activeLayout.value = 'admin';
        else if (isUserRoute.value) activeLayout.value = 'user';
      }
    },
    { immediate: true }
  );

  // ✅ Pindahkan switchLayout ke store
  function switchLayout() {
    activeLayout.value = activeLayout.value === 'admin' ? 'user' : 'admin';
    router.push({ name: activeLayout.value === 'admin' ? 'admin.dashboard' : 'user.dashboard' });
  }

  return {
    roleNames,
    canMultipleRole,
    isAdminRole,
    isUserRole,
    isAdminRoute,
    isUserRoute,
    activeLayout,
    switchLayout, // <- expose function
  };
}
