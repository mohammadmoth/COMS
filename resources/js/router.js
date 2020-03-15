import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)


export const constantRoutes = [
 
    
  {path: "/login" , name :"login" ,  component: require ("./views/login.vue").default},
  
  {path: "/" ,  name :"home" ,  component: require ("./components/RedirectAuth.vue").default},





  { path: '/404',  name :"404" ,  component: require ("./views/NotFound.vue").default },
  { path: '*',  redirect: '/404' },
  {
    path: '/',
    component: require ("./layouts/dashboard.vue") ,
    children: [
      {
        path: 'dashboard',
        component: require ("./pages/homeDashboard.vue").default ,
        name: 'dashboard',
        meta: { title: 'Dashboard', icon: 'Dashboard', affix: true }
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

export default router