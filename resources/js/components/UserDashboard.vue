<script setup>
import axios from "axios";
import { ref, onMounted, reactive, watch, toDisplayString } from "vue";
import { formatDate, formatDateString } from '../helper.js';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import Swal from 'sweetalert2';
import moment from 'moment';
import { useStorage } from '@vueuse/core';
import { useAuthUserStore } from "../stores/AuthUserStore.js";
import { useLoadingStore } from "../stores/LoadingStore.js";
import { useDashboardStore } from "../stores/DashboardStore";
import { useMonthYearStore } from "../stores/MonthYearStore.js";
import { useScreenDisplayStore } from '../stores/ScreenDisplayStore.js';

const screenDisplayStore = useScreenDisplayStore();
const dashboardStore = useDashboardStore();
const loadingStore = useLoadingStore();
const monthYearStore = useMonthYearStore();
const authUserStore = useAuthUserStore();


const getSummary = () => {
    dashboardStore.getReportsCount();
    dashboardStore.getStatsCount();
}

onMounted(() => {
    // console.log(dashboardStore.reportCompletion.value);
});


</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Beranda</h1>
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
            <div class="row">
                <div class="col-md-6 col-sm-12 col-lg-6">
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
                                                    class="fas fa-lg fa-building"></i></span> {{ authUserStore.user.org_name }}</li>
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
                                <router-link to="/admin/profile" class="btn btn-sm btn-primary" style="display: block; font-size: small;">
                                    <i class="fas fa-user"></i>&nbsp;Lihat Profil
                                </router-link>
                                <router-link to="/admin/reports/create" class="btn btn-sm btn-success" style="display: block; font-size: small;">
                                    Input Kegiatan <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-12 col-md-4">
                    <div class="small-box bg-info">
                        <div v-if="loadingStore.isLoading" class="overlay">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>
                        <div class="inner">
                            <div class="d-flex justify-content-between">
                                <h3>{{ dashboardStore.totalWorksCount }}</h3>
                                <select v-model="monthYearStore.mySelected" @change="getSummary()"
                                    style="height: 2rem; outline: 2px solid transparent;" class="px-1 rounded border-0">
                                    <option v-for="opt in monthYearStore.myOptions" :value="opt.id" :key="opt.id">{{
                    opt.text }}</option>
                                </select>
                            </div>
                            <p>Laporan Kerja</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <router-link to="/admin/reports/create" class="small-box-footer">
                            Input Kegiatan
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div> -->

                <!-- <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div v-if="loadingStore.isLoading" class="overlay">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>
                        <div class="inner">
                            <div class="d-flex justify-content-between">
                                <h3>{{ dashboardStore.totalReportsCount }}</h3>
                                <select v-model="monthYearStore.mySelected" disabled style="height: 2rem; outline: 2px solid transparent;"
                                    class="px-1 rounded border-0">
                                    <option v-for="opt in monthYearStore.myOptions" :value="opt.id" :key="opt.id">{{ opt.text }}</option>
                                </select>
                            </div>
                            <p>Hari Bekerja</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar fa-sm"></i>
                        </div>
                        <router-link to="/admin/reports" class="small-box-footer">
                            Lihat Lap. Kinerja
                            <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                    </div>
                </div> -->
            </div>

            <div class="row" v-if="authUserStore.user.role == 'SUPERADMIN'">
                <div class="col-md-12">
                    <div class="card">

                        <div v-if="loadingStore.isLoading" class="overlay">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>
                        <div class="card-body">
                            <div class="row">


                                <div class="col-md-12">
                                    <p class="text-center">
                                        <strong>% Penyelesaian Laporan Kinerja</strong>
                                    </p>


                                    <div class="progress-group" v-for="stat in dashboardStore.reportCompletion"
                                        :key="stat.org_name">
                                        {{ stat.org_name }}
                                        <span class="float-right"><b>{{ stat.count }}</b>/ {{ stat.users_count }}</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-primary"
                                                :style="{ width: stat.percentage + '%' }">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="progress-group">
                                        Complete Purchase
                                        <span class="float-right"><b>310</b>/400</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-danger" style="width: 75%"></div>
                                        </div>
                                    </div>

                                    <div class="progress-group">
                                        <span class="progress-text">Visit Premium Page</span>
                                        <span class="float-right"><b>480</b>/800</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" style="width: 60%"></div>
                                        </div>
                                    </div>

                                    <div class="progress-group">
                                        Send Inquiries
                                        <span class="float-right"><b>250</b>/500</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-warning" style="width: 50%"></div>
                                        </div>
                                    </div> -->

                                </div>

                            </div>

                        </div>



                    </div>

                </div>

            </div>

            <!-- <div class="row">

                <div class="card">
                    <div class="card-body">
                        <div class="col-md-4">
                            <p class="text-center">
                                <strong>Goal Completion</strong>
                            </p>
                            <div class="progress-group">
                                Add Products to Cart
                                <span class="float-right"><b>160</b>/200</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 80%"></div>
                                </div>
                            </div>

                            <div class="progress-group">
                                Complete Purchase
                                <span class="float-right"><b>310</b>/400</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                                </div>
                            </div>

                            <div class="progress-group">
                                <span class="progress-text">Visit Premium Page</span>
                                <span class="float-right"><b>480</b>/800</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                </div>
                            </div>

                            <div class="progress-group">
                                Send Inquiries
                                <span class="float-right"><b>250</b>/500</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box" v-for="(stat, index) in dashboardStore.reportCompletion" :key="stat">

                        <div class="info-box-content">
                            <span class="info-box-text">{{ index }}</span>
                            <span class="info-box-number">
                                {{ stat }}
                                <small>%</small>
                            </span>
                        </div>

                    </div>

                </div>
            </div> -->
        </div>
    </div>
</template>