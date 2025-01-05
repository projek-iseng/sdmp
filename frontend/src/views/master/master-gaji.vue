<script lang="ts" setup>
import apiClient from "../../services/apiService";
import { ref, onMounted } from "vue";
import imgLogo from "../../../public/game.svg";
import * as XLSX from 'xlsx';
import { useToast } from 'primevue/usetoast';
import { ProductService } from "../../services/ProductService";

const value:any = ref({});

const dataPegawai:any = ref({});

onMounted(() => {
    ProductService.getProducts().then((data) => (products.value = data.slice(0, 12)));
});

const products = ref();
const layout = ref('grid');

const getSeverity = (product) => {
    switch (product.inventoryStatus) {
        case 'INSTOCK':
            return 'success';

        case 'LOWSTOCK':
            return 'warning';

        case 'OUTOFSTOCK':
            return 'danger';

        default:
            return null;
    }
}
</script>

<template>
  <div>
    <Splitter class="splitter-custom" layout="horizontal">
      <SplitterPanel class="" :size="65">
          <div class="card" v-if="dataPegawai">
            <DataView :value="products" paginator :rows="5" :layout="layout">
                <template #header>
                  <div class="flex text-center justify-content-between">
                    <div class="flex pt-4 ">
                    <FloatLabel class="mr-2" >
                        <InputText disabled  id="Nama" v-model="value.Nama" />
                        <label for="Nama">Nama loading...</label>
                    </FloatLabel>
                    <FloatLabel class="mr-2">
                        <InputText disabled  id="Departemen" v-model="value.Departemen" />
                        <label for="Departemen">Departemen loading...</label>
                    </FloatLabel>
                    <FloatLabel class="mr-2">
                        <InputText disabled  id="Jabatan" v-model="value.Jabatan" />
                        <label for="Jabatan">Jabatan loading...</label>
                    </FloatLabel>
                    </div>
                    <div class="flex justify-content-end">
                        <DataViewLayoutOptions v-model="layout" />
                    </div>
                  </div>
                </template>

                <template #list>
                    <div class="grid grid-nogutter">
                        <div v-for="i in 6" :key="i" class="col-12">
                            <div class="flex flex-column xl:flex-row xl:align-items-start p-4 gap-4" :class="{ 'border-top-1 surface-border': i !== 0 }">
                                <Skeleton class="w-9 sm:w-16rem xl:w-10rem h-6rem block xl:block mx-auto border-round" />
                                <div class="flex flex-column sm:flex-row justify-content-between align-items-center xl:align-items-start flex-1 gap-4">
                                    <div class="flex flex-column align-items-center sm:align-items-start gap-3">
                                        <Skeleton class="w-8rem border-round h-2rem" />
                                        <Skeleton class="w-6rem border-round h-1rem" />
                                        <div class="flex align-items-center gap-3">
                                            <Skeleton class="w-6rem border-round h-1rem" />
                                            <Skeleton class="w-3rem border-round h-1rem" />
                                        </div>
                                    </div>
                                    <div class="flex sm:flex-column align-items-center sm:align-items-end gap-3 sm:gap-2">
                                        <Skeleton class="w-4rem border-round h-2rem" />
                                        <Skeleton shape="circle" class="w-3rem h-3rem" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <template #grid>
                    <div class="grid grid-nogutter">
                        <div v-for="i in 6" :key="i" class="col-6 sm:col-3 md:col-3 xl:col-3 p-2">
                            <div class="p-4 border-1 surface-border surface-card border-round">
                                <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                                    <Skeleton class="w-6rem border-round h-2rem" />
                                    <Skeleton class="w-3rem border-round h-1rem" />
                                </div>
                                <div class="flex flex-column align-items-center gap-3 py-5">
                                    <Skeleton class="w-9 border-round h-10rem" />
                                    <Skeleton class="w-8rem border-round h-2rem" />
                                    <Skeleton class="w-6rem border-round h-1rem" />
                                </div>
                                <div class="flex align-items-center justify-content-between">
                                    <Skeleton class="w-4rem border-round h-2rem" />
                                    <Skeleton shape="circle" class="w-3rem h-3rem" />
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </DataView>
        </div>

        <!--  -->

        <div class="card" v-else>
            <DataView :value="products" paginator :rows="5" :layout="layout">
                <template #header>
                  <div class="flex text-center justify-content-between">
                    <div class="flex pt-4 ">
                    <FloatLabel class="mr-2" >
                        <InputText id="Nama" v-model="value.Nama" />
                        <label for="Nama">Nama</label>
                    </FloatLabel>
                    <FloatLabel class="mr-2">
                        <InputText id="Departemen" v-model="value.Departemen" />
                        <label for="Departemen">Departemen</label>
                    </FloatLabel>
                    <FloatLabel class="mr-2">
                        <InputText id="Jabatan" v-model="value.Jabatan" />
                        <label for="Jabatan">Jabatan</label>
                    </FloatLabel>
                    </div>
                    <div class="flex justify-content-end">
                        <DataViewLayoutOptions v-model="layout" />
                    </div>
                  </div>
                </template>

                <template #list="slotProps">
                    <div class="grid grid-nogutter">
                        <div v-for="(item, index) in slotProps.items" :key="index" class="col-12">
                            <div class="flex flex-column sm:flex-row sm:align-items-center p-4 gap-3" :class="{ 'border-top-1 surface-border': index !== 0 }">
                                <div class="md:w-10rem relative">
                                    <img class="block xl:block mx-auto border-round w-full" :src="`https://primefaces.org/cdn/primevue/images/product/${item.image}`" :alt="item.name" />
                                    <Tag :value="item.inventoryStatus" :severity="getSeverity(item)" class="absolute" style="left: 4px; top: 4px"></Tag>
                                </div>
                                <div class="flex flex-column md:flex-row justify-content-between md:align-items-center flex-1 gap-4">
                                    <div class="flex flex-row md:flex-column justify-content-between align-items-start gap-2">
                                        <div>
                                            <span class="font-medium text-secondary text-sm">{{ item.category }}</span>
                                            <div class="text-lg font-medium text-900 mt-2">{{ item.name }}</div>
                                        </div>
                                        <div class="surface-100 p-1" style="border-radius: 30px">
                                            <div class="surface-0 flex align-items-center gap-2 justify-content-center py-1 px-2" style="border-radius: 30px; box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.04), 0px 1px 2px 0px rgba(0, 0, 0, 0.06)">
                                                <span class="text-900 font-medium text-sm">{{ item.rating }}</span>
                                                <i class="pi pi-star-fill text-yellow-500"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-column md:align-items-end gap-5">
                                        <span class="text-xl font-semibold text-900">${{ item.price }}</span>
                                        <div class="flex flex-row-reverse md:flex-row gap-2">
                                            <Button icon="pi pi-heart" outlined></Button>
                                            <Button icon="pi pi-shopping-cart" label="Buy Now" :disabled="item.inventoryStatus === 'OUTOFSTOCK'" class="flex-auto md:flex-initial white-space-nowrap"></Button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <template #grid="slotProps">
                    <div class="grid grid-nogutter">
                        <div v-for="(item, index) in slotProps.items" :key="index" class="col-6 sm:col-3 md:col-3 xl:col-3 p-2">
                            <div class="p-4 border-1 surface-border surface-card border-round flex flex-column">
                                <div class="surface-50 flex justify-content-center border-round p-3">
                                    <div class="relative mx-auto">
                                        <img class="border-round w-full" :src="`https://primefaces.org/cdn/primevue/images/product/${item.image}`" :alt="item.name" style="max-width: 300px"/>
                                        <Tag :value="item.inventoryStatus" :severity="getSeverity(item)" class="absolute" style="left: 4px; top: 4px"></Tag>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <div class="flex flex-row justify-content-between align-items-start gap-2">
                                        <div>
                                            <span class="font-medium text-secondary text-sm">{{ item.category }}</span>
                                            <div class="text-lg font-medium text-900 mt-1">{{ item.name }}</div>
                                        </div>
                                        <div class="surface-100 p-1" style="border-radius: 30px">
                                            <div class="surface-0 flex align-items-center gap-2 justify-content-center py-1 px-2" style="border-radius: 30px; box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.04), 0px 1px 2px 0px rgba(0, 0, 0, 0.06)">
                                                <span class="text-900 font-medium text-sm">{{ item.rating }}</span>
                                                <i class="pi pi-star-fill text-yellow-500"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-column gap-4 mt-4">
                                        <span class="text-2xl font-semibold text-900">${{ item.price }}</span>
                                        <div class="flex gap-2">
                                            <Button icon="pi pi-shopping-cart" label="Buy Now" :disabled="item.inventoryStatus === 'OUTOFSTOCK'" class="flex-auto white-space-nowrap"></Button>
                                            <Button icon="pi pi-heart" outlined></Button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </DataView>
        </div>

      </SplitterPanel>
      <SplitterPanel class="no-resize" :size="5" style="padding: 20px">
        <div class="card">
        <TabView>
            <TabPanel header="Create Gaji">
              <div class="">
                  <FloatLabel class="mt-5">
                      <InputText class="w-full" id="Nama" v-model="value.Nama" />
                      <label for="Nama">Nama</label>
                  </FloatLabel>
                  <FloatLabel class="mt-5">
                      <InputText class="w-full" id="Departemen" v-model="value.Departemen" />
                      <label for="Departemen">Departemen</label>
                  </FloatLabel>
                  <FloatLabel class="mt-5">
                      <InputText class="w-full" id="Jabatan" v-model="value.Jabatan" />
                      <label for="Jabatan">Jabatan</label>
                  </FloatLabel>
                  <Button class="w-full mt-5" label="Submit" />
              </div>
            </TabPanel>
            <!-- <TabPanel header="Creat Pegawai">
                <p class="m-0">
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim
                    ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Consectetur, adipisci velit, sed quia non numquam eius modi.
                </p>
            </TabPanel> -->
        </TabView>
    </div>
      </SplitterPanel>
    </Splitter>
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
