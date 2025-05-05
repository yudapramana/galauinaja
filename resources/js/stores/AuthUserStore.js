import axios from 'axios';
import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import { useStorage } from '@vueuse/core';
import { useRouter } from 'vue-router';
import { useMasterDataStore } from './MasterDataStore';

export const useAuthUserStore = defineStore('AuthUserStore', () => {
    const router = useRouter();
    const masterDataStore = useMasterDataStore();

    const docsUpdateState = useStorage('AuthUserStore:docsUpdateState', ref(true));
    const firstLoadState = useStorage('AuthUserStore:firstLoadState', ref(true));
    const isAuthenticated = useStorage('AuthUserStore:isAuthenticated', ref(false));
    const activeLayout = useStorage('AuthUserStore:activeLayout', ref('user'));
    const isLoading = useStorage('AuthUserStore:activeLayout', ref(false));

    const user = useStorage('AuthUserStore:user', ref({
        name: '',
        email: '',
        role: '',
        avatar: '',
        nama_pemeriksa: '',
        nip_pemeriksa: '',
        print_layout: '',
        jabatan: '',
        org_name: '',
        org_id: '',
        username: '',
        nip: '',
        full_name: '',
        date_of_birth: '',
        gender: '',
        phone_number: '',
        job_title: '',
        id_work_unit: '',
        employment_status: '',
        tmt_pangkat: '',
        tmt_jabatan: '',
        employee: {},
        doctypes: [],
        can_multiple_role: null,
        roles: [],
        rolenames: [] // ← nama field sudah benar
    }));

    const myDocuments = useStorage('AuthUserStore:myDocuments', ref([]));
    const userDocuments = ref([]); // Untuk tampilan dokumen milik user lain (admin)
    const isAdminRole = useStorage('AuthUserStore:isAdminRole', ref(false));

    const switchLayout = () => {
        activeLayout.value = activeLayout.value === 'admin' ? 'user' : 'admin';
        router.push({ name: activeLayout.value === 'admin' ? 'admin.dashboard' : 'user.dashboard' });
    };

    const getMyDocuments = async () => {
        if (firstLoadState.value || docsUpdateState.value) {
            try {
                const response = await axios.get('/api/my-documents');
                myDocuments.value = response.data.data;
                firstLoadState.value = false;
                docsUpdateState.value = false;
            } catch (error) {
                handleAuthError(error);
            }
        }
    };

    const getDocumentsByUserId = async (userId) => {
        try {
            const response = await axios.get(`/api/user-documents/${userId}`);
            userDocuments.value = response.data.data;
        } catch (error) {
            handleAuthError(error);
        }
    };

    const getDocsUpdateState = async () => {
        try {
            const response = await axios.get('/api/docs-update-state');
            docsUpdateState.value = response.data.docs_update_state;
        } catch (error) {
            handleAuthError(error);
            docsUpdateState.value = false;
        }
    };

    const getAuthUser = async () => {
        try {
            isLoading.value = true;
            const response = await axios.get('/api/profile');
            user.value = response.data;
            console.log('user.value: ');
            console.log(user.value);
            docsUpdateState.value = response.data.docs_update_state;

            // Cek apakah user memiliki peran admin
            const roles = response.data.role_names || [];
            isAdminRole.value = roles.includes('SUPERADMIN') ||
                roles.includes('ADMIN') ||
                roles.includes('REVIEWER');

            console.log('isAdminRole.value');
            console.log(isAdminRole.value);

        } catch (error) {
            handleAuthError(error);
        } finally {
            isLoading.value = false;
        }
    };

    const logout = async () => {
        try {
            await axios.post('/logout');

            // Bersihkan data lokal
            localStorage.clear();
            sessionStorage.clear();
            document.cookie.split(";").forEach(cookie => {
                const eqPos = cookie.indexOf("=");
                const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
            });

            if ('caches' in window) {
                const cacheNames = await caches.keys();
                await Promise.all(cacheNames.map(name => caches.delete(name)));
            }

            isAuthenticated.value = false;

            // Refresh CSRF token agar tidak error saat login ulang
            await axios.get('/sanctum/csrf-cookie');

            router.push('/login');
        } catch (error) {
            console.error("Logout gagal:", error);
        }
    };


    const handleAuthError = (error) => {
        if (error.response && error.response.status === 401) {
            window.location.href = '/login';
        } else {
            console.error('Terjadi kesalahan:', error);
        }
    };

    return {
        user,
        isAuthenticated,
        docsUpdateState,
        firstLoadState,
        myDocuments,
        userDocuments,
        isAdminRole,
        activeLayout,
        isLoading,
        getAuthUser,
        getDocsUpdateState,
        getMyDocuments,
        getDocumentsByUserId,
        logout,
        switchLayout
    };
});
