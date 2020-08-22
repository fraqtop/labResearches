import Index from "./components/Index";
import PriceList from "./components/price/PriceList";
import Login from "./components/Login";
import ResearchesList from "./components/researches/List";
import NewResearch from './components/researches/New';

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
    component: Login,
    meta: {layout: 'empty'}
  },
  {
    path: '/researches',
    component: {
      render (c) { return c('router-view') }
    },
    children: [
      {
        path: 'new',
        name: 'NewResearch',
        component: NewResearch
      },
      {
        path: 'list',
        name: 'ResearchesList',
        component: ResearchesList
      }
    ]
  }
]