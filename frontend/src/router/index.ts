//import vue router
import { createRouter, createWebHistory } from "vue-router";
import masterRoutes from "../views/master/master-index";
import sysadminRoutes from "../views/Sysadmin/master-index";

//define a routes
const routes = [
  {
    path: "/",
    name: "home",
    component: () =>
      import(/* webpackChunkName: "home" */ "../views/Dashboard.vue"),
    // props: (route) => ({ isSidebarOpen: route.params.isSidebarOpen }), // Penerusan props
  },
  {
    path: "/pegawai-dashboard",
    name: "pegawai",
    component: () =>
      import(/* webpackChunkName: "home" */ "../views/PegawaiDashboard.vue"),
  },
  {
    path: "/calendar",
    name: "calendar",
    component: () =>
      import(/* webpackChunkName: "home" */ "../views/Calendar.vue"),
  },
  {
    path: "/pengajuancuti",
    name: "pengajuancuti",
    component: () =>
      import(/* webpackChunkName: "home" */ "../views/FormPengajuanCuti.vue"),
  },
  {
    path: "/penilaiankinerja",
    name: "penilaiankinerja",
    component: () =>
      import(
        /* webpackChunkName: "home" */ "../views/FormPenilaianKinerja.vue"
      ),
  },
  {
    path: "/managementkaryawan",
    name: "managementkaryawan",
    component: () =>
      import(/* webpackChunkName: "home" */ "../views/ManajemenKaryawan.vue"),
  },
  {
    path: "/pelatihandanpengembangan",
    name: "pelatihandanpengembangan",
    component: () =>
      import(
        /* webpackChunkName: "home" */ "../views/FormPelatihanDanPengembangan.vue"
      ),
  },
  {
    path: "/auth",
    name: "auth",
    component: () =>
      import(/* webpackChunkName: "home" */ "../views/Login/auth.vue"),
    meta: { hideNavbar: true },
  },

  ...masterRoutes,
  ...sysadminRoutes,
];

//create router
const router = createRouter({
  history: createWebHistory(),
  routes, // <-- routes,
});

export default router;
