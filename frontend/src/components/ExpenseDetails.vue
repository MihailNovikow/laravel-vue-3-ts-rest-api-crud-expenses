<template>
  <div v-if="currentExpense.id" class="edit-form">
    <h4>expense</h4>
    <form>
      <div class="form-group">
        <label for="date">date</label>
        <input
          type="text"
          class="form-control"
          id="date"
          v-model="currentExpense.date"
        />
      </div>
      <div class="form-group">
        <label for="sum">sum</label>
        <input
          type="text"
          class="form-control"
          id="sum"
          v-model="currentExpense.sum"
        />
      </div>
<div class="form-group">
        <label for="comment">comment</label>
        <input
          type="text"
          class="form-control"
          id="comment"
          v-model="currentExpense.comment"
        />
      </div>
    </form>

    

    <button class="badge badge-danger mr-2" @click="deleteExpense">
      Delete
    </button>

    <button type="submit" class="badge badge-success" @click="updateExpense">
      Update
    </button>
    <p>{{ message }}</p>
  </div>

  <div v-else>
    <br />
    <p>Please click on a expense...</p>
  </div>
</template>

<script lang="ts" setup>
import { onMounted } from "vue";
import ExpenseDataService from "@/services/ExpenseDataService";
import Expense from "@/types/Expense";
import ResponseData from "@/types/ResponseData";

let currentExpense = {} as Expense;
let message: String = "";
const getExpense = (id: number) => {
      ExpenseDataService.get(id)
        .then((response: ResponseData) => {
          currentExpense = response.data.data;
          console.log(response.data.data);
        })
        .catch((e: Error) => {
          console.log(e);
        });
    },


const updateExpense = () => {
    ExpenseDataService.update(currentExpense.id, currentExpense)
        .then((response: ResponseData) => {
            console.log(response.data.data);
            message = "The expense was updated successfully!";
        })
        .catch((e: Error) => {
            console.log(e);
        });
};

const deleteExpense = () => {
    ExpenseDataService.delete(currentExpense.id)
        .then((response: ResponseData) => {
            console.log(response.data.data);
            $router.push({ name: "expenses" });
        })
        .catch((e: Error) => {
            console.log(e);
        });
};
onMounted(() => {
    message = "";
    getExpense($route.params.id);
});
</script>

<style>
.edit-form {
  max-width: 300px;
  margin: auto;
}
</style>
