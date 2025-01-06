<template>
  <h1>Calendar Pegawai</h1>
  <div id="app">
    <div class="grid-container">
      <!-- Calendar Container -->
      <div class="calendar-container">
        <div class="calendar-header">
          <button @click="prevMonth">&lt;</button>
          <h2>{{ currentMonthName }} {{ currentYear }}</h2>
          <button @click="nextMonth">&gt;</button>
        </div>
        <table class="calendar">
          <thead>
            <tr>
              <th v-for="day in daysOfWeek" :key="day">{{ day }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(week, index) in weeks" :key="index">
              <td
                v-for="day in week"
                :key="day.date"
                :class="{
                  'other-month': day.isOtherMonth,
                  selected: day.isSelected,
                  hovered: day.isHovered,
                  'current-day': day.isCurrentDay,
                }"
                @mouseover="day.isHovered = true"
                @mouseleave="day.isHovered = false"
                @click="selectDay(day)"
              >
                {{ day.date }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Divider -->
      <div class="divider"></div>

      <!-- Rekap Jumlah Pegawai Table -->
      <div class="table-container">
        <h2>Rekap Jumlah Pegawai</h2>
        <DataTable
          reff="dt"
          :value="rekapJumlahPegawai"
          paginator
          :rows="3"
          :rowsPerPageOptions="[3, 6, 9, 10]"
          tableStyle="min-width: 50rem"
        >
          <Column field="no" header="No" style="width: 15%"></Column>
          <Column
            field="departemen"
            header="Departemen"
            style="width: 50%"
          ></Column>
          <Column
            field="jumlah"
            header="Jumlah Pegawai"
            style="width: 35%"
          ></Column>
        </DataTable>
      </div>
    </div>

    <!-- List Data Pegawai Table -->
    <div class="card">
      <h2>Data Izin Pegawai</h2>
      <Button
        label="Export CSV"
        icon="pi pi-download"
        severity="success"
        @click="exportCSV"
      />
      <DataTable
        reff="dt"
        :value="customers"
        paginator
        :rows="3"
        :rowsPerPageOptions="[3, 6, 9, 10]"
        tableStyle="min-width: 50rem"
      >
        <Column
          field="idPegawai"
          header="ID Pegawai"
          style="width: 10%"
        ></Column>
        <Column
          field="namePegawai"
          header="Nama Pegawai"
          style="width: 10%"
        ></Column>
        <Column field="jabatan" header="Jabatan" style="width: 10%"></Column>
        <Column
          field="departemen"
          header="Departemen"
          style="width: 10%"
        ></Column>
        <Column
          field="tglPengajuan"
          header="Tgl Pengajuan"
          style="width: 10%"
        ></Column>
        <Column
          field="keterangan"
          header="Keterangan"
          style="width: 10%"
        ></Column>
        <Column field="detail" header="Detail" style="width: 10%"></Column>
        <Column header="Dokumentasi" style="width: 10%">
          <template #body="rowData">
            <div style="display: flex; align-items: center">
              <i
                class="pi pi-file"
                style="cursor: pointer; margin-right: 5px"
                @click="showDocument(rowData)"
              ></i>
              <span>{{ rowData.documentName }}</span>
            </div>
          </template>
        </Column>
        <Column header="Status" style="width: 10%">
          <template #body="slotProps">
            <span
              :class="[
                'status-tag',
                { success: slotProps.data.status === 'ACC' },
                { warning: slotProps.data.status === 'Pending' },
                { danger: slotProps.data.status === 'Rejected' },
              ]"
            >
              {{ slotProps.data.status || "Pending" }}
            </span>
          </template>
        </Column>
      </DataTable>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

// Kalender data
const dt = ref();
const currentDate = new Date();
const currentMonth = ref(currentDate.getMonth());
const currentYear = ref(currentDate.getFullYear());
const weeks = ref([]);
const daysOfWeek = [
  "Minggu",
  "Senin",
  "Selasa",
  "Rabu",
  "Kamis",
  "Jumat",
  "Sabtu",
];
const currentMonthName = ref(
  currentDate.toLocaleString("default", { month: "long" })
);

const prevMonth = () => {
  if (currentMonth.value === 0) {
    currentMonth.value = 11;
    currentYear.value -= 1;
  } else {
    currentMonth.value -= 1;
  }
  updateCalendar();
};

const nextMonth = () => {
  if (currentMonth.value === 11) {
    currentMonth.value = 0;
    currentYear.value += 1;
  } else {
    currentMonth.value += 1;
  }
  updateCalendar();
};

const updateCalendar = () => {
  const daysInMonth = new Date(
    currentYear.value,
    currentMonth.value + 1,
    0
  ).getDate();
  const firstDayOfMonth = new Date(
    currentYear.value,
    currentMonth.value,
    1
  ).getDay();
  const currentDay = new Date().getDate();

  weeks.value = [];
  let week = [];
  for (let i = 0; i < firstDayOfMonth; i++) {
    week.push({ date: null, isOtherMonth: true });
  }

  for (let day = 1; day <= daysInMonth; day++) {
    let isCurrentDay =
      currentYear.value === currentDate.getFullYear() &&
      currentMonth.value === currentDate.getMonth() &&
      day === currentDay;
    week.push({
      date: day,
      isOtherMonth: false,
      isSelected: false,
      isHovered: false,
      isCurrentDay,
    });
    if (week.length === 7) {
      weeks.value.push(week);
      week = [];
    }
  }

  if (week.length) weeks.value.push(week);

  currentMonthName.value = new Date(
    currentYear.value,
    currentMonth.value
  ).toLocaleString("default", { month: "long" });
};

const selectDay = (day) => {
  if (!day.isOtherMonth) {
    day.isSelected = !day.isSelected;
  }
};

// Data Pegawai
const rekapJumlahPegawai = ref([
  { no: 1, departemen: "HRD", jumlah: 5 },
  { no: 2, departemen: "IT", jumlah: 8 },
  { no: 3, departemen: "Finance", jumlah: 3 },
  { no: 4, departemen: "Marketing", jumlah: 4 },
  { no: 5, departemen: "Sales", jumlah: 7 },
]);

const customers = ref([
  {
    idPegawai: "001",
    namePegawai: "Piyo Aswandi",
    jabatan: "Manager",
    departemen: "HRD",
    tglPengajuan: "2024-11-01",
    keterangan: "Cuti",
    detail: "Cuti 2 hari",
    status: "ACC",
  },
  {
    idPegawai: "002",
    namePegawai: "Azhar As Rahmatulloh",
    jabatan: "Staff",
    departemen: "IT",
    tglPengajuan: "2024-11-02",
    keterangan: "Izin Sakit",
    detail: "Sakit flu",
    status: "Pending",
  },
  {
    idPegawai: "003",
    namePegawai: "Testing",
    jabatan: "Staff",
    departemen: "IT",
    tglPengajuan: "2024-11-02",
    keterangan: "Izin Sakit",
    detail: "Sakit flu",
    status: "Rejected",
  },
  {
    idPegawai: "003",
    namePegawai: "Testing",
    jabatan: "Staff",
    departemen: "IT",
    tglPengajuan: "2024-11-02",
    keterangan: "Izin Sakit",
    detail: "Sakit flu",
    status: "ACC",
  },
  {
    idPegawai: "003",
    namePegawai: "Testing",
    jabatan: "Staff",
    departemen: "IT",
    tglPengajuan: "2024-11-02",
    keterangan: "Izin Sakit",
    detail: "Sakit flu",
    status: "ACC",
  },
  {
    idPegawai: "003",
    namePegawai: "Testing",
    jabatan: "Staff",
    departemen: "IT",
    tglPengajuan: "2024-11-02",
    keterangan: "Izin Sakit",
    detail: "Sakit flu",
    status: "Pending",
  },
  {
    idPegawai: "003",
    namePegawai: "Testing",
    jabatan: "Staff",
    departemen: "IT",
    tglPengajuan: "2024-11-02",
    keterangan: "Izin Sakit",
    detail: "Sakit flu",
    status: "Rejected",
  },
]);

// Fungsi untuk mengekspor data ke CSV
const exportCSV = () => {
  const csvRows = [];
  const headers = [
    "ID Pegawai",
    "Nama Pegawai",
    "Jabatan",
    "Departemen",
    "Tgl Pengajuan",
    "Keterangan",
    "Detail",
    "Status",
  ];
  csvRows.push(headers.join(","));

  customers.value.forEach((customer) => {
    const row = [
      customer.idPegawai,
      customer.namePegawai,
      customer.jabatan,
      customer.departemen,
      customer.tglPengajuan,
      customer.keterangan,
      customer.detail,
      customer.status,
    ];
    csvRows.push(row.join(","));
  });

  const csvString = csvRows.join("\n");

  // Create a downloadable link
  const blob = new Blob([csvString], { type: "text/csv;charset=utf-8;" });
  const link = document.createElement("a");
  const url = URL.createObjectURL(blob);
  link.setAttribute("href", url);
  link.setAttribute("download", "data_izin_pegawai.csv");
  link.click();
};

onMounted(() => {
  updateCalendar();
});
</script>

<style>
.status-tag {
  display: inline-block;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 12px;
  font-weight: bold;
  text-align: center;
  color: white;
}

.status-tag.success {
  background-color: #4caf50;
}

.status-tag.warning {
  background-color: #ff9800;
}

.status-tag.danger {
  background-color: #f44336;
}
.grid-container {
  display: grid;
  grid-template-columns: 1fr 1px 1fr;
  border: none;
}

.grid-container div:nth-child(2) {
  background-color: #222;
}

.calendar-container {
  padding: 20px;
}

.table-container {
  padding: 20px;
}

.divider {
  width: 1px;
  background-color: #87cefa;
  height: 100%;
}

.calendar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: #4682b4;
  color: #ffffff;
  font-size: 18px;
  border-radius: 6px;
}

.calendar-header button {
  background: none;
  border: none;
  background-color: #4682b4;
  color: #ffffff;
  font-size: 20px;
  cursor: pointer;
  padding: 5px;
  border-radius: 6px;
}

.calendar-header button:hover {
  background-color: #4169e1;
}

.calendar-header h2 {
  margin: 0;
}

.calendar {
  width: 100%;
  border-collapse: collapse;
}

.calendar th,
.calendar td {
  text-align: center;
  padding: 15px;
  border: 1px solid #b0c4de;
  font-size: 14px;
  border-radius: 6px;
  color: #000080;
}

.calendar th {
  background-color: #87ceeb;
  font-weight: bold;
  color: #000080;
}

.calendar td {
  background-color: #ffffff;
  transition: background-color 0.3s, transform 0.3s;
  cursor: pointer;
}

.calendar td:hover {
  background-color: #add8e6;
  transform: scale(1.1);
}

.calendar td.other-month {
  color: #a9a9a9;
}

.calendar td.hovered {
  background-color: #b0e0e6;
}

.calendar td.current-day {
  color: #ffffff;
  background-color: #4169e1;
  border-radius: 6px;
  font-weight: bold;
}

@media (max-width: 768px) {
  .grid-container {
    grid-template-columns: 1fr;
  }

  .calendar-header h2 {
    font-size: 16px;
  }

  .calendar th,
  .calendar td {
    padding: 10px;
    font-size: 12px;
  }
}
</style>
