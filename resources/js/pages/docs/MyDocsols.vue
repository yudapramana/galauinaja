<template>
  <!-- <div class="content-wrapper p-3"> -->
    <section class="content-header">
      <div class="container-fluid">
        <h3 class="text-primary">📂 Daftar Dokumen</h3>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">

        <div class="card shadow-sm rounded-lg">
          <div class="card-body p-3">

            <!-- Search Box -->
            <div class="input-group mb-3">
              <input type="text" v-model="searchQuery" class="form-control" placeholder="Cari dokumen...">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" @click="clearSearch">Reset</button>
              </div>
            </div>

            <!-- Loading State -->
            <div v-if="isLoading" class="text-center p-5">
              <div class="spinner-border text-primary mb-2" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <div class="text-muted">Memuat daftar dokumen...</div>
            </div>

            <!-- Tree List -->
            <div v-else-if="filteredTree.length" class="tree">
              <ul class="list-unstyled mb-0">
                <li v-for="(doctype, index) in filteredTree" :key="doctype.id" class="mb-2">
                  <div @click="toggleExpand(doctype)"
                    class="d-flex align-items-center cursor-pointer py-1 px-2 bg-light rounded small">
                    <i :class="doctype.expanded ? 'fas fa-folder-open text-warning' : 'fas fa-folder text-secondary'"
                      class="mr-2"></i>
                    <span class="ml-2 font-weight-bold">
                      {{ index + 1 }}. {{ doctype.text }}
                      <span class="badge badge-pill badge-primary ml-2">{{ doctype.files.length }}</span>
                    </span>
                  </div>

                  <ul v-show="doctype.expanded" class="pl-4 mt-1">
                    <li v-for="file in doctype.files" :key="file.id" @click="previewFile(file.file_url)"
                      class="cursor-pointer p-1 rounded hover-bg-light small">
                      <i class="fas fa-file-pdf text-danger mr-2"></i> {{ file.file_name }}
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

    <!-- Preview Modal -->
    <div v-if="previewUrl" class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h5 class="modal-title">Preview Dokumen</h5>
            <button type="button" class="close" @click="previewUrl = null">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body p-2">
            <iframe :src="`${previewUrl}#toolbar=0&navpanes=0&scrollbar=0`" class="w-100" style="height: 90vh; border: none;"></iframe>
          </div>
        </div>
      </div>
    </div>
  <!-- </div> -->
</template>

<script setup>
import axios from 'axios';
import { useMasterDataStore } from '../../stores/MasterDataStore';
import { useAuthUserStore } from '../../stores/AuthUserStore';
import { useRouter, useRoute } from 'vue-router';
import { ref, onMounted, computed, watch } from 'vue';

const treeData = ref([]);
const previewUrl = ref(null);
const searchQuery = ref('');
const masterDataStore = useMasterDataStore();
const authUserStore = useAuthUserStore();
const isLoading = ref(false)

const fetchData = async () => {
  console.log('eh kepanggil fetchdata didalam Doclist');

  await masterDataStore.getDoctypeList();
  await authUserStore.getMyDocuments();
  const doctypeList = masterDataStore.doctypeList;
  const uploadedDocs = authUserStore.myDocuments;

  treeData.value = doctypeList.map((doctype) => {
    const relatedFiles = uploadedDocs.filter(doc =>
      (doc.id_doc_type === doctype.id ||
        doc.doc_type_id === doctype.id ||
        doc.doc_type === doctype.id) &&
      doc.status === "Approved"
    );

    return {
      id: doctype.id,
      text: doctype.text,
      expanded: true,
      files: relatedFiles
    };
  });
};

const toggleExpand = (doctype) => {
  doctype.expanded = !doctype.expanded;
};

const previewFile = (url) => {
  previewUrl.value = url;
};

const clearSearch = () => {
  searchQuery.value = '';
};

const filteredTree = computed(() => {
  if (!searchQuery.value) return treeData.value;
  const q = searchQuery.value.toLowerCase();

  return treeData.value.filter(doctype =>
    doctype.text.toLowerCase().includes(q) ||
    doctype.files.some(file => file.file_name.toLowerCase().includes(q))
  );
});

onMounted(async () => {
  isLoading.value = true
  await authUserStore.getDocsUpdateState()
  console.log('eh kepanggil fetchdata didalam onMounted Doclist')
  await fetchData()
  isLoading.value = false
});



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
</style>
