import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';
import { useLoadingStore } from "./LoadingStore";
import { useStorage } from '@vueuse/core';
import { useAuthUserStore } from "./AuthUserStore.js";

export const useMasterDataStore = defineStore('MasterDataStore', () => {
    const orgId = useStorage('MasterDataStore:orgId', ref(''));
    const userId = useStorage('MasterDataStore:userId', ref(''));

    const orgList = useStorage('MasterDataStore:orgList', ref([]));
    const userList = useStorage('MasterDataStore:userList', ref({}));
    const doctypeList = useStorage('MasterDataStore:doctypeList', ref([]));
    const workunitList = useStorage('MasterDataStore:workunitList', ref([]));


    const loadingStore = useLoadingStore();
    const authUserStore = useAuthUserStore();

    const getWorkunitList = async () => {


        if (workunitList.value.length == 0) {
            loadingStore.toggleLoading();
            await axios.get('/api/master', {
                params: {
                    type: 'workunits',
                }
            })
                .then((response) => {
                    workunitList.value = response.data.data;
                    loadingStore.toggleLoading();
                    console.log('workunitList hasbeenfetched');
                }).catch((error) => {
                    loadingStore.toggleLoading();
                    authUserStore.handleAuthError(error);
                });
        }
    };

    const getDoctypeList = async (userId = null) => {
        console.log('doctypeList.value.length:', doctypeList.value.length);
        // console.log('doctypeList.value:', doctypeList.value);
    
        if (doctypeList.value.length === 0 || authUserStore.user.role == 'SUPERADMIN') {
            loadingStore.toggleLoading();
    
            try {
                const response = await axios.get('/api/master', {
                    params: {
                        type: 'doctypes',
                        ...(userId && { user_id: userId }) // tambahkan user_id jika ada
                    }
                });
    
                doctypeList.value = response.data.data;
                // console.log('doctypeList has been fetched:', doctypeList.value);
            } catch (error) {
                console.error('doctypeList fetch error:', error);
                authUserStore.handleAuthError(error);
            } finally {
                loadingStore.toggleLoading();
            }
        }
    };

    const getUserList = async (org) => {
        // console.log('orgId');
        // console.log(org);

        loadingStore.toggleLoading();
        await axios.get('/api/master', {
            params: {
                type: 'users',
                id: org
            }
        })
            .then((response) => {
                userList.value = response.data.data;
                loadingStore.toggleLoading();
            }).catch((error) => {
                loadingStore.toggleLoading();
                authUserStore.handleAuthError(error);
            });
    };

    return {
        orgId,
        userId,
        orgList,
        userList,
        doctypeList,
        workunitList,
        getUserList,
        getDoctypeList,
        getWorkunitList
    };
});