import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';
import { useLoadingStore } from "./LoadingStore";
import { useMonthYearStore } from "./MonthYearStore.js";
import { useStorage } from '@vueuse/core';
import { useRouter, useRoute } from 'vue-router';
import { useAuthUserStore } from "./AuthUserStore.js";

export const useMasterDataStore = defineStore('MasterDataStore', () => {
    const orgId = useStorage('MasterDataStore:orgId', ref(''));
    const userId = useStorage('MasterDataStore:userId', ref(''));

    const orgList = useStorage('MasterDataStore:orgList', ref([]));
    const userList = useStorage('MasterDataStore:userList', ref({}));
    const doctypeList = useStorage('MasterDataStore:doctypeList', ref([]));
    const workunitList = useStorage('MasterDataStore:workunitList', ref([]));


    const loadingStore = useLoadingStore();
    const router = useRouter();
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
                    console.log('workunitList hasbeenerrored');

                    console.log(error.response.data)
                    if (error.response && error.response.status === 401) {
                        // Redirect langsung ke login page
                        window.location.href = '/login';
                    } else {
                        console.error('Terjadi kesalahan:', error);
                    }
                });
        }


    };

    // const getDoctypeList = async () => {

    //     console.log('doctypeList.value.lengths');
    //     console.log(doctypeList.value.length);
    //     console.log('doctypeList.value');
    //     console.log(doctypeList.value);


    //     if (doctypeList.value.length == 0) {

    //         loadingStore.toggleLoading();
    //         await axios.get('/api/master', {
    //             params: {
    //                 type: 'doctypes',
    //             }
    //         })
    //             .then((response) => {
    //                 doctypeList.value = response.data.data;
    //                 loadingStore.toggleLoading();
    //                 console.log('doctypeList hasbeenfetched');
    //             }).catch((error) => {
    //                 loadingStore.toggleLoading();
    //                 console.log('doctypeList hasbeenerrored');

    //                 console.log(error.response.data)
    //                 if (error.response && error.response.status === 401) {
    //                     // Redirect langsung ke login page
    //                     window.location.href = '/login';
    //                 } else {
    //                     console.error('Terjadi kesalahan:', error);
    //                 }
    //             });
    //     }


    // };

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
                if (error.response?.status === 401) {
                    window.location.href = '/login';
                } else {
                    console.error('Terjadi kesalahan:', error);
                }
            } finally {
                loadingStore.toggleLoading();
            }
        }
    };
    

    const getOrgList = async () => {

        // console.log('orgList.value.length');
        // console.log(orgList.value.length);

        if (orgList.value.length == 0) {
            loadingStore.toggleLoading();
            await axios.get('/api/master', {
                params: {
                    type: 'orgs',
                }
            })
                .then((response) => {
                    orgList.value = response.data.data;
                    loadingStore.toggleLoading();
                }).catch((error) => {
                    loadingStore.toggleLoading();

                    // console.log(error.response.data)
                    if (error.response && error.response.status === 401) {
                        // Redirect langsung ke login page
                        window.location.href = '/login';
                    } else {
                        console.error('Terjadi kesalahan:', error);
                    }
                });
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
                // console.log(error.response.data)
                if (error.response && error.response.status === 401) {
                    // Redirect langsung ke login page
                    window.location.href = '/login';
                } else {
                    console.error('Terjadi kesalahan:', error);
                }
            });
    };

    const getUserListbyOrgID = async (orgId) => {
        // console.log('orgId');

        loadingStore.toggleLoading();
        await axios.get('/api/master', {
            params: {
                type: 'users',
                id: orgId
            }
        })
            .then((response) => {
                userList.value = response.data.data;
                loadingStore.toggleLoading();
            }).catch((error) => {
                loadingStore.toggleLoading();
                // console.log(error.response.data)
                if (error.response && error.response.status === 401) {
                    // Redirect langsung ke login page
                    window.location.href = '/login';
                } else {
                    console.error('Terjadi kesalahan:', error);
                }
            });
    };

    return {
        orgId,
        userId,
        orgList,
        userList,
        doctypeList,
        workunitList,
        getOrgList,
        getUserList,
        getUserListbyOrgID,
        getDoctypeList,
        getWorkunitList
    };
});