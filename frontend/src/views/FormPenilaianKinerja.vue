<template>
  <div style="max-width: 800px; margin: 0; text-align: left">
    <h2>Form Penilaian Kerja Karyawan</h2>

    <form @submit.prevent="submitEvaluationForm">
      <div class="field">
        <label for="employeeName">Nama Karyawan</label>
        <InputText
          id="employeeName"
          v-model="evaluationForm.nama"
          required
          placeholder="Masukkan nama karyawan"
          class="p-inputtext-lg full-width"
        />
      </div>

      <div class="field">
        <label for="evaluationDate">Tanggal Penilaian</label>
        <Calendar
          id="evaluationDate"
          v-model="evaluationForm.date"
          dateFormat="dd/mm/yy"
          placeholder="Pilih tanggal penilaian"
          required
          class="p-inputtext-lg full-width"
        />
      </div>

      <!-- Penilaian Kerja -->
      <h3>Penilaian Kerja</h3>
      <div class="penilaian-table">
        <div class="row">
          <div class="col">
            <label>Aspek Penilaian</label>
          </div>
          <div class="col">
            <label>A</label>
          </div>
          <div class="col">
            <label>B</label>
          </div>
          <div class="col">
            <label>C</label>
          </div>
          <div class="col">
            <label>D</label>
          </div>
          <div class="col">
            <label>E</label>
          </div>
        </div>

        <div class="row" v-for="(aspect, index) in aspects" :key="index">
          <div class="col">
            <label>{{ aspect }}</label>
          </div>
          <div class="col">
            <RadioButton
              v-model="evaluationForm[aspect]"
              :value="'A'"
              class="mr-2"
            />
          </div>
          <div class="col">
            <RadioButton
              v-model="evaluationForm[aspect]"
              :value="'B'"
              class="mr-2"
            />
          </div>
          <div class="col">
            <RadioButton
              v-model="evaluationForm[aspect]"
              :value="'C'"
              class="mr-2"
            />
          </div>
          <div class="col">
            <RadioButton
              v-model="evaluationForm[aspect]"
              :value="'D'"
              class="mr-2"
            />
          </div>
          <div class="col">
            <RadioButton
              v-model="evaluationForm[aspect]"
              :value="'E'"
              class="mr-2"
            />
          </div>
        </div>
      </div>
      <!-- Komentar -->
      <div class="field">
        <label for="additionalComments">Komentar Tambahan</label>
        <Textarea
          id="additionalComments"
          v-model="evaluationForm.comments"
          rows="4"
          placeholder="Tambahkan komentar tambahan"
          class="p-inputtext-lg full-width"
        />
      </div>

      <div class="mt-4 flex justify-content-end">
        <Button
          label="Batal"
          icon="pi pi-times"
          class="p-button-text"
          @click="cancelEvaluationForm"
        />
        <Button
          label="Submit"
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
import { useToast } from "primevue/usetoast";

const toast = useToast();

const evaluationForm = ref({
  nama: "",
  date: null,
  comments: "",
  attendance: [
    { date: "01/01/2025", status: "Hadir" },
    { date: "02/01/2025", status: "Izin" },
    // Tambahkan data absensi sesuai kebutuhan
  ],
  tasks: [
    "Mengerjakan laporan bulanan",
    "Mengikuti rapat tim",
    // Tambahkan task sesuai kebutuhan
  ],
  jobKnowledge: null,
  workQuality: null,
  communication: null,
  teamwork: null,
  dependability: null,
});

const aspects = [
  "Pengetahuan Keja",
  "Kualitas Kerja",
  "Komunikasi",
  "Kerjasama",
  "Individual",
];

const submitEvaluationForm = () => {
  console.log(evaluationForm.value);
  toast.add({
    severity: "success",
    summary: "Berhasil",
    detail: "Penilaian kerja berhasil disimpan!",
    life: 3000,
  });
};

const cancelEvaluationForm = () => {
  evaluationForm.value = {
    nama: "",
    date: null,
    comments: "",
    attendance: [],
    tasks: [],
    jobKnowledge: null,
    workQuality: null,
    communication: null,
    teamwork: null,
    dependability: null,
  };
};
</script>

<style scoped>
.field {
  margin-bottom: 1.5rem;
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

.mr-2 {
  margin-right: 0.5rem;
}

.penilaian-table {
  margin-bottom: 1.5rem;
}

.row {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}

.col {
  flex: 1;
  text-align: center;
}

.col label {
  display: block;
}

.radio-button {
  display: inline-block;
  margin-right: 10px;
}
</style>
