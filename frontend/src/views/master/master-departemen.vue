<template>
  <div class="card">
    <!-- Tambah Data -->
    <Toolbar class="mb-4">
      <template #start>
        <Button
          label="New"
          icon="pi pi-plus"
          severity="success"
          class="mr-2"
          @click="openNew"
        />
        <Button
          label="Delete"
          icon="pi pi-trash"
          severity="danger"
          @click="confirmDeleteSelected"
          :disabled="!selectedProducts || !selectedProducts.length"
        />
      </template>

      <!-- Hapus Data -->
      <template #end>
        <FileUpload
          mode="basic"
          accept="image/*"
          :maxFileSize="1000000"
          label="Import"
          chooseLabel="Import"
          class="mr-2 inline-block"
        />
        <Button
          label="Export"
          icon="pi pi-upload"
          severity="help"
          @click="exportCSV($event)"
        />
      </template>
    </Toolbar>
    <TreeTable :value="nodes" tableStyle="min-width: 50rem">
      <template #header>
        <div class="text-xl font-bold">Departemen</div>
      </template>
      <Column
        field="idDepartemen"
        header="Kode Departemen"
        expander
        style="width: 250px"
      ></Column>
      <Column
        field="namaDepartemen"
        header="Nama Departemen"
        expander
        style="width: 250px"
      ></Column>
      <Column
        field="valuePegawai"
        header="Jumlah Pegawai"
        expander
        style="width: 250px"
      ></Column>
      <!-- <Column style="width: 10rem">
            <template #body>
              <div class="flex flex-wrap gap-2">
                <Button type="button" icon="pi pi-search" rounded />
                <Button
                  type="button"
                  icon="pi pi-pencil"
                  rounded
                  severity="success"
                />
              </div>
            </template>
          </Column> -->
      <!-- <template #footer>
            <div class="flex justify-start">
              <Button icon="pi pi-refresh" label="Reload" severity="warn" />
            </div>
          </template> -->
    </TreeTable>
  </div>
  <div class="card">
    <Paginator :rows="10" :totalRecords="120">
      <template
        #container="{
          first,
          last,
          page,
          pageCount,
          prevPageCallback,
          nextPageCallback,
          totalRecords,
        }"
      >
        <div
          class="flex items-center gap-4 border border-primary bg-transparent rounded-full w-full py-1 px-2 justify-between"
        >
          <Button
            icon="pi pi-chevron-left"
            rounded
            text
            @click="prevPageCallback"
            :disabled="page === 0"
          />
          <div class="text-color font-medium">
            <span class="hidden sm:block"
              >Showing {{ first }} to {{ last }} of {{ totalRecords }}</span
            >
            <span class="block sm:hidden"
              >Page {{ page + 1 }} of {{ pageCount }}</span
            >
          </div>
          <Button
            icon="pi pi-chevron-right"
            rounded
            text
            @click="nextPageCallback"
            :disabled="page === pageCount - 1"
          />
        </div>
      </template>
    </Paginator>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { FilterMatchMode } from "primevue/api";
import { useToast } from "primevue/usetoast";
import { ProductService } from "../../services/ProductService";
import apiClient from "../../services/apiService";
</script>
../services/ProductService
