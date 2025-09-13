<script setup>
import { useAuthUserStore } from "../stores/AuthUserStore.js";
import { useScreenDisplayStore } from '../stores/ScreenDisplayStore.js';
import { useSettingStore } from "../stores/SettingStore.js";
import { reactive, ref, nextTick, onMounted } from 'vue';

const screenDisplayStore = useScreenDisplayStore();
const authUserStore = useAuthUserStore();
const settingStore = useSettingStore();
settingStore.setting.maintenance =
  ['1', 1, true, 'true', 'on'].includes(settingStore.setting.maintenance);

onMounted(() => {
    // initiation
    console.log('initiation')
    settingStore.resetMaintenance()
    settingStore.getSetting()
});


</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                    Beranda 
                    <span v-if="settingStore.setting.maintenance == true" 
                            class="badge bg-warning text-dark px-2 py-1" 
                            style="font-size: 0.7rem; vertical-align: middle;">
                        Maintenance
                    </span>
                    </h1>
                    <!-- authUserStore.isAdminRole : {{ authUserStore.isAdminRole }} <br>
                    authUserStore.activeLayout : {{ authUserStore.activeLayout }} <br> -->
                </div>
                <div class="col-sm-6" v-if="!screenDisplayStore.isMobile">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Beranda</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            
            <div v-if="settingStore.setting.maintenance == true" class="row">
                <div class="col-12 mb-2">
                    <div class="alert alert-warning alert-dismissible fade show " role="alert">
                        <strong>Pemberitahuan Pemeliharaan Sistem</strong><br>
                        Yth. Bapak/Ibu Pengguna SIGARDA, saat ini sedang dilakukan pemeliharaan sistem
                        sehubungan dengan proses integrasi storage server dengan Google Drive.
                        Selama periode ini, sebagian layanan mungkin tidak dapat diakses.
                        Kami mohon maaf atas ketidaknyamanan yang terjadi.

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9 col-sm-12 col-lg-9">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0 pb-0 mb-0">
                            {{ authUserStore.user?.employee?.job_title }}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="lead"><b>{{ authUserStore.user.name }}</b></h2>
                                    <!-- <p class="text-muted text-sm"><b>NIP: </b> {{ authUserStore.user.username }} </p> -->
                                    <ul class="ml-5 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="far fa-id-card"></i></span> {{ authUserStore.user.username }}</li>
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span> {{ authUserStore.user?.employee?.work_unit?.unit_name }}</li>
                                    </ul>
                                </div>
                                <!-- <div class="col-2 text-center">
                                    <img :src="authUserStore.user.avatar" alt="user-avatar"
                                        class="img-circle img-fluid">
                                </div> -->
                            </div>
                        </div>
                        <div class="card-footer b-0 p-0">
                            <div class="btn-group" style="width: 100% !important;">
                                <!-- <a href="#" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a> -->
                                <router-link to="/user/profile" class="btn btn-sm btn-primary" style="display: block; font-size: small;">
                                    <i class="fas fa-user"></i>&nbsp;Lihat Profil
                                </router-link>
                                <router-link to="/user/upload" class="btn btn-sm btn-success" style="display: block; font-size: small;">
                                    Input Dokumen <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                                <a
                                    v-if="authUserStore.user.role == 'SUPERADMIN'"
                                    href="/oauth/google"
                                    class="btn btn-sm btn-warning"
                                    style="display: block; font-size: small;"
                                    >
                                    <i class="fab fa-google"></i>&nbsp;Connect Google
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</template>