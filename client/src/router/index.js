import Vue from 'vue'
import VueRouter from 'vue-router'
import Auth from '../views/Login.vue'
import Home from '../views/Home.vue'
import SearchBook from '../views/SearchBook.vue'
import CompareBooks from '../views/CompareBooks.vue'
import ReportBooks from '../views/ReportBooks.vue'
import StatisticBook from '../views/StatisticBook.vue'
import DetailBook from '../views/DetailBook.vue'
import ListGuest from '../views/ListGuest.vue'
import NotFound from '../views/page404.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/signin',
    name: 'Auth',
    component: Auth
  },
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/searchbook',
    name: 'SearchBook',
    component: SearchBook
  },
  {
    path: '/listguest',
    name: 'ListGuest',
    component: ListGuest
  },
  {
    path: '/comparebooks',
    name: 'CompareBooks',
    component: CompareBooks
  },
  {
    path: '/statisticbook',
    name: 'StatisticBook',
    component: StatisticBook
  },
  {
    path: '/detailbook',
    name: 'DetailBook',
    component: DetailBook
  },
  {
    path: '/reportbooks',
    name: 'ReportBooks',
    component: ReportBooks
  },
  {
    path: '/404',
    name: '404',
    component: NotFound
  },
  {
    path: '*',
    redirect: '/404'
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
