<template>
    <section class="content-header">
        <div class="container-fluid">
            <h3 class="text-primary">📂 Dokumen
                <!-- <small class="text-muted text-sm">User ID: {{ userId }}</small> -->
                <small class="text-muted text-sm">{{ fullName }}</small>
            </h3>
            <button class="btn btn-sm btn-secondary mt-2" @click="goBack">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </button>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-sm rounded-lg">
                <div class="card-body p-3">
                    <div class="input-group mb-3">
                        <input type="text" v-model="searchQuery" class="form-control" placeholder="Cari dokumen...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" @click="clearSearch">Reset</button>
                        </div>
                    </div>

                    <div v-if="isLoading" class="text-center p-5">
                        <div class="spinner-border text-primary mb-2" role="status"></div>
                        <div class="text-muted">Memuat dokumen...</div>
                    </div>

                    <div v-else-if="filteredTree.length" class="tree">
                        <ul class="list-unstyled mb-0">
                            <li v-for="(doctype, index) in filteredTree" :key="doctype.id" class="mb-2">
                                <div
                                    class="d-flex align-items-center justify-between cursor-pointer py-1 px-2 bg-light rounded small">
                                    <div @click="toggleExpand(doctype)" class="flex-grow-1 d-flex align-items-center">
                                        <i :class="doctype.expanded ? 'fas fa-folder-open text-warning' : 'fas fa-folder text-secondary'"
                                            class="mr-2"></i>
                                        <span class="ml-2 font-weight-bold">
                                            {{ index + 1 }}. {{ doctype.text }}
                                            <span class="badge badge-pill badge-primary ml-2">{{ doctype.files.length
                                            }}</span>
                                        </span>
                                    </div>
                                    <button class="btn btn-sm btn-success ml-2" @click="openUploadModal(doctype)">+
                                        Upload</button>
                                </div>

                                <ul v-show="doctype.expanded" class="pl-4 mt-1">
                                    <li v-for="file in doctype.files" :key="file.id"
                                        class="cursor-pointer p-1 rounded hover-bg-light small">
                                        <div class="d-flex align-items-center justify-content-between w-100">
                                            <div @click="previewFile(file.file_url)" class="d-flex align-items-center">
                                                <i class="fas fa-file-pdf text-danger mr-2"></i>
                                                <span>{{ file.file_name }}</span>
                                                <span class="badge badge-sm ml-2" :class="badgeClass(file.status)">
                                                    {{ file.status || 'Pending' }}
                                                </span>
                                            </div>
                                            <button v-if="file.status === 'Rejected'"
                                                class="btn btn-sm btn-outline-danger ml-2"
                                                @click="reuploadFile(file, doctype)">Reupload</button>
                                        </div>
                                        <div v-if="file.status === 'Rejected' && file.verif_notes"
                                            class="text-danger mt-1 ml-4 small">
                                            <i class="fas fa-info-circle"></i> Catatan: {{ file.verif_notes }}
                                        </div>
                                    </li>
                                    <li v-if="!doctype.files.length" class="text-muted small ml-4 mt-1">
                                        Tidak ada file diupload.
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div v-else class="text-center p-5">
                        <span class="text-muted">Data tidak ditemukan.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Preview -->
    <div v-if="previewUrl" class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title">Preview Dokumen</h5>
                    <button type="button" class="close" @click="previewUrl = null"><span>&times;</span></button>
                </div>
                <div class="modal-body p-2">
                    <iframe :src="previewUrl" class="w-100" style="height: 90vh; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Upload -->
    <div v-if="showUploadModal" class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Dokumen: {{ selectedDoctype?.text }}</h5>
                    <button type="button" class="close" @click="closeUploadModal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitUpload">
                        <input type="hidden" :value="selectedDoctype?.id" />

                        <div class="form-group">
                            <label>Tipe Dokumen</label>
                            <input type="text" class="form-control" :value="selectedDoctype?.text" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nomor Dokumen</label>
                            <input v-model="uploadForm.doc_number" type="text" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Dokumen</label>
                            <input v-model="uploadForm.doc_date" type="date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Parameter (Opsional)</label>
                            <input v-model="uploadForm.parameter" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Pilih File (PDF)</label>
                            <input @change="handleFileChange" type="file" class="form-control" accept="application/pdf"
                                required>
                        </div>

                        <div v-if="loadingUpload" class="mb-3">
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    :class="progressBarColor" role="progressbar"
                                    :style="{ width: uploadProgress + '%' }">
                                    {{ uploadProgress }}%
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" :disabled="loadingUpload">
                                <span v-if="loadingUpload"><i class="fas fa-spinner fa-spin"></i> Uploading...</span>
                                <span v-else>Upload</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import { useMasterDataStore } from '../stores/MasterDataStore';
import { useRouter } from 'vue-router';

const router = useRouter();

const goBack = () => {
    router.back(); // atau: router.push('/admin/users') jika ingin arah pasti
};

const props = defineProps({ userId: Number });

const treeData = ref([]);
const previewUrl = ref(null);
const searchQuery = ref('');
const isLoading = ref(false);

const showUploadModal = ref(false);
const selectedDoctype = ref(null);
const loadingUpload = ref(false);
const uploadProgress = ref(0);
const fullName = ref('');

const uploadForm = ref({
    doc_number: '',
    doc_date: '',
    parameter: '',
    file: null,
    file_id: null
});

const masterDataStore = useMasterDataStore();

const getDocumentsByUserId = async (id) => {
    const res = await axios.get(`/api/user-documents/${id}`);
    fullName.value = res.data.user.name;
    return res.data.data;
};

const fetchData = async () => {
    isLoading.value = true;
    await masterDataStore.getDoctypeList(props.userId);
    const uploadedDocs = await getDocumentsByUserId(props.userId);
    const doctypeList = masterDataStore.doctypeList;

    treeData.value = doctypeList.map((doctype) => {
        const relatedFiles = uploadedDocs.filter(doc =>
            doc.id_doc_type === doctype.id || doc.doc_type_id === doctype.id
        ).sort((a, b) => a.file_name.localeCompare(b.file_name));

        return {
            id: doctype.id,
            text: doctype.text,
            expanded: true,
            files: relatedFiles
        };
    });

    isLoading.value = false;
};

const refreshSingleFolder = async (id) => {
    const uploadedDocs = await getDocumentsByUserId(props.userId);
    const relatedFiles = uploadedDocs.filter(doc =>
        doc.id_doc_type === id || doc.doc_type_id === id
    ).sort((a, b) => a.file_name.localeCompare(b.file_name));

    const folder = treeData.value.find(f => f.id === id);
    if (folder) folder.files = relatedFiles;
};

const progressBarColor = computed(() => {
    if (uploadProgress.value < 30) return 'bg-danger';
    if (uploadProgress.value < 70) return 'bg-warning';
    return 'bg-success';
});

const filteredTree = computed(() => {
    if (!searchQuery.value) return treeData.value;
    const q = searchQuery.value.toLowerCase();
    return treeData.value.filter(doctype =>
        doctype.text.toLowerCase().includes(q) ||
        doctype.files.some(file => file.file_name.toLowerCase().includes(q))
    );
});

const badgeClass = (status) => {
    switch (status) {
        case 'Approved': return 'badge-success';
        case 'Rejected': return 'badge-danger';
        default: return 'badge-secondary';
    }
};

const toggleExpand = (doctype) => {
    doctype.expanded = !doctype.expanded;
};

const previewFile = (url) => {
    previewUrl.value = url;
};

const openUploadModal = (doctype) => {
    selectedDoctype.value = doctype;
    showUploadModal.value = true;
    uploadForm.value = {
        doc_number: '',
        doc_date: '',
        parameter: '',
        file: null,
        file_id: null
    };
};

const reuploadFile = (file, doctype) => {
    selectedDoctype.value = doctype;
    showUploadModal.value = true;
    uploadForm.value = {
        doc_number: file.doc_number || '',
        doc_date: file.doc_date || '',
        parameter: file.parameter || '',
        file: null,
        file_id: file.id
    };
};

const closeUploadModal = () => {
    showUploadModal.value = false;
};

const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (!file || file.type !== 'application/pdf' || file.size > 1024 * 1024) {
        Swal.fire({
            icon: 'error',
            title: 'File Tidak Valid',
            text: 'File harus PDF dan ukuran maksimal 1MB.'
        });
        e.target.value = '';
        return;
    }
    uploadForm.value.file = file;
};

const submitUpload = async () => {
    if (!uploadForm.value.file && !uploadForm.value.file_id) {
        return Swal.fire({ icon: 'warning', title: 'File Belum Dipilih' });
    }

    loadingUpload.value = true;
    const formData = new FormData();
    formData.append('doc_number', uploadForm.value.doc_number);
    formData.append('doc_date', uploadForm.value.doc_date);
    formData.append('parameter', uploadForm.value.parameter);
    if (uploadForm.value.file) formData.append('file', uploadForm.value.file);
    formData.append('id_doc_type', selectedDoctype.value.id);
    formData.append('user_id', props.userId); // Penting!

    try {
        if (uploadForm.value.file_id) {
            await axios.post(`/api/reupload-document/${uploadForm.value.file_id}`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' },
                onUploadProgress: (e) => {
                    if (e.total) uploadProgress.value = Math.round((e.loaded * 100) / e.total);
                }
            });
        } else {
            await axios.post(`/api/upload-document`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' },
                onUploadProgress: (e) => {
                    if (e.total) uploadProgress.value = Math.round((e.loaded * 100) / e.total);
                }
            });
        }

        Swal.fire({ icon: 'success', title: 'Upload Berhasil', timer: 1500 });
        await refreshSingleFolder(selectedDoctype.value.id);
        closeUploadModal();
    } catch (error) {
        const msg = error.response?.data?.message || 'Terjadi kesalahan.';
        Swal.fire({ icon: 'error', title: 'Upload Gagal', text: msg });
    } finally {
        loadingUpload.value = false;
        uploadProgress.value = 0;
    }
};

onMounted(fetchData);
watch(() => props.userId, fetchData);
</script>

<style scoped>
.tree ul {
    list-style-type: none;
    padding-left: 0;
}

.tree li {
    margin-bottom: 0.5rem;
}

.cursor-pointer {
    cursor: pointer;
}

.hover-bg-light:hover {
    background-color: #f1f1f1;
}

.modal {
    background-color: rgba(0, 0, 0, 0.5);
}

.badge-sm {
    font-size: 0.65rem;
    padding: 0.25em 0.4em;
}
</style>