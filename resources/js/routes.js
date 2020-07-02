import Index from "./components/Index";
import PriceList from "./components/PriceList";
import Login from "./components/Login";

export default [
  {
    path: '/',
    name: 'Index',
    component: Index
  },
  {
    path: '/price',
    name: 'PriceList',
    component: PriceList,
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  }
]