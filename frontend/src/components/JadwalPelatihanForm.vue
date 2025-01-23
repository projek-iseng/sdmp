<template>
  <div class="form-container">
    <h3>Formulir Jadwal Pelatihan</h3>

    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="trainingName">Nama Pelatihan</label>
        <input
          type="text"
          id="trainingName"
          v-model="form.trainingName"
          placeholder="Masukkan nama pelatihan"
          required
        />
      </div>

      <div class="form-group">
        <label for="trainingDate">Tanggal Pelatihan</label>
        <input
          type="date"
          id="trainingDate"
          v-model="form.trainingDate"
          required
        />
      </div>

      <div class="form-group">
        <label for="trainingType">Jenis Pelatihan</label>
        <select id="trainingType" v-model="form.trainingType" required>
          <option value="" disabled>Pilih jenis pelatihan</option>
          <option value="internal">Internal</option>
          <option value="eksternal">Eksternal</option>
        </select>
      </div>

      <div class="form-group">
        <label for="trainingDescription">Deskripsi Pelatihan</label>
        <textarea
          id="trainingDescription"
          v-model="form.trainingDescription"
          placeholder="Masukkan deskripsi pelatihan"
          required
        ></textarea>
      </div>

      <div class="form-actions">
        <button type="submit">Simpan</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue";

// Model data untuk form
const form = ref({
  trainingName: "",
  trainingDate: "",
  trainingType: "",
  trainingDescription: "",
});

const submitForm = () => {
  console.log("Form submitted:", form.value);

  form.value = {
    trainingName: "",
    trainingDate: "",
    trainingType: "",
    trainingDescription: "",
  };
};
</script>

<style scoped>
.form-container {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  margin-top: 20px;
}

h3 {
  font-size: 20px;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input,
select,
textarea {
  width: 100%;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #ccc;
}

input[type="date"] {
  padding-left: 10px;
}

textarea {
  resize: vertical;
  height: 100px;
}

.form-actions {
  text-align: right;
}

button {
  background-color: #4caf50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}
</style>
