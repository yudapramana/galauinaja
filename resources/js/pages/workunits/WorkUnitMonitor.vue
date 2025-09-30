<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0">Monitor Satuan Kerja</h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Daftar Satker</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Work Unit Tree</h5>
        <button class="btn btn-sm btn-primary" @click="reloadTree">Refresh</button>
      </div>

      <div id="tree-container"></div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue';
import axios from 'axios';
import $ from 'jquery';
import 'jstree/dist/jstree';
import 'jstree/dist/themes/default/style.css';

const fullTree = ref([]);                 // pohon work unit dari /monitor
const unitById = ref(new Map());          // map cepat id -> unit (beserta children)
const treeReady = ref(false);
const treeInstance = ref(null);
const employeesCache = ref(new Map());    // opsional cache: unitId -> array employees

// Helper: flatten ke map id->unit (children tetap dipertahankan)
const indexUnits = (units) => {
  const map = new Map();
  const walk = (arr) => {
    for (const u of arr) {
      map.set(String(u.id), u);
      if (u.children?.length) walk(u.children);
    }
  };
  walk(units);
  return map;
};

// Siapkan data root nodes (top-level units = parent_unit null/#)
const getRootNodes = () => {
  // Ambil semua unit dengan parent null
  const roots = fullTree.value;
  return roots.map(u => ({
    id: String(u.id),
    text: u.unit_name,
    type: 'workunit',
    children: true,              // important: biar jsTree tau ada anak (lazy)
  }));
};

// Ambil child workunit untuk node tertentu dari fullTree (tanpa hit API)
const getChildUnitNodes = (unitId) => {
  const u = unitById.value.get(String(unitId));
  if (!u) return [];
  const children = u.children || [];
  return children.map(cu => ({
    id: String(cu.id),
    text: cu.unit_name,
    type: 'workunit',
    children: true,              // agar bisa di-expand terus ke bawah
  }));
};

// Fetch employees; gunakan cache opsional agar hemat
const fetchEmployees = async (unitId) => {
  const key = String(unitId);
  // COMMENT OUT cache if you always want fresh: 
  // if (employeesCache.value.has(key)) return employeesCache.value.get(key);

  const res = await axios.get(`/api/work-units/${key}/employees`);
  const list = Array.isArray(res.data) ? res.data : (res.data.data ?? []);
  employeesCache.value.set(key, list);
  return list;
};

// Buat/muat ulang tree sepenuhnya
const buildJsTree = async () => {
  await nextTick();
  const $tree = $('#tree-container');
  if ($tree.jstree(true)) $tree.jstree(true).destroy();

  $tree
    .off('.jstree')
    .jstree({
      core: {
        check_callback: true,
        themes: { stripes: true },
        // Lazy loader utama: dipanggil tiap kali butuh children
        data: async (node, cb) => {
          try {
            // Root
            if (node.id === '#') {
              cb(getRootNodes());
              return;
            }

            // Kalau node employee, tidak punya anak
            if (node.type === 'employee') {
              cb([]);
              return;
            }

            // Node workunit: gabungkan children unit + employees
            const unitId = node.id;
            const childUnitNodes = getChildUnitNodes(unitId);

            // employees on-demand
            const employees = await fetchEmployees(unitId);
            const employeeNodes = employees.map(emp => ({
              id: `emp-${unitId}-${emp.id}`,
              text: `${emp.full_name} — ${Number(emp.progress_dokumen ?? 0).toFixed(2)}%`,
              type: 'employee',
              children: false
            }));

            // Jika tidak ada apa-apa, tampilkan node info (opsional)
            if (childUnitNodes.length === 0 && employeeNodes.length === 0) {
              cb([{
                id: `info-empty-${unitId}`,
                text: 'Belum ada data.',
                type: 'info',
                children: false,
                li_attr: { class: 'text-muted' }
              }]);
              return;
            }

            cb([...childUnitNodes, ...employeeNodes]);
          } catch (e) {
            cb([{
              id: `info-error-${node.id}-${Date.now()}`,
              text: 'Gagal memuat data.',
              type: 'info',
              children: false,
              li_attr: { class: 'text-danger' }
            }]);
          }
        }
      },
      plugins: ['types'],
      types: {
        workunit: { icon: 'far fa-folder' },
        employee: { icon: 'far fa-user' },
        info:     { icon: 'far fa-circle' }
      }
    });

  treeInstance.value = $tree.jstree(true);
  treeReady.value = true;

  // (Opsional) saat klik node bisa dipakai untuk aksi lain
  $tree.on('select_node.jstree', (_e, data) => {
    // contoh: console.log('selected', data.node.id, data.node.type)
  });
};

const reloadTree = async () => {
  // kosongkan cache employee agar fresh
  employeesCache.value.clear();

  // rebuild tree
  await buildJsTree();
};

onMounted(async () => {
  // Muat struktur work unit sekali (pohon lengkap)
  const res = await axios.get('/api/work-units/monitor');
  fullTree.value = res.data || [];
  unitById.value = indexUnits(fullTree.value);
  await buildJsTree();
});
</script>

<style scoped>
#tree-container {
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 12px;
  background-color: #fafafa;
  min-height: 260px;
}
.text-muted { color: #6c757d !important; }
.text-danger { color: #dc3545 !important; }
</style>
