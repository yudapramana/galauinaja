import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';
import { useStorage } from '@vueuse/core';
import { useRouter, useRoute } from 'vue-router';
import { useMasterDataStore } from './MasterDataStore';


export const useAuthUserStore = defineStore('AuthUserStore', () => {
    const docsUpdateState =  useStorage('AuthUserStore:docsUpdateState', ref(true));
    const firstLoadState = useStorage('AuthUserStore:firstLoadState', ref(true));
    const masterDataStore = useMasterDataStore();
    const router = useRouter();
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
        email: '',
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

    const isAuthenticated = useStorage('AuthUserStore:isAuthenticated', ref(false));
    const myDocuments = useStorage('AuthUserStore:myDocuments', ref([]));
    const userDocuments = ref([]); // Untuk menyimpan dokumen user lain (admin view)

    const getMyDocuments = async () => {
        console.log('GetMyDocuments Get Called');
        console.log('firstLoadState:' + firstLoadState.value);
        console.log('docsUpdateState:' + docsUpdateState.value);

        if (firstLoadState.value || docsUpdateState.value) {
            console.log('====Masuk ke mengambil myDocuments====');
            await axios.get('/api/my-documents')
            .then((response) => {
                console.log('response.data.getMyDocuments');
                console.log(response.data);
                myDocuments.value = response.data.data;
                firstLoadState.value = false;
                docsUpdateState.value = false;
            })
            .catch((error) => {
                if (error.response && error.response.status === 401) {
                    // Redirect langsung ke login page
                    window.location.href = '/login';
                } else {
                    console.error('Terjadi kesalahan:', error);
                }
            });
        }
    }

    const getDocumentsByUserId = async (userId) => {
        try {
            const response = await axios.get(`/api/user-documents/${userId}`);
            userDocuments.value = response.data.data;
        } catch (error) {
            handleAuthError(error);
        }
    }

    const getDocsUpdateState = async () => {
        await axios.get('/api/docs-update-state')
        .then((response) => {
            console.log('response.data.getupdatestate');
            console.log(response.data);
            docsUpdateState.value = response.data.docs_update_state;
        })
        .catch((error) => {
            // console.log(error.response.data)
            docsUpdateState.value = false;
            if (error.response && error.response.status === 401) {
                // Redirect langsung ke login page
                window.location.href = '/login';
            } else {
                docsUpdateState.value = false;
                console.error('Terjadi kesalahan:', error);
            }
        });
    }

    const getAuthUser = async () => {
        // console.log('user.value.name');
        // console.log(user.value.name);

        // if (user.value.name == '') {
        await axios.get('/api/profile')
            .then((response) => {
                console.log('iko responsenyo');
                console.log(response.data);
                user.value = response.data;
                docsUpdateState.value = user.docs_update_state;
            })
            .catch((error) => {
                // console.log(error.response.data)
                if (error.response && error.response.status === 401) {
                    // Redirect langsung ke login page
                    window.location.href = '/login';
                } else {
                    console.error('Terjadi kesalahan:', error);
                }
            });
        // }
    };

    const logout = async () => {
        axios.post('/logout')
            .then((response) => {
                router.push('/login');
                // router.replace('/login');
                // Clear token from local storage
                isAuthenticated.value = false;

                // localStorage.removeItem('MasterDataStore:doctypeList');
                // localStorage.removeItem('AuthUserStore:user');
                // masterDataStore.doctypeList.value = [];
                // authUserStore.user.value = null;
                localStorage.clear();
                sessionStorage.clear();
                // user.value = null;
                // window.location.reload();
            });
    }

   

    // return { user, isAuthenticated, docsUpdateState, myDocuments, getAuthUser, getDocsUpdateState, getMyDocuments, logout };
    return {
        user,
        isAuthenticated,
        docsUpdateState,
        myDocuments,
        userDocuments,
        getAuthUser,
        getDocsUpdateState,
        getMyDocuments,
        getDocumentsByUserId,
        logout
    };
});