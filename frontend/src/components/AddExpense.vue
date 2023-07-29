<template>
  <div class="submit-form">
    <div v-if="!submitted">
        <div class="form-group">
        <label for="date">date</label>
        <input
          type="text"
          class="form-control"
          id="date"
          required
          v-model="expense.date"
          name="date"
        />
      </div>
      <div class="form-group">
        <label for="sum">sum</label>
        <input
          type="text"
          class="form-control"
          id="sum"
          required
          v-model="expense.sum"
          name="sum"
        />
      </div>

      <div class="form-group">
        <label for="comment">comment</label>
        <input
          class="form-control"
          id="comment"
          required
          v-model="expense.comment"
          name="comment"
        />
      </div>
      <button @click="saveExpense" class="btn btn-success">Submit</button>
    </div>

    <div v-else>
      <h4>You submitted successfully!</h4>
      <button class="btn btn-success" @click="newExpense">Add</button>
    </div>
  </div>
</template>

<script lang="ts" setup>
import ExpenseDataService from "@/services/ExpenseDataService";
import Expense from "@/types/Expense";
import ResponseData from "@/types/ResponseData";

let expense: Expense = {
    id: null,
    date: "",
    sum: 0,
    comment: ""
};
let submitted: Boolean = false;
    
const saveExpense = () => {
    let data = {
        sum: expense.sum,
        comment: expense.comment,
    };

    ExpenseDataService.create(data)
        .then((response: ResponseData) => {
            expense.id = response.data.data.id;
            console.log(response.data.data);
            submitted = true;
        })
        .catch((e: Error) => {
            console.log(e);
        });
};

    const newExpense = () => {
        submitted = false;
        expense = {} as Expense;
    };
</script>

<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>
