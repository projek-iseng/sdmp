<script setup>
import apiClient from "../../services/apiService";
import { ref, onMounted } from "vue";
import imgLogo from "../../../public/game.svg";
import * as XLSX from 'xlsx';
import { useToast } from 'primevue/usetoast';
import { ProductService } from "../../services/ProductService";

const jabatanData = ref([]);
const departemenData = ref([]);
const data = ref([]);
const search = ref([]);
const listdataPegawai = ref([]);
const loading = ref(false);
const submitted = ref(false);
const productDialog = ref(false);
const tglLahir = ref(null);
const toast = useToast();

const fetchData = async () => {
  try {
    const params = [];
    if (search.value.namapegawai) params.push(`namaPegawai=${search.value.namapegawai}`);
    if (search.value.idPegawai) params.push(`idPegawai=${search.value.idPegawai}`);
    if (search.value.jabatan) params.push(`jabatan=${search.value.jabatan}`);
    if (search.value.departemen) params.push(`departemen=${search.value.departemen}`);
    const src = params.length > 0 ? params.join('&') : '';
    const response = await apiClient.get(`/api/master-data/registrasiUsers?${src}`);
    listdataPegawai.value = response.data;
  } catch (error) {
    console.error("Error loading data:", error);
  }
};

const handleFileUpload = (event) => {
  const file = event.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = (e) => {
    const data = e.target.result;
    const workbook = XLSX.read(data, { type: "binary" });
    const sheetName = workbook.SheetNames[0];
    const worksheet = workbook.Sheets[sheetName];
    const jsonData = XLSX.utils.sheet_to_json(worksheet);
    dataBatch.value = jsonData.map((row) => {
      const jabatan = jabatanData.value.find((item) => item.label === row['Jabatan']);
      const departemen = departemenData.value.find((item) => item.label === row['Departemen']);
      return {
        namaPegawai: row['Nama Lengkap'] || '',
        emailPegawai: row['Email'] || '',
        usernamePegawai: row['Username'] || '',
        passwordPegawai: row['Password'] || '',
        // departemenPegawai: departemen ? departemen.value : '',  
        // jabatanPegawai: jabatan ? jabatan.value : '', 
        departemenPegawai: row['Departemen'],  
        jabatanPegawai:  row['Jabatan'], 
      };
    });

    toast.add({
      severity: "success",
      summary: "Success",
      detail: "Data berhasil diimpor dari Excel.",
    });
  };
  reader.readAsBinaryString(file);
};
const dataBatch = ref([
  {
    namaPegawai: "",
    emailPegawai: "",
    usernamePegawai: "",
    passwordPegawai: "",
    departemenPegawai: "",
    jabatanPegawai: "",
  },
]);

const addUser = () => {
  dataBatch.value.push({
    namaPegawai: "",
    emailPegawai: "",
    usernamePegawai: "",
    passwordPegawai: "",
    departemenPegawai: "",
    jabatanPegawai: "",
  });
};
const removeUser = (index) => {
  dataBatch.value.splice(index, 1);
};

const dialogCreate = async () => {
  productDialog.value = true;
};
const saveRegistrasiBatch = async () => {
  submitted.value = true;
  const isValid = dataBatch.value.every(
  (user) =>
    user.namaPegawai &&
    user.emailPegawai &&
    user.usernamePegawai &&
    user.departemenPegawai &&
    user.jabatanPegawai &&
    user.passwordPegawai
);
 

  if (!isValid) {
    toast.add({
      severity: "error",
      summary: "Error",
      detail: "Pastikan semua data sudah terisi.",
    });
    return;
  }

  try {
    const response = await apiClient.post("/api/master-data/registrasiUsers", {
      users: dataBatch.value,
    });
    toast.add({
      severity: "success",
      summary: "Success",
      detail: `${dataBatch.value.length} User berhasil diregistrasi.`,
    });
    hideDialog();
  } catch (error) {
    console.error("Gagal Registrasi Batch", error);
    toast.add({
      severity: "error",
      summary: "Error",
      detail: "Gagal melakukan registrasi batch.",
    });
  }
};

const hideDialog = () => {
  productDialog.value = false;
};

const jabatanDanDepartemenDataPegawai = async () => {
  try {
    const responseJabatan = await apiClient.get("/api/jabatan");
    jabatanData.value = responseJabatan.data.data.map((item) => ({
      label: item.namaJabatan,
      value: item.id,
    }));
    const responseDepartemen = await apiClient.get("/api/departemen");
    departemenData.value = responseDepartemen.data.data.map((item) => ({
      label: item.namaDepartemen,
      value: item.id,
    }));
  } catch (error) {
    console.error("Error loading data:", error);
  }
};
onMounted(() => {
  jabatanDanDepartemenDataPegawai();
  fetchData();
});
</script>

<template>
  <div>
    <Splitter class="splitter-custom" layout="horizontal">
      <SplitterPanel
        class="flex align-items-center justify-content-center no-resize"
        :size="65"
      >
        <div v-if="listdataPegawai.length === 0" class="flex justify-content-center align-items-center" style="height: 200px;">
          <p class="text-center">Data tidak ada</p>
        </div>
        <div v-else class="formgrid grid">
          <div class="field grid">
            <Card v-for="pegawai in listdataPegawai" :key="pegawai.id" class="custom-card" style="margin:30px; ">
              <template #title>{{ pegawai.namaPegawai }}</template>
              <template #content>
                <div class="flex justify-content-center align-items-center">
                  <div class="text-center">
                    <div>
                      <div class="imgPegawai">
                        <img v-if="pegawai.foto" :src="pegawai.foto" alt="Foto Pegawai" />
                        <p v-else>Gambar</p>
                      </div>
                    </div>
                    <div style="text-items: center">
                      <div>
                        <span>{{ pegawai.objectusersfk }}</span>
                      </div>
                    </div>
                    <div>
                      <div class="formgrid grid">
                        <div class="field col">
                          <span>{{ pegawai.namaJabatan }}</span>
                        </div>
                        <div class="field col">
                          <span>{{ pegawai.namaDepartemen }}</span>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="formgrid grid">
                        <div class="field col m-1">
                          <p>tanggal Gabung</p>
                          <span>{{ pegawai.tglGabung }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </template>
            </Card>
          </div>
        </div>
      </SplitterPanel>
      <SplitterPanel class="no-resize" :size="35" style="padding: 20px">
        <div class="text-center mb-5">
          <label for="" style="font-size: 20px; font-weight: bold; padding: 10px"
            >Search User's dan Creact User's</label
          >
        </div>
        <div class="formgrid grid">
          <div class="field col">
            <IconField iconPosition="left">
              <InputIcon class="pi pi-search"> </InputIcon>
              <InputText v-model="search.namapegawai" placeholder="Nama Pegawai" />
            </IconField>
          </div>
          <div class="field col">
            <IconField iconPosition="left">
              <InputIcon class="pi pi-search"> </InputIcon>
              <InputText v-model="search.idPegawai" placeholder="Id Pegawai" />
            </IconField>
          </div>
        </div>
        <div class="formgrid grid">
          <div class="field col">
            <IconField iconPosition="left">
              <InputIcon class="pi pi-search"> </InputIcon>
              <InputText v-model="search.jabatan" placeholder="Jabatan" />
            </IconField>
          </div>
          <div class="field col">
            <IconField iconPosition="left">
              <InputIcon class="pi pi-search"> </InputIcon>
              <InputText v-model="search.departemen" placeholder="Departemen" />
            </IconField>
          </div>
        </div>
        <div class="fromgrid grid">
          <div class="field col">
            <Button
              type="button"
              label="Search User's"
              icon="pi pi-search"
              class="w-10"
              @click="fetchData"
              :loading="loading"
            />
          </div>
          <div class="field col">
            <Button
              label="Create Users"
              icon="pi pi-plus"
              @click="dialogCreate"
              iconPos="left"
              class="w-10"
            />
          </div>
        </div>
      </SplitterPanel>
    </Splitter>
    <Dialog
      v-model:visible="productDialog"
      :style="{ width: '1050px' }"
      header="Registrasi Banyak Pegawai"
      :modal="true"
      class="p-fluid"
    >
    <div class="flex align-items-end justify-content-end rounded" >
      <input type="file" @change="handleFileUpload" accept=".xlsx, .xls, .csv" />
    </div>
      <div v-for="(user, index) in dataBatch" :key="index">
        <div class="flex align-items-center justify-content-between">
          <div>
            <h3>User {{ index + 1 }}</h3>
          </div>
          <div class="flex align-items-center justify-content-between">
            <div>
             
            </div>
            <div >
            <Button
              label="Cencel"
              icon="pi pi-trash"
              class="p-button-danger"
              text
              @click="removeUser(index)"
            />
            </div>
          </div>
        </div>
        <div class="formgrid grid mb-3">
          <div class="field col">
            <label :for="'name' + index">Nama Lengkap</label>
            <InputText
              :id="'name' + index"
              v-model.trim="user.namaPegawai"
              required="true"
              autocomplete="off"
              :invalid="submitted && !user.namaPegawai"
            />
            <small class="p-error" v-if="submitted && !user.namaPegawai">
              Nama Lengkap diperlukan.
            </small>
          </div>
          <div class="field col">
            <label :for="'email' + index">Email</label>
            <InputText
              :id="'email' + index"
              v-model="user.emailPegawai"
              type="email"
              required="true"
              autocomplete="off"
              :invalid="submitted && !user.emailPegawai"
            />
            <small class="p-error" v-if="submitted && !user.emailPegawai"
              >Email diperlukan.</small
            >
          </div>
          <div class="field col">
            <label :for="'username' + index">Username</label>
            <InputText
              :id="'username' + index"
              v-model="user.usernamePegawai"
              required="true"
              autocomplete="off"
              :invalid="submitted && !user.usernamePegawai"
            />
            <small class="p-error" v-if="submitted && !user.usernamePegawai">
              Username diperlukan.
            </small>
          </div>
          <div class="field col">
            <label :for="'password' + index">Password</label>
            <InputText
              :id="'password' + index"
              v-model="user.passwordPegawai"
              type="password"
              required="true"
              autocomplete="off"
              :invalid="submitted && !user.passwordPegawai"
            />
            <small class="p-error" v-if="submitted && !user.passwordPegawai">
              Password diperlukan.
            </small>
          </div>
          <!-- <div class="field col">
      <label for="">Batal</label>
      <Button
        label="Cencel"
        icon="pi pi-trash"
        class="p-button-danger"
        text
        @click="removeUser(index)"
      />
      </div> -->
        </div>
        <div class="formgrid grid">
          <div class="field col">
            <label for="jabatan">Jabatan</label>
            <Dropdown
              id="jabatan"
              v-model="user.jabatanPegawai"
              :options="jabatanData"
              optionLabel="label"
              optionValue="value"
              placeholder="Pilih Jabatan"
              :invalid="submitted && !user.jabatanPegawai"
            />
            <small class="p-error" v-if="submitted && !user.jabatanPegawai"
              >Jabatan diperlukan.</small
            >
          </div>
          <div class="field col">
            <label for="jabatan">Departemen</label>
            <Dropdown
              id="jabatan"
              v-model="user.departemenPegawai"
              :options="departemenData"
              optionLabel="label"
              optionValue="value"
              placeholder="Pilih Jabatan"
              :invalid="submitted && !user.departemenPegawai"
            />
            <small class="p-error" v-if="submitted && !user.departemenPegawai"
              >Departemen diperlukan.</small
            >
          </div>
        </div>
        <hr />
      </div>

      <template #footer>
        <Button label="Tambah User" icon="pi pi-plus" text @click="addUser" />
        <Button label="Cancel" icon="pi pi-times" text @click="hideDialog" />
        <Button label="Create" icon="pi pi-check" text @click="saveRegistrasiBatch" />
      </template>
    </Dialog>
  </div>
</template>

<style>
.splitter-custom {
  border: none;
}
.splitter-custom .p-splitter-gutter {
  pointer-events: none;
  user-select: none;
}
.custom-card {
  border: 1px solid white;
}
</style>
