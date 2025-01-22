<template>
  <div class="form-container">
    <h2>Form Pelatihan dan Pengembangan Karyawan</h2>

    <form @submit.prevent="submitTrainingForm" class="form">
      <!-- Data Karyawan -->
      <section class="section">
        <h3>Data Karyawan</h3>
        <div class="field">
          <label for="employeeName">Nama Karyawan</label>
          <InputText
            id="employeeName"
            v-model="trainingForm.nama"
            required
            placeholder="Masukkan nama karyawan"
            class="p-inputtext-lg full-width"
          />
        </div>

        <div class="field">
          <label for="employeeId">ID Karyawan</label>
          <InputText
            id="employeeId"
            v-model="trainingForm.id"
            required
            placeholder="Masukkan ID Karyawan"
            class="p-inputtext-lg full-width"
          />
        </div>

        <div class="field">
          <label for="employeePosition">Jabatan</label>
          <InputText
            id="employeePosition"
            v-model="trainingForm.position"
            required
            placeholder="Masukkan jabatan"
            class="p-inputtext-lg full-width"
          />
        </div>
      </section>

      <!-- Detail Pelatihan -->
      <section class="section">
        <h3>Detail Pelatihan</h3>
        <div class="field">
          <label for="trainingDate">Tanggal Pelatihan</label>
          <Calendar
            id="trainingDate"
            v-model="trainingForm.trainingDate"
            dateFormat="dd/mm/yy"
            placeholder="Pilih tanggal pelatihan"
            required
            class="p-inputtext-lg full-width"
          />
        </div>

        <div class="field">
          <label for="trainingType">Jenis Pelatihan</label>
          <Dropdown
            id="trainingType"
            v-model="trainingForm.trainingType"
            :options="trainingTypes"
            placeholder="Pilih jenis pelatihan"
            required
            class="p-inputtext-lg full-width"
          />
        </div>

        <div class="field">
          <label for="trainingDuration">Durasi Pelatihan (Jam)</label>
          <InputNumber
            id="trainingDuration"
            v-model="trainingForm.duration"
            min="1"
            max="100"
            required
            placeholder="Masukkan durasi pelatihan"
            class="p-inputtext-lg full-width"
          />
        </div>

        <div class="field">
          <label for="trainingGoal">Tujuan Pelatihan</label>
          <InputText
            id="trainingGoal"
            v-model="trainingForm.trainingGoal"
            placeholder="Masukkan tujuan pelatihan"
            class="p-inputtext-lg full-width"
          />
        </div>
      </section>

      <!-- Penilaian Pelatihan -->
      <section class="section">
        <h3>Penilaian Pelatihan</h3>
        <div class="penilaian-table">
          <div class="row header">
            <div class="col">Aspek Evaluasi</div>
            <div class="col">A</div>
            <div class="col">B</div>
            <div class="col">C</div>
            <div class="col">D</div>
            <div class="col">E</div>
          </div>
          <div
            class="row"
            v-for="(aspect, index) in evaluationAspects"
            :key="index"
          >
            <div class="col">{{ aspect }}</div>
            <div class="col">
              <RadioButton
                v-model="trainingForm[aspect]"
                :value="'A'"
                class="mr-2"
              />
            </div>
            <div class="col">
              <RadioButton
                v-model="trainingForm[aspect]"
                :value="'B'"
                class="mr-2"
              />
            </div>
            <div class="col">
              <RadioButton
                v-model="trainingForm[aspect]"
                :value="'C'"
                class="mr-2"
              />
            </div>
            <div class="col">
              <RadioButton
                v-model="trainingForm[aspect]"
                :value="'D'"
                class="mr-2"
              />
            </div>
            <div class="col">
              <RadioButton
                v-model="trainingForm[aspect]"
                :value="'E'"
                class="mr-2"
              />
            </div>
          </div>
        </div>
      </section>

      <!-- Feedback Peserta -->
      <section class="section">
        <h3>Feedback Peserta</h3>
        <div class="field">
          <label for="participantFeedback">Komentar dari Peserta</label>
          <Textarea
            id="participantFeedback"
            v-model="trainingForm.participantFeedback"
            rows="4"
            placeholder="Masukkan komentar atau saran"
            class="p-inputtext-lg full-width"
          />
        </div>

        <div class="field">
          <label for="additionalSuggestions">Saran Tambahan</label>
          <Textarea
            id="additionalSuggestions"
            v-model="trainingForm.suggestions"
            rows="4"
            placeholder="Masukkan saran tambahan"
            class="p-inputtext-lg full-width"
          />
        </div>
      </section>

      <!-- Biaya Pelatihan -->
      <section class="section">
        <h3>Biaya Pelatihan</h3>
        <div class="field">
          <label for="trainingCost">Biaya Pelatihan (IDR)</label>
          <InputNumber
            id="trainingCost"
            v-model="trainingForm.trainingCost"
            mode="currency"
            currency="IDR"
            min="0"
            required
            class="p-inputtext-lg full-width"
          />
        </div>
      </section>

      <div class="button-group">
        <Button
          label="Batal"
          icon="pi pi-times"
          class="p-button-text"
          @click="cancelTrainingForm"
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

const trainingForm = ref({
  nama: "",
  id: "",
  position: "",
  trainingDate: null,
  trainingType: null,
  duration: null,
  trainingGoal: "",
  participantFeedback: "",
  suggestions: "",
  trainingCost: null,
  evaluation: {
    trainingEffectiveness: null,
    trainerCompetency: null,
    materialQuality: null,
    practicalApplication: null,
  },
});

const trainingTypes = [
  { label: "Pelatihan Teknis", value: "technical" },
  { label: "Pelatihan Soft Skills", value: "softSkills" },
  { label: "Pelatihan Kepemimpinan", value: "leadership" },
  { label: "Pelatihan Lainnya", value: "other" },
];

const evaluationAspects = [
  "trainingEffectiveness",
  "trainerCompetency",
  "materialQuality",
  "practicalApplication",
];

const submitTrainingForm = () => {
  console.log(trainingForm.value);
  toast.add({
    severity: "success",
    summary: "Berhasil",
    detail: "Form pelatihan berhasil disimpan!",
    life: 3000,
  });
};

const cancelTrainingForm = () => {
  trainingForm.value = {
    nama: "",
    id: "",
    position: "",
    trainingDate: null,
    trainingType: null,
    duration: null,
    trainingGoal: "",
    participantFeedback: "",
    suggestions: "",
    trainingCost: null,
    evaluation: {
      trainingEffectiveness: null,
      trainerCompetency: null,
      materialQuality: null,
      practicalApplication: null,
    },
  };
};
</script>
<style scoped>
.form-container {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  min-height: 100vh;
  padding: 20px;
  background-color: #f4f7fc;
}

.form {
  width: 100%;
  max-width: 900px;
  background-color: white;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: left;
  margin-bottom: 20px;
  font-size: 24px;
  font-weight: bold;
}

h3 {
  font-size: 20px;
  margin-bottom: 15px;
}

.field {
  margin-bottom: 1.5rem;
}

.full-width {
  width: 100%;
}
.section {
  margin-bottom: 2rem;
}

.button-group {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
}

.mr-2 {
  margin-right: 0.5rem;
}

.p-button-text {
  margin-right: 1rem;
}

/* Evaluasi Pelatihan */
.penilaian-table {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 10px;
  margin-bottom: 1.5rem;
}

.row {
  display: contents;
}

.row.header {
  font-weight: bold;
  border-bottom: 2px solid #ddd;
}

.col {
  text-align: center;
  padding: 5px;
}
</style>
