<script setup>
import axios from 'axios';
import { reactive, ref, nextTick } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthUserStore } from '../../stores/AuthUserStore';
import { useMasterDataStore } from '../../stores/MasterDataStore';

const authUserStore = useAuthUserStore();
const masterDataStore = useMasterDataStore();
const router = useRouter();

const form = reactive({
    username: '',
    password: '',
    remember: true,
});

const loading = ref(false);
const errorMessage = ref('');

const handleSubmit = async () => {
    loading.value = true;
    errorMessage.value = '';

    try {
        // Pastikan CSRF cookie diambil dulu
        // await axios.get('/sanctum/csrf-cookie');

        // Kirim form login
        await axios.post('/login', form);

        // Ambil data user dan dokumen
        await authUserStore.getAuthUser();
        await masterDataStore.getDoctypeList();
        await authUserStore.getMyDocuments();
        authUserStore.isAuthenticated = true;
        authUserStore.activeLayout = 'user';
        // Redirect
        router.push('/user/dashboard');

    } catch (error) {
        console.error('Login error:', error);
        errorMessage.value = error.response?.data?.message || 'Terjadi kesalahan saat login.';
    } finally {
        // Delay agar loading smooth
        setTimeout(() => {
            loading.value = false;
        }, 400);
    }
};
</script>

<template>
    <div class="login-page">
        <transition name="fade">
            <div v-if="loading" class="loading-overlay">
                <div class="spinner"></div>
                <p>Memproses login...</p>
            </div>
        </transition>

        <div class="login-box">
            <div class="login-logo text-center mb-4">
                <h1 class="mb-1" style="font-size: 1.75rem; font-weight: 700; color: #28a745;">SIGARDA</h1>
                <p class="mb-0" style="font-size: 0.95rem; font-weight: 500;">Sistem Informasi Gerbang Arsip Digital
                    Pegawai</p>
                <p style="font-size: 0.85rem; color: #6c757d;">Kementerian Agama Kab. Pesisir Selatan</p>
            </div>

            <div class="card card-outline card-success">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Silakan masuk untuk memulai sesi</p>

                    <transition name="fade">
                        <div v-if="errorMessage" class="alert alert-danger" role="alert">
                            {{ errorMessage }}
                        </div>
                    </transition>

                    <form @submit.prevent="handleSubmit" autocomplete="off">
                        <div class="input-group mb-3">
                            <input v-model="form.username" type="text" class="form-control" placeholder="NIP Anda"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input v-model="form.password" type="password" class="form-control" placeholder="Password"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" v-model="form.remember">
                                    <label for="remember">&nbsp; Remember Me</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block" :disabled="loading">
                                    <span v-if="loading">Memuat...</span>
                                    <span v-else>Sign In</span>
                                </button>
                            </div>
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="#">Lupa Password? <br> Hubungi Admin Satker</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>


<!-- <template>
    <div class="login-page">
        <transition name="fade">
            <div v-if="loading" class="loading-overlay">
                <div class="spinner"></div>
                <p>Memproses login...</p>
            </div>
        </transition>

        <div class="login-box">
            <div class="login-logo">
                <img src="http://res.cloudinary.com/kemenagpessel/image/upload/q_5,f_avif/v1709127976/profile_picture_pegawai/ssxz4kds0op8iygxosrf.png"
                    alt="logo Ekin" width="100%">
            </div>

            <div class="card card-outline card-success">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Silakan masuk untuk memulai sesi</p>

                    <transition name="fade">
                        <div v-if="errorMessage" class="alert alert-danger" role="alert">
                            {{ errorMessage }}
                        </div>
                    </transition>

                    <form @submit.prevent="handleSubmit" autocomplete="off">
                        <div class="input-group mb-3">
                            <input v-model="form.username" type="text" class="form-control" placeholder="NIP Anda" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input v-model="form.password" type="password" class="form-control" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" v-model="form.remember">
                                    <label for="remember">&nbsp; Remember Me</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block" :disabled="loading">
                                    <span v-if="loading">Memuat...</span>
                                    <span v-else>Sign In</span>
                                </button>
                            </div>
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="#">Lupa Password? <br> Hubungi Admin Satker</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template> -->

<style scoped>
.login-logo {
    margin-top: -50px !important;
    margin-bottom: 0px !important;
}

.loading-overlay {
    position: fixed;
    z-index: 999;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.85);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
    color: #555;
    transition: opacity 0.3s;
}

.spinner {
    border: 4px solid #ccc;
    border-top: 4px solid #28a745;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 0.8s linear infinite;
    margin-bottom: 10px;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
