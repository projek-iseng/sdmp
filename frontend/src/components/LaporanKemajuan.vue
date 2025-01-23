<template>
  <div class="laporan-kemajuan">
    <h3>Laporan Kemajuan Pelatihan</h3>
    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Nama Karyawan</th>
            <th>Program Pelatihan</th>
            <th>Tanggal Pelatihan</th>
            <th>Hasil yang Dicapai</th>
            <th>Dampak pada Kinerja</th>
            <th>Evaluasi Pelatihan</th>
            <th>Saran Perbaikan</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(laporan, index) in laporanList" :key="index">
            <td>{{ laporan.namaKaryawan }}</td>
            <td>{{ laporan.programPelatihan }}</td>
            <td>{{ laporan.tanggalPelatihan }}</td>
            <td>{{ laporan.hasilDicapai }}</td>
            <td>{{ laporan.dampakKinerja }}</td>
            <td>{{ laporan.evaluasiPelatihan }}</td>
            <td>{{ laporan.saranPerbaikan }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const laporanList = ref([
  {
    namaKaryawan: "John Doe",
    programPelatihan: "Pelatihan Kepemimpinan",
    tanggalPelatihan: "2023-12-10",
    hasilDicapai: "Meningkatkan kemampuan memimpin tim.",
    dampakKinerja: "Meningkatkan kinerja tim secara signifikan.",
    evaluasiPelatihan: "Baik",
    saranPerbaikan: "Lebih banyak latihan praktis di lapangan.",
  },
  {
    namaKaryawan: "Jane Smith",
    programPelatihan: "Pelatihan Teknologi",
    tanggalPelatihan: "2023-11-05",
    hasilDicapai: "Memahami teknologi terbaru dalam industri.",
    dampakKinerja: "Meningkatkan kemampuan teknis dalam pekerjaan.",
    evaluasiPelatihan: "Sangat Baik",
    saranPerbaikan: "Menambahkan sesi praktek lebih lanjut.",
  },
  {
    namaKaryawan: "Alice Johnson",
    programPelatihan: "Pelatihan Manajemen Proyek",
    tanggalPelatihan: "2023-09-15",
    hasilDicapai: "Memahami dasar-dasar manajemen proyek.",
    dampakKinerja: "Meningkatkan keterampilan manajerial dan organisasi.",
    evaluasiPelatihan: "Cukup",
    saranPerbaikan: "Menambahkan lebih banyak studi kasus dunia nyata.",
  },
  {
    namaKaryawan: "Bob Brown",
    programPelatihan: "Pelatihan Komunikasi Efektif",
    tanggalPelatihan: "2023-08-20",
    hasilDicapai: "Meningkatkan keterampilan komunikasi interpersonal.",
    dampakKinerja: "Memperbaiki hubungan antar departemen.",
    evaluasiPelatihan: "Sangat Baik",
    saranPerbaikan: "Menggunakan lebih banyak video dan role-playing.",
  },
  {
    namaKaryawan: "Michael Williams",
    programPelatihan: "Pelatihan Analisis Data",
    tanggalPelatihan: "2023-07-10",
    hasilDicapai:
      "Meningkatkan kemampuan analisis data menggunakan perangkat lunak terbaru.",
    dampakKinerja: "Mempercepat proses pengambilan keputusan berdasarkan data.",
    evaluasiPelatihan: "Baik",
    saranPerbaikan: "Mengadakan sesi lanjutan untuk analisis data lanjutan.",
  },
]);
</script>

<style scoped>
.laporan-kemajuan {
  width: 100%;
  padding: 20px;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  max-width: 1100px; /* Menyesuaikan dengan lebar maksimum di file menu */
  margin: 0 auto;
}

h3 {
  font-size: 24px;
  margin-bottom: 20px;
}

.table-wrapper {
  overflow-x: auto;
  width: 100%;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f4f7fc;
  font-weight: bold;
  white-space: nowrap; /* Agar teks di header tidak terpotong */
}

tbody tr:hover {
  background-color: #f9f9f9;
}

/* Responsif pada layar kecil */
@media (max-width: 768px) {
  table {
    width: 100%;
    font-size: 12px;
  }

  th,
  td {
    padding: 8px;
  }

  /* Menambahkan scrollbar horizontal */
  .table-wrapper {
    overflow-x: scroll;
  }
}
</style>
