import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)


export const constantRoutes = [


  {path: "/login" , name :"login" ,  component: require ("./views/login.vue").default},

  {path: "/" ,  name :"home" ,  component: require ("./components/RedirectAuth.vue").default},





  { path: '/404',  name :"404" ,  component: require ("./views/NotFound.vue").default },
  { path: '*',  redirect: '/404' },
  {
    path: '/dashboard',
    component: require ("./layouts/dashboard.vue").default ,
    meta: {  requiresAuth : true,
    roles: ['admin', 'editor' ,'montor'] },
    children: [
      {
        path: '/users',
        component: require ("./pages/homeDashboard.vue").default ,
        name: 'dashboard',
        meta: { title: 'users', icon: 'Dashboard' ,
         roles:  ['admin'] }
      },
      {
        path: '/children',
        component: require ("./pages/children.vue").default ,
        name: 'children',
        meta: { title: 'children', icon: 'children' ,
         roles:  ['admin', 'editor' ,'montor'] }
      }
    ]
  }
]

export const asyncRoutes = [
  {
  },

]

const createRouter = () => new Router({
    routes:  constantRoutes,
    mode: 'history',
    base: process.env.BASE_URL,
})

const router = createRouter()

// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
  const newRouter = createRouter()
  router.matcher = newRouter.matcher // reset router
}
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {


      if (!Vue.auth.loggedIn()) {
        next({
          path: '/login',
        //  query: { redirect: to.fullPath } // editing
        })
      } else { // add monter admin editor
        next()
      }
    } else {
      next()
    }
  })
export default router
