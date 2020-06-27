import Index from "./components/Index";
import PriceList from "./components/PriceList";

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
]