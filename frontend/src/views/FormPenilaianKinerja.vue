<template>
  <div style="max-width: 800px; margin: 0; text-align: left">
    <h2>Form Penilaian Kinerja Karyawan</h2>

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
        <label for="employeeId">ID Karyawan</label>
        <InputText
          id="employeeId"
          v-model="evaluationForm.id"
          required
          placeholder="Masukkan ID karyawan"
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

      <h3>Penilaian Kinerja</h3>

      <div class="field">
        <label for="kpi">KPI (Key Performance Indicators)</label>
        <div class="table">
          <div class="row">
            <div class="col">Target</div>
            <div class="col">Pencapaian</div>
            <div class="col">Nilai</div>
          </div>
          <div
            class="row"
            v-for="(kpi, index) in evaluationForm.kpi"
            :key="index"
          >
            <div class="col">
              <InputText v-model="kpi.target" placeholder="Masukkan target" />
            </div>
            <div class="col">
              <InputText
                v-model="kpi.achievement"
                placeholder="Masukkan pencapaian"
              />
            </div>
            <div class="col">
              <InputText v-model="kpi.score" placeholder="Nilai" />
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label for="feedback360">360-Degree Feedback</label>
        <div class="table">
          <div class="row">
            <div class="col">Aspek</div>
            <div class="col">Rekan Kerja</div>
            <div class="col">Supervisor</div>
            <div class="col">Bawahan</div>
          </div>
          <div
            class="row"
            v-for="(aspect, index) in evaluationForm.feedback360"
            :key="index"
          >
            <div class="col">
              <label>{{ aspect.name }}</label>
            </div>
            <div class="col">
              <RadioButton v-model="aspect.peer" :value="'A'" /> A
              <RadioButton v-model="aspect.peer" :value="'B'" /> B
              <RadioButton v-model="aspect.peer" :value="'C'" /> C
              <RadioButton v-model="aspect.peer" :value="'D'" /> D
              <RadioButton v-model="aspect.peer" :value="'E'" /> E
            </div>
            <div class="col">
              <RadioButton v-model="aspect.supervisor" :value="'A'" /> A
              <RadioButton v-model="aspect.supervisor" :value="'B'" /> B
              <RadioButton v-model="aspect.supervisor" :value="'C'" /> C
              <RadioButton v-model="aspect.supervisor" :value="'D'" /> D
              <RadioButton v-model="aspect.supervisor" :value="'E'" /> E
            </div>
            <div class="col">
              <RadioButton v-model="aspect.subordinate" :value="'A'" /> A
              <RadioButton v-model="aspect.subordinate" :value="'B'" /> B
              <RadioButton v-model="aspect.subordinate" :value="'C'" /> C
              <RadioButton v-model="aspect.subordinate" :value="'D'" /> D
              <RadioButton v-model="aspect.subordinate" :value="'E'" /> E
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label for="taskCompletion">Penyelesaian Tugas</label>
        <div class="table">
          <div class="row">
            <div class="col">Tugas</div>
            <div class="col">Status</div>
          </div>
          <div
            class="row"
            v-for="(task, index) in evaluationForm.tasks"
            :key="index"
          >
            <div class="col">
              <InputText v-model="task.name" placeholder="Nama tugas" />
            </div>
            <div class="col">
              <Dropdown
                v-model="task.status"
                :options="statusOptions"
                placeholder="Pilih status"
              />
            </div>
          </div>
        </div>
      </div>

      <h3>Penilaian Aspek Kinerja</h3>
      <div class="field">
        <label for="communication">Komunikasi</label>
        <div class="table">
          <div class="row">
            <div class="col">Skor</div>
          </div>
          <br />
          <div class="row">
            <RadioButton v-model="evaluationForm.communication" :value="'A'" />
            A
            <RadioButton v-model="evaluationForm.communication" :value="'B'" />
            B
            <RadioButton v-model="evaluationForm.communication" :value="'C'" />
            C
            <RadioButton v-model="evaluationForm.communication" :value="'D'" />
            D
            <RadioButton v-model="evaluationForm.communication" :value="'E'" />
            E
          </div>
        </div>
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
  id: "",
  date: null,
  kpi: [{ target: "", achievement: "", score: "" }],
  feedback360: [
    { name: "Komunikasi", peer: null, supervisor: null, subordinate: null },
    { name: "Kerjasama", peer: null, supervisor: null, subordinate: null },
  ],
  tasks: [{ name: "", status: "" }],
  communication: null,
});

const statusOptions = [
  { label: "Selesai", value: "Selesai" },
  { label: "Dalam Proses", value: "Dalam Proses" },
  { label: "Belum Dimulai", value: "Belum Dimulai" },
];

const submitEvaluationForm = () => {
  console.log(evaluationForm.value);
  toast.add({
    severity: "success",
    summary: "Berhasil",
    detail: "Penilaian kinerja berhasil disimpan!",
    life: 3000,
  });
};

const cancelEvaluationForm = () => {
  evaluationForm.value = {
    nama: "",
    id: "",
    date: null,
    kpi: [{ target: "", achievement: "", score: "" }],
    feedback360: [
      { name: "Komunikasi", peer: null, supervisor: null, subordinate: null },
      { name: "Kerjasama", peer: null, supervisor: null, subordinate: null },
    ],
    tasks: [{ name: "", status: "" }],
    communication: null,
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

.table {
  display: table;
  width: 100%;
  border-collapse: collapse;
}

.row {
  display: table-row;
}

.col {
  display: table-cell;
  padding: 0.5rem;
  border: 1px solid #ddd;
}
</style>
