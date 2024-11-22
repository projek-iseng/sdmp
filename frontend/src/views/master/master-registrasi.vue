<script setup >
import apiClient from "../../services/apiService";
import { ref, onMounted } from "vue";
import imgLogo from '../../../public/game.svg';

const productDialog = ref(false);

const dialogCreate  = async ()=> {
    productDialog.value = true
}

const hideDialog = () => {
  productDialog.value = false;
};

</script>

<template>
    <div>
        <div class="flex align-items-end justify-content-end" style="padding:10px">
            <Button label="Create" icon="pi pi-plus" @click="dialogCreate" iconPos="right" class="buttonCreatePegawai" />
        </div>
        <Splitter class="splitter-custom" layout="horizontal">
            <SplitterPanel class="flex align-items-center justify-content-center no-resize" :size="65" > 
                <div class="formgrid grid">
                    <div class="field grid">
                        <Card>
                            <template #title>Nama Pegawai</template>
                            <template #content>
                                <div class="flex justify-content-center align-items-center">
                                    <div class="text-center">
                                        <div>
                                            <div class="imgPegawai">
                                                <p>gambar</p>
                                            </div>
                                        </div>
                                        <div style="text-items:center;">
                                            <div >
                                                <span>12052004</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="formgrid grid">
                                                <div class="field grid m-1">
                                                    <span>Derektur</span>
                                                </div>
                                                <div class="field grid m-1">
                                                    <span>DErektur</span>
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
            <SplitterPanel class="flex align-items-center justify-content-center no-resize" :size="35" style="padding:10px;" >
                <div class="formgrid grid">
                    <div class="field col">
                        <IconField iconPosition="left">
                            <InputIcon class="pi pi-search"> </InputIcon>
                            <InputText v-model="value1" placeholder="Nama Pegawai" />
                        </IconField>
                    </div>
                    <div class="field col">
                        <IconField iconPosition="left">
                            <InputIcon class="pi pi-search"> </InputIcon>
                            <InputText v-model="value1" placeholder="Id Pegawai" />
                        </IconField>
                    </div>
                </div>
                <div class="formgrid grid">    
                    <div class="field grid">
                        <IconField iconPosition="left">
                            <InputIcon class="pi pi-search"> </InputIcon>
                            <InputText v-model="value1" placeholder="Jabatan" />
                        </IconField>
                    </div>
                    <div class="field grid">
                        <IconField iconPosition="left">
                            <InputIcon class="pi pi-search"> </InputIcon>
                            <InputText v-model="value1" placeholder="Departemen" />
                        </IconField>
                    </div>
                </div>
                <div class="field">
                <Button type="button" label="Search" icon="pi pi-search" :loading="loading" @click="load" />
                </div>
            </SplitterPanel>
        </Splitter>
        <Dialog
        v-model:visible="productDialog"
        :style="{ width: '1050px' }"
        header="Registrasi Pegawai"
        :modal="true"
        class="p-fluid"
        >
        
        <template #footer>
            <Button label="Cancel" icon="pi pi-times" text @click="hideDialog" />
            <Button label="Save" icon="pi pi-check" text @click="savePegawai" />
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

.buttonCreatePegawai{
    width: 150px;
    height: 35px;
}

</style>