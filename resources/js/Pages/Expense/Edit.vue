<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import VueDatePicker from '../../../../node_modules/@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const props = defineProps({
  expense: {
    type: Object,
    default: () => ({}),
  },
  categories: Object,
});

// Form ref/object
const form = useForm({
  id: props.expense.id,
  amount: props.expense.amount,
  entry_date: props.expense.entry_date,
  category_id: props.expense.category_id,
});

const date = ref(form.entry_date);

const format = (date) => {
  // YYYY-MM-DD HH:MM:SS
  const day = date.getDate();
  const month = date.getMonth() + 1;
  const year = date.getFullYear();
  // const hours = date.getUTCHours();
  // const minutes = date.getUTCMinutes();
  // const seconds = date.getUTCSeconds();

  return `${year}-${month}-${day}`;
}

let updatedExpense = ref({
  "id": form.id,
  "amount": form.amount,
  "entry_date": form.entry_date,
  "category_id": form.category_id,
});

// Function/s
const submitSave = (updatedExpense) => {
  form.put(route('expense.update', updatedExpense));
}

const destroy = (id) => {
  if (confirm("Are you sure you want to delete this record?")) {
    form.delete(route('expense.destroy', id));
  }
}
</script>

<template lang="">
 <auth-layout>
  <div class=" py-6 space-y-12 px-12">
   <div class=" justify-between flex">
    <div>
     Expenses
    </div>
    <div>
     Expense Management > Expenses
    </div>
   </div>
  </div>

  <!-- Modal -->
  <div id="modal" class=" fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
   <div class=" relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
    <div class="text-center">
     <div fill="none" class=" mx-auto flex-col flex items-center justify-center">
        <div class=" w-full flex">
        <div class=" text-lg leading-6 font-medium text-gray-900">Edit Expense</div>
        </div>

        <div class=" h-[1px] bg-black w-full"></div>

        <!-- FORM -->
        <div class=" w-full mt-2 py-3">
          <form name="createForm" @submit.prevent="submitSave" class=" space-y-3">
            <!-- category - dropdown-->
            <div class=" flex-col flex">
              <div class=" items-center justify-between flex">
                <div class=" items-center flex">
                  <div>Expense Category</div>
                  <input hidden class=" w-[calc(100%/3)]" id="category_id" name="category_id" v-model="form.category_id" type="text">
                </div>
              
                <div>
                  <select v-model="form.category_id" @change="form.category_id" class=" border-black border-2">
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                      {{ category.name }}
                    </option>
                  </select>
                </div>
              </div>

              <div class=" items-center justify-end flex text-red-600" v-if="form.errors.category_id">
                {{ form.errors.category_id }}
              </div>
            </div>

            <!-- amount -->
            <div class=" flex-col flex">
              <div class=" items-center justify-between flex">
                <label for="amount">Amount</label>
                <input 
                id="amount"
                v-model="form.amount"
                type="number"
                name="amount"
                placeholder="Amount"
                />
              </div>

              <div class=" items-center justify-end flex text-red-600" v-if="form.errors.amount">
                {{ form.errors.amount }}
              </div>
            </div>

            <!-- entry date -->
            <div class=" flex-col flex">
              <div class=" items-center justify-between flex">
                <label for="email">Entry Date</label>
                <div class=" justify-end flex">
                </div>

                  <!-- <calendar-icon class=" w-6"/> -->
                  <div class="w-[calc(100%-42%)]">
                    <VueDatePicker v-model="form.entry_date" :format="format"></VueDatePicker>
                  </div>
                </div>
              <div class=" items-center justify-end flex text-red-600" v-if="form.errors.entry_date">
                {{ form.errors.entry_date }}
              </div>
            </div>

            <!-- buttons -->
            <div class=" gap-3 justify-between flex py-3">
              <button @click="destroy(form.id)" class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4 hover:h-[34px]">
                Delete
              </button>

              <div class=" gap-3 flex">
                <Link :href="route('expense.index')">
                  <button id="ok-btn" class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4 hover:h-[34px]">
                  Cancel
                  </button>
                </Link>

                <button type="submit" @click="submitSave(updatedExpense)" id="ok-btn" class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4 hover:h-[34px]">
                    Save
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
   </div>
  </div>
 </auth-layout> 
</template>