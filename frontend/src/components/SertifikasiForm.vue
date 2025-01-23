<template>
  <div>
    <h3>Sertifikasi Form</h3>
    <form>
      <label for="nama">Nama Sertifikasi</label>
      <input type="text" id="nama" v-model="sertifikasi.nama" />

      <label for="tanggal">Tanggal</label>
      <input type="date" id="tanggal" v-model="sertifikasi.tanggal" />

      <button type="submit">Simpan Sertifikasi</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue";

const sertifikasi = ref({
  nama: "",
  tanggal: "",
});
</script>

<style scoped>
form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

label {
  font-weight: bold;
}

input {
  padding: 8px;
  font-size: 14px;
}

button {
  background-color: #4caf50;
  color: white;
  padding: 10px;
  border: none;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}
</style>
