<template>
  <div>
    <h1>Manajemen Karyawan</h1>

    <!-- Pengelompokan Departemen -->
    <div class="filter-section">
      <label for="department">Pilih Departemen:</label>
      <select id="department" v-model="selectedDepartment">
        <option value="">Semua Departemen</option>
        <option
          v-for="department in allDepartments"
          :key="department"
          :value="department"
        >
          {{ department }}
        </option>
      </select>
      <button class="filter-button" @click="filterByDepartment">Filter</button>
    </div>

    <!-- Data Karyawan -->
    <h2>Data Karyawan</h2>
    <label for="rowsPerPage">Tampilkan:</label>
    <select
      id="rowsPerPage"
      v-model.number="rowsPerPage"
      @change="updateTableRange"
    >
      <option
        v-for="option in rowsPerPageOptions"
        :value="option"
        :key="option"
      >
        {{ option }}
      </option>
    </select>

    <BR></BR>
    <table class="employee-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Nomor Kontak</th>
          <th>Status</th>
          <th>Departemen</th>
          <th>Jabatan</th>
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
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";

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
const employees = ref(employeeData);
const selectedEmployeeId = ref(null);
const rowsPerPage = ref(5);
const rowsPerPageOptions = [5, 10, 15];
const currentPage = ref(1);

const filterByDepartment = () => {
  if (selectedDepartment.value) {
    employees.value = employeeData.filter(
      (e) => e.department === selectedDepartment.value
    );
  } else {
    employees.value = employeeData;
  }
  currentPage.value = 1;
};

const paginatedEmployees = computed(() => {
  const start = (currentPage.value - 1) * rowsPerPage.value;
  const end = start + rowsPerPage.value;
  return employees.value.slice(start, end);
});

const updateTableRange = () => {
  currentPage.value = 1;
};

const selectedEmployeeHistory = computed(() => {
  const employee = employees.value.find(
    (e) => e.id === parseInt(selectedEmployeeId.value, 10)
  );
  return employee ? employee.workHistory : [];
});
</script>

<style scoped>
.filter-section {
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
  flex-direction: column;
  position: relative;
}

.filter-button {
  background-color: #4caf50;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
}

.filter-button:hover {
  background-color: #45a049;
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
</style>
