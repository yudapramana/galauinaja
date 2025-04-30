import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';
import { useLoadingStore } from "./LoadingStore";
import { useMonthYearStore } from "./MonthYearStore.js";
import { useStorage } from '@vueuse/core';


export const useDashboardStore = defineStore('DashboardStore', () => {
    const totalWorksCount = useStorage('DashboardStore:totalWorksCount', ref(0));
    const totalReportsCount = useStorage('DashboardStore:totalReportsCount', ref(0));
    const reportCompletion = useStorage('DashboardStore:reportCompletion', ref({}));

    const monthYearStore = useMonthYearStore();
    const loadingStore = useLoadingStore();

    const getReportsCount = async () => {
        loadingStore.toggleLoading();
        // console.log(monthYearStore.mySelected);
        await axios.get('/api/stats/reports', {
            params: {
                monthyear: monthYearStore.mySelected,
            }
        })
            .then((response) => {
                totalWorksCount.value = response.data.totalWorksCount;
                totalReportsCount.value = response.data.totalReportsCount;
                loadingStore.toggleLoading();
            });
    };

    const getStatsCount = () => {
        // console.log(monthYearStore.mySelected);
        loadingStore.toggleLoading();
        axios.get('/api/stats/all', {
            params: {
                monthyear: monthYearStore.mySelected,
            }
        })
            .then((response) => {
                reportCompletion.value = response.data.reportCompletion;
                // console.log(response.data.reportCompletion);
                loadingStore.toggleLoading();
            });
    };

    return { totalWorksCount, totalReportsCount, reportCompletion, getReportsCount, getStatsCount };
});