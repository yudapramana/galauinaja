<script setup>
import { useRouter } from 'vue-router';
import { useAuthUserStore } from '../stores/AuthUserStore';
import { useSettingStore } from '../stores/SettingStore';
import CloudImage from '../components/CloudImage.vue';
import { getActivePinia } from "pinia"

const router = useRouter();
const settingStore = useSettingStore();
const authUserStore = useAuthUserStore();

const logout = () => {
    authUserStore.logout();
};

</script>
<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="#" class="brand-link">
            <img src="/app_logo.png" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ settingStore.setting.app_name }}</span>
        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <!-- <CloudImage :image-name="authUserStore.user.avatar" /> -->

                    <img :src="authUserStore.user.avatar" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block" style="font-size: small;">{{ authUserStore.user.name }}</a>
                </div>
            </div>



            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                    <li class="nav-item">
                        <router-link to="/admin/dashboard" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Beranda
                            </p>
                        </router-link>
                    </li>
                    
                    <li class="nav-item">
                        <router-link to="/admin/docusers" :class="$route.path.startsWith('/admin/docusers') ? 'active' : ''"
                            active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Daftar Upload
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/admin/vervals" :class="$route.path.startsWith('/admin/vervals') ? 'active' : ''"
                            active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Verval
                            </p>
                        </router-link>
                    </li>
                    <!-- <li class="nav-item">
                        <router-link to="/admin/reports" :class="$route.path.startsWith('/admin/reports') ? 'active' : ''"
                            active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Laporan Kerja
                            </p>
                        </router-link>
                    </li> -->
                    <!-- <li class="nav-item">
                        <router-link to="/admin/profile" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profil
                            </p>
                        </router-link>
                    </li> -->


                    <li v-if="authUserStore.user.role == 'SUPERADMIN' || authUserStore.user.role == 'ADMIN' || authUserStore.user.role == 'REVIEWER'" class="nav-header">SATUAN KERJA</li>
                    <li v-if="authUserStore.user.role == 'SUPERADMIN' || authUserStore.user.role == 'ADMIN' || authUserStore.user.role == 'REVIEWER'" class="nav-item">
                        <router-link to="/admin/org-reports" :class="$route.path.startsWith('/admin/org-reports') ? 'active' : ''"
                            active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Laporan Kerja
                            </p>
                        </router-link>
                    </li>


                    <li class="nav-header">KELOLA</li>

                    <!-- <li class="nav-item" v-if="authUserStore.user.role == 'SUPERADMIN'">
                        <router-link to="/admin/organizations" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Satuan kerja
                            </p>
                        </router-link>
                    </li> -->
                    <li class="nav-item">
                        <router-link to="/admin/workunits" :class="$route.path.startsWith('/admin/workunits') ? 'active' : ''"
                            active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Unit Kerja
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="authUserStore.user.role == 'SUPERADMIN' || authUserStore.user.role == 'ADMIN'">
                        <router-link to="/admin/users" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Pengguna
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="authUserStore.user.role == 'SUPERADMIN'">
                        <router-link to="/admin/settings" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Pengaturan
                            </p>
                        </router-link>
                    </li>
                   
                    <li class="nav-item">
                        <form class="nav-link">
                            <a href="#" @click.prevent="logout">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Keluar
                                </p>
                            </a>
                        </form>

                    </li>
                </ul>
            </nav>

        </div>

    </aside>
</template>