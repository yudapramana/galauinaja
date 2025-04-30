<template>
    <section class="content-header">
        <div class="container-fluid">
            <h1 class="mb-2">Verifikasi Dokumen Pegawai</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex">
                    <input v-model="search" type="text" class="form-control mr-2"
                        placeholder="Cari nama atau NIP pegawai..." />
                    <button class="btn btn-secondary btn-sm" @click="fetchDocuments">
                        Refresh
                    </button>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover text-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jenis Dokumen</th>
                                <th>Nomor</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="isLoading">
                                <td colspan="8" class="text-center">Memuat data...</td>
                            </tr>
                            <tr v-else-if="documents.length === 0">
                                <td colspan="8" class="text-center">Tidak ada dokumen ditemukan.</td>
                            </tr>
                            <tr v-for="(doc, index) in documents" :key="doc.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ doc.employee.full_name }}</td>
                                <td>{{ doc.employee.nip }}</td>
                                <td>{{ doc.doc_type.type_name }}</td>
                                <td>{{ doc.doc_number }}</td>
                                <td>{{ doc.doc_date }}</td>
                                <td>
                                    <span :class="{
                                        'badge badge-warning': doc.status === 'Pending',
                                        'badge badge-success': doc.status === 'Approved',
                                        'badge badge-danger': doc.status === 'Rejected',
                                    }">{{ doc.status }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary mr-1"
                                        @click="openVerifModal(doc)">Verifikasi</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Verifikasi -->

        <!-- Modal Verifikasi -->
        <div class="modal fade" id="verifModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document"> <!-- Tambahkan modal-xl agar lebar -->
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h5 class="modal-title">Verifikasi Dokumen Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body row">
                        <!-- Kolom kiri: preview PDF -->
                        <div class="col-md-7">
                            <div class="border rounded p-2" style="height: 500px; overflow: hidden;">
                                <iframe v-if="selectedDoc?.file_url" :src="selectedDoc.file_url" width="100%"
                                    height="100%" frameborder="0" style="border: 1px solid #ccc;"></iframe>
                                <div v-else class="text-muted text-center py-5">
                                    <p>File tidak tersedia.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom kanan: detail dan form -->
                        <div class="col-md-5">
                            <div class="mb-3">
                                <p><strong>Nama:</strong> {{ selectedDoc?.employee?.full_name }}</p>
                                <p><strong>NIP:</strong> {{ selectedDoc?.employee?.nip }}</p>
                                <p><strong>Jenis Dokumen:</strong> {{ selectedDoc?.doc_type?.type_name }}</p>
                                <p><strong>Nomor:</strong> {{ selectedDoc?.doc_number }}</p>
                                <p><strong>Tanggal:</strong> {{ selectedDoc?.doc_date }}</p>
                            </div>

                            <form @submit.prevent="submitVerif">
                                <div class="form-group">
                                    <label>Status Verifikasi</label>
                                    <select v-model="verifForm.status" class="form-control" required>
                                        <option value="Approved">Disetujui</option>
                                        <option value="Rejected">Ditolak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Catatan Verifikasi</label>
                                    <textarea v-model="verifForm.verif_notes" class="form-control" rows="4"
                                        placeholder="Tulis catatan jika dokumen ditolak..."></textarea>
                                </div>

                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-sm btn-primary" :disabled="isSubmitting">
                                        <i v-if="isSubmitting" class="fas fa-spinner fa-spin me-1"></i>
                                        Simpan Verifikasi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- /.modal-body -->
                </div>
            </div>
        </div>



        <!-- <div class="modal fade" id="verifModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h5 class="modal-title">Verifikasi Dokumen</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-2">
                        <div class="mb-2">
                            <strong>Dokumen:</strong> {{ selectedDoc?.doc_type?.name }}<br />
                            <strong>Nomor:</strong> {{ selectedDoc?.doc_number }}<br />
                            <strong>Tanggal:</strong> {{ selectedDoc?.doc_date }}<br />
                            <a :href="selectedDoc?.file_path" target="_blank" class="btn btn-link p-0">Lihat Dokumen</a>
                        </div>
                        <form @submit.prevent="submitVerif">
                            <div class="form-group">
                                <label>Status Verifikasi</label>
                                <select v-model="verifForm.status" class="form-control" required>
                                    <option value="Approved">Disetujui</option>
                                    <option value="Rejected">Ditolak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Catatan Verifikasi</label>
                                <textarea v-model="verifForm.verif_notes" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-sm btn-primary" :disabled="isSubmitting">
                                    <i v-if="isSubmitting" class="fas fa-spinner fa-spin me-1"></i>
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
    </section>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { useDebounceFn } from '@vueuse/core'
import axios from 'axios'

const search = ref('')
const documents = ref([])
const isLoading = ref(false)
const isSubmitting = ref(false)
const selectedDoc = ref(null)
const verifForm = ref({ status: '', verif_notes: '' })

const fetchDocuments = async () => {
    isLoading.value = true
    try {
        const res = await axios.get('/api/emp-documents', {
            params: { search: search.value },
        })
        documents.value = res.data.data
    } catch (err) {
        console.error('Gagal memuat dokumen', err)
    } finally {
        isLoading.value = false
    }
}

const openVerifModal = (doc) => {
    selectedDoc.value = doc
    verifForm.value = {
        status: doc.status,
        verif_notes: doc.verif_notes || '',
    }
    $('#verifModal').modal('show')
}

const submitVerif = async () => {
    isSubmitting.value = true
    try {
        await axios.put(`/api/emp-documents/${selectedDoc.value.id}/verify`, verifForm.value)
        $('#verifModal').modal('hide')
        fetchDocuments()
    } catch (error) {
        alert('Gagal memverifikasi dokumen.')
    } finally {
        isSubmitting.value = false
    }
}

onMounted(fetchDocuments)
watch(search, useDebounceFn(() => fetchDocuments(), 300))
</script>
