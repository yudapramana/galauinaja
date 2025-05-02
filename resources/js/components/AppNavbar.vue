<script setup>
import { useSettingStore } from '../stores/SettingStore';
import { useLayoutStore } from '../stores/LayoutStore'; // Tambahkan ini

const settingStore = useSettingStore();
const layoutStore = useLayoutStore(); // Tambahkan ini
</script>

<template>
  <nav class="main-header navbar navbar-expand" :class="settingStore.theme === 'dark' ? 'navbar-dark': 'navbar-light'">
    <ul class="navbar-nav">
      <li @click.prevent="settingStore.toggleMenuIcon" class="nav-item" id="toggleMenuIcon">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </li>

      <li class="nav-item">
        <a @click.prevent="settingStore.changeTheme" href="#" class="nav-link">
          <i class="far" :class="settingStore.theme === 'dark' ? 'fa-moon' : 'fa-sun'"></i>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <!-- Tombol Switch Layout -->
      <li v-if="layoutStore.canMultipleRole.value" class="nav-item">
        <button @click="layoutStore.switchLayout" class="btn btn-sm btn-primary mt-1 mr-2">
          Switch to User View
        </button>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
</template>
