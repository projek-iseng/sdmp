<template>
  <div class="container">
    <h1>Manajemen Karyawan</h1>

    <!-- Pencarian & Filter -->
    <div class="controls">
      <input
        type="text"
        v-model="searchQuery"
        placeholder="Cari karyawan..."
        class="search-input"
      />
      <select v-model="selectedDepartment" @change="filterByDepartment">
        <option value="">Semua Departemen</option>
        <option
          v-for="department in allDepartments"
          :key="department"
          :value="department"
        >
          {{ department }}
        </option>
      </select>
    </div>

    <!-- Data Karyawan -->
    <table class="employee-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Kontak</th>
          <th>Status</th>
          <th>Departemen</th>
          <th>Jabatan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="employee in paginatedEmployees" :key="employee.id">
          <td>{{ employee.id }}</td>
          <td>{{ employee.name }}</td>
          <td>{{ employee.address }}</td>
          <td>{{ employee.contactNumber }}</td>
          <td>{{ employee.status }}</td>
          <td>{{ employee.department }}</td>
          <td>{{ employee.jobTitle }}</td>
          <td><button @click="showHistory(employee.id)">Riwayat</button></td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
      <button @click="prevPage" :disabled="currentPage === 1">
        &laquo; Prev
      </button>
      <span>Halaman {{ currentPage }}</span>
      <button
        @click="nextPage"
        :disabled="currentPage * rowsPerPage >= employees.length"
      >
        Next &raquo;
      </button>
    </div>

    <!-- Modal Riwayat Kerja -->
    <div v-if="showModal" class="modal">
      <div class="modal-content">
        <h2>Riwayat Kerja</h2>
        <ul>
          <li v-for="history in selectedEmployeeHistory" :key="history.date">
            {{ history.date }} - {{ history.event }}
          </li>
        </ul>
        <button @click="showModal = false">Tutup</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
import Button from "primevue/button";

const employeeData = Array.from({ length: 50 }, (v, i) => ({
  id: i + 1,
  name: `Karyawan ${i + 1}`,
  address: `Alamat ${i + 1}`,
  contactNumber: `0812-3456-78${String(i).padStart(2, "0")}`,
  status: i % 2 === 0 ? "Aktif" : "Non-aktif",
  department: i % 3 === 0 ? "HR" : i % 3 === 1 ? "IT" : "Finance",
  jobTitle: i % 2 === 0 ? "Manager" : "Staff",
  workHistory: [
    { date: "2023-01-01", event: "Diterima di perusahaan" },
    { date: "2024-01-01", event: "Promosi jabatan" },
  ],
}));

const allDepartments = ["HR", "IT", "Finance"];
const selectedDepartment = ref("");
const searchQuery = ref("");
const employees = ref(employeeData);
const rowsPerPage = ref(5);
const currentPage = ref(1);
const showModal = ref(false);
const selectedEmployeeId = ref(null);

const filterByDepartment = () => {
  employees.value = employeeData.filter(
    (e) =>
      (selectedDepartment.value
        ? e.department === selectedDepartment.value
        : true) &&
      (searchQuery.value
        ? e.name.toLowerCase().includes(searchQuery.value.toLowerCase())
        : true)
  );
  currentPage.value = 1;
};

const paginatedEmployees = computed(() => {
  const start = (currentPage.value - 1) * rowsPerPage.value;
  return employees.value.slice(start, start + rowsPerPage.value);
});

const nextPage = () => {
  if (currentPage.value * rowsPerPage.value < employees.value.length)
    currentPage.value++;
};

const prevPage = () => {
  if (currentPage.value > 1) currentPage.value--;
};

const showHistory = (id) => {
  selectedEmployeeId.value = id;
  showModal.value = true;
};

const selectedEmployeeHistory = computed(() => {
  const employee = employees.value.find(
    (e) => e.id === selectedEmployeeId.value
  );
  return employee ? employee.workHistory : [];
});
</script>

<style scoped>
.container {
  max-width: 900px;
  margin: auto;
  padding: 20px;
}

.controls {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.search-input {
  padding: 8px;
  width: 200px;
}

.employee-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

.employee-table th,
.employee-table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

.employee-table th {
  background-color: #f2f2f2;
}

.pagination {
  display: flex;
  justify-content: center;
  gap: 10px;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-content {
  background: white;
  padding: 20px;
  border-radius: 5px;
}
</style>
