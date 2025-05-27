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
            }).catch((error) => {
                // Bersihkan data
                localStorage.clear();
                sessionStorage.clear();
                document.cookie.split(";").forEach(cookie => {
                    const eqPos = cookie.indexOf("=");
                    const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
                });
            })
    };

    return { setting, getSetting, theme, changeTheme, toggleMenuIcon };
});