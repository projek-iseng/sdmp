<template>
  <div style="max-width: 600px">
    <h3>Form Pengajuan Cuti</h3>
    <form @submit.prevent="submitForm">
      <div class="field">
        <label for="nama">Nama Karyawan</label>
        <InputText
          id="nama"
          v-model="form.nama"
          required
          placeholder="Masukkan nama karyawan"
          class="p-inputtext-lg"
        />
      </div>

      <div class="field">
        <label for="startDate">Tanggal Mulai</label>
        <Calendar
          id="startDate"
          v-model="form.startDate"
          dateFormat="dd/mm/yy"
          placeholder="Pilih tanggal mulai"
          required
          class="p-inputtext-lg"
        />
      </div>

      <div class="field">
        <label for="endDate">Tanggal Selesai</label>
        <Calendar
          id="endDate"
          v-model="form.endDate"
          dateFormat="dd/mm/yy"
          placeholder="Pilih tanggal selesai"
          required
          class="p-inputtext-lg"
        />
      </div>

      <div class="field">
        <label for="leaveType">Tipe Cuti</label>
        <Dropdown
          id="leaveType"
          v-model="form.leaveType"
          :options="leaveTypes"
          optionLabel="name"
          placeholder="Pilih tipe cuti"
          required
          class="p-inputtext-lg"
        />
      </div>

      <div class="field">
        <label for="reason">Alasan Cuti</label>
        <Textarea
          id="reason"
          v-model="form.reason"
          rows="3"
          placeholder="Masukkan alasan cuti"
          required
          class="p-inputtext-lg"
        />
      </div>

      <div class="mt-4 flex justify-content-end">
        <Button
          label="Batal"
          icon="pi pi-times"
          class="p-button-text"
          @click="cancelForm"
        />
        <Button
          label="Ajukan"
          icon="pi pi-check"
          severity="success"
          type="submit"
        />
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { FilterMatchMode } from "primevue/api";
import { useToast } from "primevue/usetoast";

// Reactive form state
const form = ref({
  nama: "",
  startDate: null,
  endDate: null,
  leaveType: null,
  reason: "",
});

// List of leave types
const leaveTypes = [
  { name: "Cuti Tahunan", code: "annual" },
  { name: "Cuti Sakit", code: "sick" },
  { name: "Cuti Melahirkan", code: "maternity" },
];

// Method to reset form fields
const openNew = () => {
  form.value = {
    nama: "",
    startDate: null,
    endDate: null,
    leaveType: null,
    reason: "",
  };
};

// Method to handle form submission
const submitForm = () => {
  console.log(form.value); // Logic for submitting the form
};

// Method to cancel the form
const cancelForm = () => {
  form.value = {
    nama: "",
    startDate: null,
    endDate: null,
    leaveType: null,
    reason: "",
  };
};
</script>

<style scoped>
/* .card {
  background-color: #ffffff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
} */

.field {
  margin-left: auto;
}
h3 {
  text-align: left;
  margin-bottom: 30px;
}

.mt-4 {
  margin-top: 1.5rem;
}

.p-button-text {
  margin-right: 1rem;
}
</style>
