<template>
  <div class="menu-container">
    <h2>Pelatihan dan Pengembangan</h2>

    <div class="menu-list">
      <div class="menu-item" @click="toggleDropdown('jadwalPelatihan')">
        <h3>Jadwal Pelatihan</h3>
        <p>Menyusun jadwal pelatihan internal atau eksternal untuk karyawan.</p>
      </div>
      <div
        v-if="isDropdownVisible.jadwalPelatihan"
        class="dropdown-form jadwal-pelatihan"
      >
        <JadwalPelatihanForm />
      </div>

      <div class="menu-item" @click="toggleDropdown('sertifikasi')">
        <h3>Sertifikasi</h3>
        <p>Dokumentasi sertifikat pelatihan atau pengembangan karyawan.</p>
      </div>
      <div
        v-if="isDropdownVisible.sertifikasi"
        class="dropdown-form sertifikasi"
      >
        <SertifikasiForm />
      </div>

      <div class="menu-item" @click="toggleDropdown('laporankemajuan')">
        <h3>Laporan Kemajuan</h3>
        <p>Memonitor hasil pelatihan dan dampaknya pada kinerja</p>
      </div>
      <div
        v-if="isDropdownVisible.laporankemajuan"
        class="dropdown-form laporankemajuan"
      >
        <LaporanKemajuan />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { onMounted, onUnmounted } from "vue";
import JadwalPelatihanForm from "../components/JadwalPelatihanForm.vue";
import SertifikasiForm from "../components/SertifikasiForm.vue";
import LaporanKemajuan from "../components/LaporanKemajuan.vue";

const isDropdownVisible = ref({
  jadwalPelatihan: false,
  sertifikasi: false,
  laporankemajuan: false,
});

const toggleDropdown = (menu) => {
  if (isDropdownVisible.value[menu]) {
    isDropdownVisible.value[menu] = false;
  } else {
    Object.keys(isDropdownVisible.value).forEach((key) => {
      isDropdownVisible.value[key] = false;
    });
    isDropdownVisible.value[menu] = true;
  }
};

const setupOutsideClickHandler = (refElement) => {
  const handleClickOutside = (event) => {
    if (!refElement.value.contains(event.target)) {
      Object.keys(isDropdownVisible.value).forEach((key) => {
        isDropdownVisible.value[key] = false;
      });
    }
  };

  onMounted(() => {
    document.addEventListener("click", handleClickOutside);
  });

  onUnmounted(() => {
    document.removeEventListener("click", handleClickOutside);
  });

  return { handleClickOutside };
};

// Contoh pemakaian di komponen Vue
// export default {
//   setup() {
//     const dropdownRef = ref(null);
//     setupOutsideClickHandler(dropdownRef);

//     return { dropdownRef, toggleDropdown };
//   },
// };
</script>

<style scoped>
.menu-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  background-color: #f4f7fc;
  min-height: 100vh;
}

h2 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}

.menu-list {
  display: flex;
  flex-direction: column;
  gap: 20px;
  width: 100%;
  max-width: 800px;
}

.menu-item {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.2s;
}

.menu-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

h3 {
  font-size: 18px;
  margin-bottom: 10px;
}

p {
  font-size: 14px;
  color: #555;
}

.dropdown-form {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 1000px;
}

.jadwal-pelatihan {
  margin-bottom: 10px;
}

.sertifikasi {
  margin-top: 10px;
}

.laporankemajuan {
  margin-top: 10px;
}

.popup-dialog {
  width: 50vw;
  max-width: 600px;
  min-height: 300px;
  z-index: 1000;
}
</style>
