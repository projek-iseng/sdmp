// views/master/master-index.ts
import { RouteRecordRaw } from "vue-router";

// Define routes
const masterRoutes: Array<RouteRecordRaw> = [
  {
    path: "/master-jabatan",
    name: "master-jabatan",
    component: () => import("./master-jabatan.vue"),
  },
  {
    path: "/master-registrasi",
    name: "master-registrasi",
    component: () => import("./master-registrasi.vue"),
  },
  {
    path: "/master-departemen",
    name: "Master Departemen",
    component: () => import("./master-departemen.vue"),
  },
  {
    path: "/master-gaji",
    name: "Master Gaji",
    component: () => import("./master-gaji.vue"),
  },
];

//create router

export default masterRoutes;
