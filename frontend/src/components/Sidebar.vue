<template>
  <div :class="{ 'sidebar-open': isSidebarOpen, 'sidebar-close': !isSidebarOpen }">
    <div class="card flex justify-content-center">
      <Sidebar v-model:visible="isSidebarOpen" class="custom-sidebar">
        <template #container="{ closeCallback }">
          <div class="flex flex-column h-full">
            <div class="flex align-items-center justify-content-between px-4 pt-3 flex-shrink-0">
              <span class="inline-flex align-items-center gap-2">
                <span class="font-semibold text-2xl text-primary" style="padding-left: 10px">SDMP</span>
              </span>
              <span>
                <Button type="button" @click="closeCallback" icon="pi pi-times" rounded outlined
                  class="h-2rem w-2rem"></Button>
              </span>
            </div>
            <div class="overflow-y-auto">
              <ul class="list-none p-3 m-0">
                <li>
                  <div v-ripple v-styleclass="{
                    selector: '@next',
                    enterClass: 'hidden',
                    enterActiveClass: 'slidedown',
                    leaveToClass: 'hidden',
                    leaveActiveClass: 'slideup',
                  }" class="p-3 flex align-items-center justify-content-between text-600 cursor-pointer p-ripple">
                    <span class="font-medium">FAVORITES</span>
                    <i class="pi pi-chevron-down"></i>
                  </div>
                  <ul class="list-none p-0 m-0 overflow-hidden">
                    <li>
                      <a v-ripple href="/"
                        class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple">
                        <i class="pi pi-home mr-2"></i>
                        <span class="font-medium">Dashboard</span>
                      </a>
                    </li>
                    <li>
                      <a v-ripple href="/pegawai-dashboard"
                        class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple">
                        <i class="pi pi-user mr-2"></i>
                        <span class="font-medium">Pegawai</span>
                      </a>
                    </li>
                    <li>
                      <a v-ripple v-styleclass="{
                        selector: '@next',
                        enterClass: 'hidden',
                        enterActiveClass: 'slidedown',
                        leaveToClass: 'hidden',
                        leaveActiveClass: 'slideup',
                      }"
                        class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple">
                        <i class="pi pi-chart-line mr-2"></i>
                        <span class="font-medium">MASTER DATA</span>
                        <i class="pi pi-chevron-down ml-auto"></i>
                      </a>
                      <ul
                        class="list-none py-0 pl-3 pr-0 m-0 hidden overflow-y-hidden transition-all transition-duration-400 transition-ease-in-out">
                        <li>
                          <a v-ripple href="/master-jabatan"
                            class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple">
                            <i class="pi pi-chart-line mr-2"></i>
                            <span class="font-medium">Master Jabatan</span>
                          </a>
                        </li>
                        <li>
                          <a v-ripple href="/master-gaji"
                            class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple">
                            <i class="pi pi-chart-line mr-2"></i>
                            <span class="font-medium">Master Gaji</span>
                          </a>
                        </li>
                        <li>
                          <a v-ripple href="/master-departemen"
                            class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple">
                            <i class="pi pi-chart-line mr-2"></i>
                            <span class="font-medium">Master Departemen</span>
                          </a>
                        </li>
                        <li>
                          <a v-ripple href="/master-registrasi"
                            class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple">
                            <i class="pi pi-chart-line mr-2"></i>
                            <span class="font-medium">Registrasi User's</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a v-ripple v-styleclass="{
                        selector: '@next',
                        enterClass: 'hidden',
                        enterActiveClass: 'slidedown',
                        leaveToClass: 'hidden',
                        leaveActiveClass: 'slideup',
                      }"
                        class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple">
                        <i class="pi pi-chart-line mr-2"></i>
                        <span class="font-medium">SyAdministator</span>
                        <i class="pi pi-chevron-down ml-auto"></i>
                      </a>
                      <ul
                        class="list-none py-0 pl-3 pr-0 m-0 hidden overflow-y-hidden transition-all transition-duration-400 transition-ease-in-out">
                        <li>
                          <a v-ripple href="/Log-users"
                            class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple">
                            <i class="pi pi-chart-line mr-2"></i>
                            <span class="font-medium">Log User's</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li>
                  <a v-ripple href="/calendar"
                    class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple">
                    <i class="pi pi-calendar mr-2"></i>
                    <span class="font-medium">Calendar Pegawai</span>
                  </a>
                </li>
              </ul>
              <ul class="list-none p-3 m-0">
                <li>
                  <div v-ripple v-styleclass="{
                    selector: '@next',
                    enterClass: 'hidden',
                    enterActiveClass: 'slidedown',
                    leaveToClass: 'hidden',
                    leaveActiveClass: 'slideup',
                  }" class="p-3 flex align-items-center justify-content-between text-600 cursor-pointer p-ripple">
                    <span class="font-medium">APPLICATION</span>
                    <i class="pi pi-chevron-down"></i>
                  </div>
                  <ul class="list-none p-0 m-0 overflow-hidden">
                    <li>
                      <a v-ripple
                        class="flex align-items-center cursor-pointer p-3 border-round text-700 hover:surface-100 transition-duration-150 transition-colors p-ripple">
                        <i class="pi pi-cog mr-2"></i>
                        <span class="font-medium">Settings</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </template>
      </Sidebar>
      <Button v-if="$route.path !== '/auth'" class="button-wrapper" icon="pi pi-bars" @click="toggleSidebar" />
      <!-- Konten Utama -->
      <div :class="{
        'content-with-sidebar': isSidebarOpen,
        'content-full': !isSidebarOpen,
      }">
        <div class="main-content">
          <!-- <h1>Konten Utama</h1>
          <p>
            Ini adalah contoh konten utama yang akan bergeser ke kanan ketika
            sidebar muncul.
          </p> -->
          <div>
            <router-view :isSidebarOpen="isSidebarOpen" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, defineEmits, watch } from "vue";
import { useRoute } from 'vue-router';
const route = useRoute();
const isAuthPage = ref(route.path === '/auth');

watch(
  () => route.path,
  (newPath) => {
    isAuthPage.value = newPath === '/auth';
  }
);

const isSidebarOpen = ref(false); // State lokal sidebar
const emit = defineEmits(["update:isSidebarOpen"]); // Untuk mengirimkan event ke parent

function toggleSidebar() {
  isSidebarOpen.value = !isSidebarOpen.value; // Toggle status sidebar
  emit("update:isSidebarOpen", isSidebarOpen.value); // Emit status ke parent
}
</script>

<style>
/* Styling tambahan untuk menu sidebar */
/* Sidebar Styling */
/* Sidebar */
.custom-sidebar {
  position: fixed;
  top: 100px;
  left: 0;
  height: 100%;
  width: 15%;
  /* background-color: rgba(0, 0, 0, 0.8); */
  color: #fff;
  z-index: 999;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
}

.content-with-sidebar {
  margin-left: 15%;
  /* Sama dengan lebar sidebar */
  width: 85%;
  transition: margin-left 0.9s ease;
}

.custom-sidebar.sidebar-open {
  left: 0;
  /* Posisi terbuka */
}

.main-content {
  padding: 10px;
}

/* Konten utama */
.content-full {
  width: 100%;
  transition: margin-left 0.9s ease;
}

.custom-sidebar .content {
  padding: 10px;
  flex: 1;
  overflow-y: auto;
}

/* Styling Tombol */
.button-wrapper {
  position: fixed;
  top: 35px;
  /* Disesuaikan agar tidak menabrak navbar */
  left: 20px;
  z-index: 1001;
}

ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

li {
  margin: 10px 0;
}

a {
  text-decoration: none;
  color: inherit;
}
</style>
