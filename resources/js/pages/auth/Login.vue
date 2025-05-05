<script setup>
import axios from 'axios';
import { reactive, ref } from 'vue';
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
        // Kirim form login
        await axios.post('/login', form);

        // Ambil data user
        await authUserStore.getAuthUser();
        authUserStore.isAuthenticated = true;

        // Atur layout secara default ke 'user' tanpa pengecekan peran
        authUserStore.activeLayout = 'user';

        // Ambil data dokumen dan master data
        await authUserStore.getMyDocuments();
        await masterDataStore.getDoctypeList();

        // Arahkan ke dashboard user
        router.push({ name: 'user.dashboard' });

    } catch (error) {
        console.error('Login error:', error);
        errorMessage.value = error.response?.data?.message || 'Terjadi kesalahan saat login.';
    } finally {
        loading.value = false;
    }
};

</script>

<template>
    
    <div class="login-box">
        <div class="login-logo">
            <img src="http://res.cloudinary.com/kemenagpessel/image/upload/q_5,f_avif/v1709127976/profile_picture_pegawai/ssxz4kds0op8iygxosrf.png"
                alt="logo Ekin" width="100%">
        </div>

        <div class="card card-outline card-success">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan Masuk untuk memulai sesi</p>

                <div v-if="errorMessage" class="alert alert-danger" role="alert">
                    {{ errorMessage }}
                </div>

                <form @submit.prevent="handleSubmit">
                    <div class="input-group mb-3">
                        <input v-model="form.username" type="text" class="form-control" placeholder="NIP Anda">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input v-model="form.password" type="password" class="form-control" placeholder="Password">
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
                                <div v-if="loading" class="spinner-border spinner-border-sm mr-2" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
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
</template>

<style>
.login-logo {
    margin-top: -50px !important;
    margin-bottom: 0px !important;
}
</style>
