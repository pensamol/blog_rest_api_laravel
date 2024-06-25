import { createRouter, createWebHistory } from 'vue-router'
import FrontLayout from '../layouts/frontLayout.vue'
import AdminLayout from '../layouts/adminLayout.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '',
      name: 'front.layout',
      component: FrontLayout,
      meta: {
        requiresAuth: false
      },
      children: [
        {
          path: '',
          name: 'home',
          component: () => import('@/views/modules/frontend/HomeView.vue')
        }
      ]
    },
    {
      path: '/admin/login',
      name: 'admin.users.login',
      meta: {
        requiresAuth: false
      },
      component: () => import('@/views/modules/login/login.vue')
    },
    {
      path: '/admin',
      name: 'admin.layout',
      component: AdminLayout,
      meta: {
        requiresAuth: true
      },
      children: [
        {
          path: 'dashboard',
          name: 'admin.dashboard.index',
          component: () => import('@/views/modules/backend/dashboard/dashboard.vue')
        },
        {
          path: "users",
         children: [
          {
            path: '',
            name: 'admin.users.index',
            component: () => import('@/views/modules/backend/user/index.vue')
          },
          {
            path: 'create',
            name: 'admin.users.create',
            component: () => import("@/views/modules/backend/user/create.vue")
          },
          {
            path: ':id/edit',
            name: 'admin.users.edit',
            component: () => import("@/views/modules/backend/user/update.vue")
          }
         ]
        },
        {
          path: 'roles',
          children: [
            {
              path: '',
              name: 'admin.roles.index',
              component: () => import("@/views/modules/backend/role/index.vue")
            },
            {
              path: 'create',
              name: 'admin.roles.create',
              component: () => import("@/views/modules/backend/role/create.vue")
            },
            {
              path: ':id/edit',
              name: 'admin.roles.edit',
              component: () => import("@/views/modules/backend/role/edit.vue")
            }
          ]
        }
      ]
    }
  ]
})

router.beforeEach((to, from, next) => {
  const isAuthenticated = localStorage.getItem('isAuth');
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  
  if (requiresAuth && !isAuthenticated) {
    next('/admin/login');
  } else if (isAuthenticated && to.path === '/admin/login') {
    next('/admin/dashboard');
  } else {
    next();
  }
});

export default router
