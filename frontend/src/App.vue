<script setup>
import Sidebar from './components/Sidebar.vue';
import Navbar from './components/Navbar.vue';
import { ref } from 'vue';
import { useRoute } from 'vue-router'; // Import useRoute


const isSidebarOpen = ref(false);
const route = useRoute(); // Gunakan useRoute untuk mendapatkan meta field

function handleSidebarToggle(status) {
  isSidebarOpen.value = status;
}
</script>

<template>
  <div id="app">
    <Navbar v-if="!route.meta.hideNavbar" /> <!-- Kirim prop dan dengar event untuk toggle sidebar -->
    <Sidebar :isSidebarOpen="isSidebarOpen" @update:isSidebarOpen="handleSidebarToggle" />
    <!-- Konten utama yang dipengaruhi status sidebar -->
    <!-- <div>
      <router-view :isSidebarOpen="isSidebarOpen" />
    </div> -->
  </div>
</template>


<style scoped>
.content-full {
  margin-left: 0;
  transition: margin-left 0.3s ease;
}

.content-with-sidebar {
  margin-left: 15%;
  /* Lebar sidebar */
  transition: margin-left 0.3s ease;
}

.content {
  max-width: 1910px;
  width: 100%;
  margin-left: auto;
  margin-right: auto;
}
</style>
