import { createWebHistory, createRouter } from "vue-router";
import { RouteRecordRaw } from "vue-router";
import ExpensesList from "./components/ExpensesList.vue"
const routes: Array<RouteRecordRaw> = [
  {
    path: "/",
    alias: "/expenses",
    name: "expenses",
    component:  ExpensesList,
  },
  {
    path: "/expenses/:id",
    name: "expense-details",
    component: () => import("./components/ExpenseDetails.vue"),
  },
  {
    path: "/add",
    name: "add",
    component: () => import("./components/AddExpense.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
