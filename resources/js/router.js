import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)


export const constantRoutes = [


  { path: "/login", name: "login", component: require("./views/login.vue").default },

  { path: "/", name: "home", component: require("./components/RedirectAuth.vue").default },
  { path: '/404', name: "404", component: require("./views/NotFound.vue").default },
  { path: '*', redirect: '/404' },
  { path: '/logout', name: "logout", component: require("./views/logout.vue").default },
  
  {
    path: '/dashboard',
    component: require("./layouts/dashboard.vue").default,
    meta: {
      requiresAuth: true,
      roles: 'montor'
    },
    children: [
      {
        path: 'status',
        component: require("./pages/homeDashboard.vue").default,
        name: 'dashboard',
        meta: {
          requiresAuth: true, title: 'status',
          roles: 'montor'
        }
      },
      {
        path: 'children',
        component: require("./pages/children.vue").default,
        name: 'children',
        meta: {
          requiresAuth: true, title: 'children',
          roles: 'montor'
        }
      },
      {
        path: 'sponsors',
        component: require("./pages/sponsors.vue").default,
        name: 'sponsors',
        meta: {
          requiresAuth: true, title: 'sponsors',
          roles: 'montor'
        }
      }
      ,
      {
        path: 'users',
        component: require("./pages/users.vue").default,
        name: 'users',
        meta: {
          requiresAuth: true, title: 'users',
          roles: 'admin'
        }
      }


    ]
  }
]

export const asyncRoutes = [
  {
  },

]

const createRouter = () => new Router({
  routes: constantRoutes,
  mode: 'history',
})

const router = createRouter()

// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
  const newRouter = createRouter()
  router.matcher = newRouter.matcher // reset router
}
router.beforeEach((to, from, next) => {


  if (to.meta.hasOwnProperty("requiresAuth"))
    if (to.meta.requiresAuth)


      if (!Vue.auth.isLoggedIn()) {
        next({
          path: '/login',
          //  query: { redirect: to.fullPath } // editing
        })

      } else { // add monter admin editor

        if (Vue.auth.isHaveAcsses(to.meta.roles))
          next()
        else {
          next({
            name: '404',
            //  query: { redirect: to.fullPath } // editing
          })
        }


      }

  next()

})
export default router
