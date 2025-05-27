<!-- views/ChangePassword.vue -->
<template>
    <div class="max-w-md mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">Change Your Password</h1>
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-gray-700">New Password</label>
          <input v-model="newPassword" type="password" class="border rounded w-full p-2" required />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Confirm Password</label>
          <input v-model="confirmPassword" type="password" class="border rounded w-full p-2" required />
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Password</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'
  
  // Simulasi global user (bisa diganti dengan store seperti Pinia atau Vuex)
  const currentUser = {
    username: 'johndoe',
    password: 'johndoe',
    mustChangePassword() {
      return this.username === this.password
    },
    updatePassword(newPass) {
      this.password = newPass
    }
  }
  
  const router = useRouter()
  const newPassword = ref('')
  const confirmPassword = ref('')
  
  const submit = () => {
    if (newPassword.value !== confirmPassword.value) {
      alert('Passwords do not match.')
      return
    }
  
    if (newPassword.value === currentUser.username) {
      alert('Password cannot be the same as username.')
      return
    }
  
    currentUser.updatePassword(newPassword.value)
    alert('Password changed successfully!')
  
    router.push({ name: 'Home' })
  }
  </script>
  