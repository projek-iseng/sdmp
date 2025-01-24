<template>
  <div>
    <h1>Manajemen Karyawan</h1>

    <!-- Pengelompokan Departemen dengan AutoComplete -->
    <div class="filter-section">
      <label for="department">Pilih Departemen:</label>
      <AutoComplete
        v-model="selectedDepartment"
        dropdown
        :suggestions="departmentSuggestions"
        @complete="searchDepartments"
      />
      <Button label="Filter" icon="pi pi-filter" @click="filterByDepartment" />
    </div>

    <!-- Data Karyawan -->
    <h2>Data Karyawan</h2>
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
        <tr v-for="employee in employees" :key="employee.id">
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

    <!-- Riwayat Kerja -->
    <h2>Riwayat Kerja</h2>
    <div>
      <label for="employeeId">Pilih Karyawan:</label>
      <select v-model="selectedEmployeeId" id="employeeId">
        <option
          v-for="employee in employees"
          :value="employee.id"
          :key="employee.id"
        >
          {{ employee.name }}
        </option>
      </select>
      <div v-if="selectedEmployeeHistory.length">
        <h3>Riwayat untuk Karyawan ID: {{ selectedEmployeeId }}</h3>
        <ul>
          <li v-for="(history, index) in selectedEmployeeHistory" :key="index">
            {{ history.date }} - {{ history.event }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
// import AutoComplete from "primevue/autocomplete";
// import Button from "primevue/button";

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

const selectedDepartment = ref("");
const employees = ref(employeeData);
const selectedEmployeeId = ref(null);
const departmentSuggestions = ref([]);

const searchDepartments = (event) => {
  const allDepartments = ["HR", "IT", "Finance"];
  departmentSuggestions.value = event.query
    ? allDepartments.filter((d) =>
        d.toLowerCase().includes(event.query.toLowerCase())
      )
    : allDepartments;
};

const filterByDepartment = () => {
  if (selectedDepartment.value) {
    employees.value = employeeData.filter(
      (e) => e.department === selectedDepartment.value
    );
  } else {
    employees.value = employeeData;
  }
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
