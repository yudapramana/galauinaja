import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';
import moment from 'moment';
import { useStorage } from '@vueuse/core';




export const useMonthYearStore = defineStore('MonthYearStore', () => {
    const mySelected = useStorage('SettingStore:mySelected', ref(''));
    const myOptions = ref([
        {
            text: moment().subtract(5, 'months').format('MMMM  YYYY'),
            id: moment().subtract(5, 'months').format('YYYY-MM')
        },
        {
            text: moment().subtract(4, 'months').format('MMMM  YYYY'),
            id: moment().subtract(4, 'months').format('YYYY-MM')
        },
        {
            text: moment().subtract(3, 'months').format('MMMM  YYYY'),
            id: moment().subtract(3, 'months').format('YYYY-MM')
        },
        {
            text: moment().subtract(2, 'months').format('MMMM  YYYY'),
            id: moment().subtract(2, 'months').format('YYYY-MM')
        },
        {
            text: moment().subtract(1, 'months').format('MMMM  YYYY'),
            id: moment().subtract(1, 'months').format('YYYY-MM')
        },
        {
            text: moment().format('MMMM  YYYY'),
            id: moment().format('YYYY-MM')
        },
    ]);


    const setMonthYear = async () => {
        mySelected.value = moment().format('YYYY-MM');
    };

    return { mySelected, myOptions, setMonthYear };
});