<template>
  <div style="max-width: 800px; margin: 0 auto">
    <h2>Form Pengajuan Cuti</h2>

    <Tabs>
      <!-- Tab 1: Pengajuan Cuti -->
      <TabPanel header="Pengajuan Cuti">
        <form @submit.prevent="submitLeaveForm">
          <div class="field">
            <label for="leaveName">Nama Karyawan</label>
            <InputText
              id="leaveName"
              v-model="leaveForm.nama"
              required
              placeholder="Masukkan nama karyawan"
              class="p-inputtext-lg full-width"
            />
          </div>

          <div class="field">
            <label for="leaveStartDate">Tanggal Mulai</label>
            <Calendar
              id="leaveStartDate"
              v-model="leaveForm.startDate"
              dateFormat="dd/mm/yy"
              placeholder="Pilih tanggal mulai"
              required
              class="p-inputtext-lg full-width"
            />
          </div>

          <div class="field">
            <label for="leaveEndDate">Tanggal Selesai</label>
            <Calendar
              id="leaveEndDate"
              v-model="leaveForm.endDate"
              dateFormat="dd/mm/yy"
              placeholder="Pilih tanggal selesai"
              required
              class="p-inputtext-lg full-width"
            />
          </div>

          <div class="field">
            <label for="leaveType">Tipe Cuti</label>
            <Dropdown
              id="leaveType"
              v-model="leaveForm.leaveType"
              :options="leaveTypes"
              optionLabel="name"
              placeholder="Pilih tipe cuti"
              required
              class="p-inputtext-lg full-width"
            />
          </div>

          <div class="field">
            <label for="leaveReason">Alasan Cuti</label>
            <Textarea
              id="leaveReason"
              v-model="leaveForm.reason"
              rows="3"
              placeholder="Masukkan alasan cuti"
              required
              class="p-inputtext-lg full-width"
            />
          </div>

          <div class="mt-4 flex justify-content-end">
            <Button
              label="Batal"
              icon="pi pi-times"
              class="p-button-text"
              @click="cancelLeaveForm"
            />
            <Button
              label="Ajukan"
              icon="pi pi-check"
              severity="success"
              type="submit"
            />
          </div>
        </form>
      </TabPanel>
    </Tabs>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useToast } from "primevue/usetoast";

const toast = useToast();

// Form states
const leaveForm = ref({
  nama: "",
  startDate: null,
  endDate: null,
  leaveType: null,
  reason: "",
});

const officeExitForm = ref({
  nama: "",
  date: null,
  time: "",
  reason: "",
});

const overtimeForm = ref({
  nama: "",
  date: null,
  duration: null,
  reason: "",
});

// Leave types
const leaveTypes = [
  { name: "Cuti Tahunan", code: "annual" },
  { name: "Cuti Sakit", code: "sick" },
  { name: "Cuti Melahirkan", code: "maternity" },
];

// Form handlers
const submitLeaveForm = () => {
  console.log(leaveForm.value);
  toast.add({
    severity: "success",
    summary: "Berhasil",
    detail: "Pengajuan cuti berhasil!",
    life: 3000,
  });
};

const cancelLeaveForm = () =>
  (leaveForm.value = {
    nama: "",
    startDate: null,
    endDate: null,
    leaveType: null,
    reason: "",
  });

const submitOfficeExitForm = () => {
  console.log(officeExitForm.value);
  toast.add({
    severity: "success",
    summary: "Berhasil",
    detail: "Izin keluar kantor berhasil!",
    life: 3000,
  });
};

const cancelOfficeExitForm = () =>
  (officeExitForm.value = {
    nama: "",
    date: null,
    time: "",
    reason: "",
  });

const submitOvertimeForm = () => {
  console.log(overtimeForm.value);
  toast.add({
    severity: "success",
    summary: "Berhasil",
    detail: "Pengajuan lembur berhasil!",
    life: 3000,
  });
};

const cancelOvertimeForm = () =>
  (overtimeForm.value = {
    nama: "",
    date: null,
    duration: null,
    reason: "",
  });
</script>

<style scoped>
.field {
  margin-bottom: 1rem;
}

.full-width {
  width: 100%;
}

.mt-4 {
  margin-top: 1.5rem;
}

.p-button-text {
  margin-right: 1rem;
}
</style>
