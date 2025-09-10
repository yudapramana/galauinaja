import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";
import { useStorage } from '@vueuse/core';

export const useSettingStore = defineStore('SettingStore', () => {
    const setting = useStorage('SettingStore:setting', {
        app_name: '',
        date_format: 'YYYY-MM-DD',
        pagination_limit: 10,
        maintenance: null,
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
        // console.log('setting.value.app_name');
        // console.log(setting.value.app_name);
        if ((!setting.value.app_name) || (setting.value.maintenance == null)) {
            console.log('tidak masuk sini kan ya');
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
                });
        } else {
            // do nothing;
        }
    };

    const resetMaintenance = () => {
        setting.value.maintenance = null
    }

    return { setting, getSetting, theme, changeTheme, toggleMenuIcon, resetMaintenance };
});