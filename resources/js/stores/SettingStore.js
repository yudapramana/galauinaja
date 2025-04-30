import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";
import { useStorage } from '@vueuse/core';

export const useSettingStore = defineStore('SettingStore', () => {
    const setting = useStorage('SettingStore:setting', {
        app_name: '',
    });
    const theme = useStorage('SettingStore:theme', ref('light'));
    const toggle = useStorage('SettingStore:toggle', ref('expanded'));

    const changeTheme = () => {
        theme.value = theme.value === 'light' ? 'dark' : 'light';
    };

    const toggleMenuIcon = () => {
        toggle.value = toggle.value === 'collapsed' ? 'sidebar-collapse' : '';
    };

    const getSetting = async () => {
        await axios.get('/api/settings')
            .then((response) => {
                setting.value = response.data;
            });
    };

    return { setting, getSetting, theme, changeTheme, toggleMenuIcon };
});