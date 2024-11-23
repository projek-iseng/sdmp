// views/master/master-index.ts
import { RouteRecordRaw } from 'vue-router';

// Define routes
const masterRoutes: Array<RouteRecordRaw> = [

    {
        path: '/master-jabatan',
        name: 'master-jabatan',
        component: () => import('./master-jabatan.vue')
    },
    {
        path: '/master-registrasi',
        name: 'master-registrasi',
        component: () => import('./master-registrasi.vue')
    },
    {
        path: '/Log-users',
        name: 'Log-users',
        component: () => import( './LogUsers.vue'),

    },

];

//create router


export default masterRoutes;