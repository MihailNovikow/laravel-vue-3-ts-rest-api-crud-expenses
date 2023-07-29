<template>
  <div class="list row">
    
    <div class="col-md-6">
      <h4>Expenses List</h4>
      <ul class="list-group">
        <li
          class="list-group-item"
          :class="{ active: index == currentIndex }"
          v-for="(Expense, index) in Expenses"
          :key="index"
          @click="setActiveExpense(Expense, index)"
        >
          {{ Expense.date }}
        </li>
      </ul>

      <button class="m-3 btn btn-sm btn-danger" @click="removeAllExpenses">
        Remove All
      </button>
    </div>
    <div class="col-md-6">
      <div v-if="currentExpense.id">
        <h4>Expense</h4>
        <div>
          <label><strong>date:</strong></label> {{ currentExpense.date }}
        </div>
        <div>
          <label><strong>sum:</strong></label>
          {{ currentExpense.sum }}
        </div>
       <div>
          <label><strong>comment:</strong></label>
          {{ currentExpense.comment }}
        </div>

        <router-link
          :to="'/expenses/' + currentExpense.id"
          class="badge badge-warning"
          >Edit</router-link
        >
      </div>
      <div v-else>
        <br />
        <p>Please click on a expense...</p>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { onMounted } from "vue";
import ExpenseDataService from "@/services/ExpenseDataService";
import Expense from "@/types/Expense";
import ResponseData from "@/types/ResponseData";

let expenses = [] as Expense[];
let currentExpense = {} as Expense;
let currentIndex: Number = -1;
const retrieveExpenses = () => {
    ExpenseDataService.getAll()
        .then((response: ResponseData) => {
            expenses = response.data.data;
            console.log(response.data.data);
        })
        .catch((e: Error) => {
            console.log(e);
        });
};

const refreshList = () => {
    retrieveExpenses();
    currentExpense = {} as Expense;
    currentIndex = -1;
};

    const setActiveExpense = (Expense: Expense, index = -1) => {
      currentExpense = Expense;
      currentIndex = index;
};

const removeAllExpenses = () => {
    ExpenseDataService.deleteAll()
        .then((response: ResponseData) => {
            console.log(response.data.data);
            refreshList();
        })
        .catch((e: Error) => {
            console.log(e);
        });
};

onMounted(() => {
    retrieveExpenses();
});
</script>

<style>
.list {
  text-align: left;
  max-width: 750px;
  margin: auto;
}
</style>
