<script setup >
import apiClient from "../../services/apiService";
import { ref, onMounted } from "vue";
import imgLogo from '../../../public/game.svg';
import { ProductService } from "../../services/ProductService";

const jabatanData = ref([]);
const departemenData = ref([]);
const data = ref([]);
const search = ref([]);
const loading = ref(false)
const submitted = ref(false);
const productDialog = ref(false);
const tglLahir = ref(null);


const dialogCreate  = async ()=> {
    productDialog.value = true
}
const saveUsers = async ()=> {
    productDialog.value = false
}

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
});
</script>

<template>
    <div>
       
        <Splitter class="splitter-custom" layout="horizontal">
            <SplitterPanel class="flex align-items-center justify-content-center no-resize" :size="65" > 
                <div class="formgrid grid">
                    <div class="field grid">
                        <Card class="custom-card " >
                            <template #title>Nama Pegawai</template>
                            <template #content>
                                <div class="flex justify-content-center align-items-center" >
                                    <div class="text-center">
                                        <div>
                                            <div class="imgPegawai">
                                                <p>gambar</p>
                                            </div>
                                        </div>
                                        <div style="text-items:center;">
                                            <div >
                                                <span>id: 12052004</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="formgrid grid">
                                                <div class="field col ">
                                                    <span>Derektur</span>
                                                </div>
                                                <div class="field col ">
                                                    <span>DErektur</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="formgrid grid">
                                                <div class="field col m-1">
                                                    <span>tanggal gabung</span>
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
            <SplitterPanel class=" no-resize" :size="35" style="padding:20px;" >
                <div class="text-center mb-5">
                    <label for="" style="font-size:20px; font-weight: bold; padding:10px">Search User's dan Creact User's</label>
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
                    <Button type="button" label="Search User's" icon="pi pi-search"  class="w-10" :loading="loading" />
                    </div>
                     <div class="field col" >
                        <Button label="Create Users" icon="pi pi-plus" @click="dialogCreate" iconPos="left" class=" w-10" />
                    </div>
                </div>
            </SplitterPanel>
        </Splitter>
        <Dialog
      v-model:visible="productDialog"
      :style="{ width: '1050px' }"
      header="Nama Pegawai"
      :modal="true"
      class="p-fluid"
    >
      <div class="formgrid grid">
        <div class="field col">
          <label for="name">Nama Lengkap</label>
          <InputText
            id="name"
            v-model.trim="data.namaPegawai "
            required="true"
            autofocus
            autocomplete="off"
            :invalid="submitted && !data.namaPegawai"
          />
          <small class="p-error" v-if="submitted && !data.namaPegawai"
            >Nama Lengkap diperlukan.</small
          >
        </div>
        <div class="field col">
          <label for="email">Email</label>
          <InputText
            id="email"
            v-model="data.email"
            required="true"
            autocomplete="off"
            :invalid="submitted && !data.email"
          />
          <small class="p-error" v-if="submitted && !data.email">Email diperlukan.</small>
        </div>
        <div class="field col">
          <label for="noHp">No Handphone</label>
          <InputText
            id="noHp"
            v-model="data.noHp"
            required="true"
            autocomplete="off"
            :invalid="submitted && !data.noHp"
          />
          <small class="p-error" v-if="submitted && !data.noHp"
            >No Handphone diperlukan.</small
          >
        </div>
      </div>
      <div class="field">
        <label for="alamat">Alamat</label>
        <Textarea
          id="alamat"
          v-model.trim="data.alamat"
          rows="5"
          cols="30"
          autocomplete="off"
          :invalid="submitted && !data.alamat"
        />
        <small class="p-error" v-if="submitted && !data.alamat">Alamat diperlukan.</small>
      </div>
      <div class="formgrid grid">
      <div class="field col">
        <label for="jabatan">Jabatan</label>
        <Dropdown
          id="jabatan"
          v-model="data.jabatan"
          :options="jabatanData"
          optionLabel="label"
          optionValue="value"
          placeholder="Pilih Jabatan"
          :invalid="submitted && !data.jabatan"
        />
        <small class="p-error" v-if="submitted && !data.jabatan"
          >Jabatan diperlukan.</small
        >
      </div>
      <div class="field col">
        <label for="jabatan">Departemen</label>
        <Dropdown
          id="jabatan"
          v-model="data.departemen"
          :options="departemenData"
          optionLabel="label"
          optionValue="value"
          placeholder="Pilih Jabatan"
          :invalid="submitted && !data.departemen"
        />
       <small class="p-error" v-if="submitted && !data.departemen"
          >Departemen diperlukan.</small
        >
      </div>
      </div>
      <div class="formgrid grid">
        <div class="field col">
            <label for="username">Username</label>
           <FloatLabel>
                <InputText autocomplete="off" id="username" v-model="data.username" />
            </FloatLabel>
        </div>
        <div class="field col">
            <label for="password">Password</label>
           <FloatLabel>
                <InputText autocomplete="off" id="password" v-model="data.password" />
            </FloatLabel>
        </div>
      </div>
      
      <template #footer>
        <Button label="Cancel" icon="pi pi-times" text @click="hideDialog" />
        <Button label="Create" icon="pi pi-plus" text @click="saveUsers" />
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
.custom-card{
    border: 1px solid white;
}
</style>