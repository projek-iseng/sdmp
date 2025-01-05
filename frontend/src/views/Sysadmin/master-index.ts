// views/master/master-index.ts
import { RouteRecordRaw } from "vue-router";

// Define routes
const masterRoutes: Array<RouteRecordRaw> = [
  {
    path: "/Log-users",
    name: "Log-users",
    component: () => import("./LogUsers.vue"),
  },
  {
    path: "/map-to-modul",
    name: "Map To Modul",
    component: () => import("./mapToModul.vue"),
  },
  
];

//create router

export default masterRoutes;
