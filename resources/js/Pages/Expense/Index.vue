<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';

defineProps({
  expenses: Object,
  categories: Object,
});

function convertDate(timeStamp) {
  var dateFormat = new Date(timeStamp);
  var formatted = dateFormat.getFullYear() +
    "-" + (dateFormat.getMonth() + 1) +
    "-" + dateFormat.getDate();
  return formatted;
}
</script>

<template lang="">
 <auth-layout>
  <div class=" space-y-4 md:py-6 md:space-y-12 md:px-12">
      <div class=" sm:justify-between sm:flex">
        <div>
          Expenses
        </div>
        <div>
          Expense Management > Expenses
        </div>
      </div>

      <!-- MAIN CONTENT - Expenses Table -->
      <!-- Web view -->
      <div class=" md:block hidden px-12">
        <table className=" table-fixed w-full">
          <thead>
              <tr className="bg-gray-100">
                  <th className="px-4 py-2">Expense Category</th>
                  <th className="px-4 py-2">Amount</th>
                  <th className="px-4 py-2">Expense Date</th>
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
                        ₱{{ expense.amount }}
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

        <!-- create button -->
        <div class=" mt-3 justify-end flex">
          <Link :href="route('expense.create')">
            <button class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4">
              Add Expense
            </button>
          </Link>
        </div>
      </div>

      <!-- Mobile view -->
      <div class=" md:hidden mt-3 justify-end flex">
        <Link :href="route('expense.create')">
          <button class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4">
            Add Expense
          </button>
        </Link>
      </div>
      <div class=" md:hidden" v-for="expense in expenses" :key="expense.id">
        <Link :href="route('expense.edit', expense)">
          <div class=" rounded-lg p-3 shadow bg-gray-100">
            <div class=" grid-cols-2 grid">
              <div>
                <div class=" text-gray-800 font-semibold text-lg" v-for="category in categories" :key="category.id">
                  {{ category.id === expense.category_id ? category.name : "" }}
                </div>
              </div>

              <div class=" flex justify-end text-gray-700">{{ convertDate(expense.entry_date) }}</div>
            </div>
            <div>Amount: ₱{{ expense.amount }}</div>
            
            <div class=" text-gray-400">Created at: {{ convertDate(expense.created_at) }}</div>
          </div>
        </Link>
      </div>
    </div>
 </auth-layout> 
</template>