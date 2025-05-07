import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';
import { useStorage } from '@vueuse/core';
import { useRouter } from 'vue-router';

export const useAuthUserStore = defineStore('AuthUserStore', () => {
    const router = useRouter();

    const docsUpdateState = useStorage('AuthUserStore:docsUpdateState', ref(true));
    const docsProgressState = useStorage('AuthUserStore:docsProgressState', ref(false));
    const firstLoadState = useStorage('AuthUserStore:firstLoadState', ref(true));
    const isAuthenticated = useStorage('AuthUserStore:isAuthenticated', ref(false));
    const activeLayout = useStorage('AuthUserStore:activeLayout', ref('user'));
    const isLoading = useStorage('AuthUserStore:isLoading', ref(false));
    const isLoggingOut = useStorage('AuthUserStore:isLoggingOut', ref(false)); // 👈 optional, jika butuh pisah loading logout
    const progressDokumen = useStorage('AuthUserStore:progressDokumen', ref(0));

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
        rolenames: []
    }));

    const myDocuments = useStorage('AuthUserStore:myDocuments', ref([]));
    const userDocuments = ref([]);
    const isAdminRole = useStorage('AuthUserStore:isAdminRole', ref(false));

    const switchLayout = () => {
        activeLayout.value = activeLayout.value === 'admin' ? 'user' : 'admin';
        router.push({ name: activeLayout.value === 'admin' ? 'admin.dashboard' : 'user.dashboard' });
    };

    const getMyDocuments = async () => {
        try {
            console.log('getMyDocuments Running');
            console.log('getMyDocuments docsUpdate State: ' + docsUpdateState.value);
            // isLoading.value = true;
            if (firstLoadState.value || docsUpdateState.value) {
                const response = await axios.get('/api/my-documents');
                myDocuments.value = response.data.data;
                firstLoadState.value = false;
                docsUpdateState.value = false;
            }
        } catch (error) {
            handleAuthError(error);
        } 
        // finally {
        //     isLoading.value = false;
        // }
    };

    const getDocumentsByUserId = async (userId) => {
        try {
            // isLoading.value = true;
            const response = await axios.get(`/api/user-documents/${userId}`);
            userDocuments.value = response.data.data;
        } catch (error) {
            handleAuthError(error);
        } 
        // finally {
        //     isLoading.value = false;
        // }
    };

    const getDocsUpdateState = async () => {
        try {
            console.log('getDocsUpdateState Running');

            // isLoading.value = true;
            const response = await axios.get('/api/docs-update-state');
            console.log(response.data);
            docsUpdateState.value = response.data.docs_update_state;
            docsProgressState.value = response.data.docs_progress_state;
            user.employee.progress_dokumen = res.data.progress_dokumen;
        } catch (error) {
            handleAuthError(error);
            docsUpdateState.value = false;
        } 
        // finally {
        //     isLoading.value = false;
        // }
    };

    const getAuthUser = async () => {
        try {
            console.log('getAuthUser Running');
            isLoading.value = true;
            const response = await axios.get('/api/profile');
            user.value = response.data;
            docsUpdateState.value = response.data.docs_update_state;

            const roles = response.data.role_names || [];
            isAdminRole.value = roles.includes('SUPERADMIN') ||
                                roles.includes('ADMIN') ||
                                roles.includes('REVIEWER');

            isAuthenticated.value = true;
            docsProgressState.value = response.data.employee?.docs_progress_state;
            console.log('response.data.employee?.progress_dokumen:' + response.data.employee?.progress_dokumen);
            progressDokumen.value = response.data.employee?.progress_dokumen;
        } catch (error) {
            handleAuthError(error);
        } finally {
            setTimeout(() => {
                isLoading.value = false;
            }, 2000);
        }
    };

    const logout = async () => {
        try {
            docsProgressState.value = false;
            docsUpdateState.value = true;
            isLoggingOut.value = true;
            await axios.post('/logout');

            // Bersihkan data
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
            isAdminRole.value = false;
            user.value = {};
            myDocuments.value = [];

            await axios.get('/sanctum/csrf-cookie');
            router.push('/login');
        } catch (error) {
            console.error("Logout gagal:", error);
        } finally {
            isLoggingOut.value = false;
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
        docsProgressState,
        firstLoadState,
        myDocuments,
        userDocuments,
        isAdminRole,
        activeLayout,
        isLoading,
        isLoggingOut,
        getAuthUser,
        getDocsUpdateState,
        getMyDocuments,
        getDocumentsByUserId,
        logout,
        switchLayout,
        handleAuthError
    };
});
