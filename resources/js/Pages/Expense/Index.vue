<script setup>
defineProps({
 expenses: Object,
 categories: Object,
});

import AuthLayout from '@/Layouts/AuthLayout.vue';
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';

let isOpen = ref(false);

const handleOpen = () => {
 isOpen.value = !isOpen.value;
 console.log(isOpen.value);
};
const modal = ref(0)

function showModal() {
 let modal = document.getElementById('modal');
 modal.style.display = 'block';
}

function hideModal() {
 let modal = document.getElementById('modal');
 modal.style.display = 'none';
}

function convertDate(timeStamp){
  var dateFormat = new Date(timeStamp);
  var formatted = dateFormat.getFullYear()+
           "-"+(dateFormat.getMonth()+1)+
           "-"+dateFormat.getDate();
  return formatted;
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

      <div class=" px-12">
        <table className=" table-fixed w-full">
          <thead>
              <tr className="bg-gray-100">
                  <th className="px-4 py-2">Expense Category</th>
                  <th className="px-4 py-2">Amount</th>
                  <th className="px-4 py-2">Entry Date</th>
                  <th className="px-4 py-2">Created at</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="expense in expenses" :key="expense.id">
                  <td className="border px-4 py-2">
                    <Link :href="route('expense.edit', expense)">
                      <div v-for="category in categories" :key="category.id">
                        {{ category.id === expense.category_id ? category.name : "" }}
                      </div>
                    </Link>
                  </td>
                  <td className="border px-4 py-2">
                    <Link :href="route('expense.edit', expense)">
                      <div>
                        ${{ expense.amount }}
                      </div>
                    </Link>
                  </td>
                  <td className="border px-4 py-2">
                    <Link :href="route('expense.edit', expense)">
                      <div>
                        {{ convertDate(expense.entry_date) }}
                      </div>
                    </Link>
                  </td>
                  <td className="border px-4 py-2">
                    <Link :href="route('expense.edit', expense)">
                      <div>
                        {{ convertDate(expense.created_at) }}
                      </div>
                    </Link>
                  </td>
              </tr>
          </tbody>
        </table>
        <div class=" mt-3 justify-end flex">
          <Link :href="route('expense.create')">
            <button class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4">
              Add Expense
            </button>
          </Link>
        </div>
      </div>
    </div>
 </auth-layout> 
</template>