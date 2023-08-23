<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';

defineProps({
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
  <div class=" py-6 space-y-12 px-12">
      <div class=" justify-between flex">
        <div>
          Expense Categories
        </div>
        <div>
          Expense Management > Expense Categories
        </div>
      </div>

      <!-- MAIN CONTENT - Categories Table -->
      <div class=" px-12">
        <table className=" table-fixed w-full">
          <thead>
              <tr className="bg-gray-100">
                  <th className="px-4 py-2">Display Name</th>
                  <th className="px-4 py-2">Description</th>
                  <th className="px-4 py-2">Created at</th>
              </tr>
          </thead>

          <tbody>
              <tr v-for="category in categories" :key="category.id">
                  <td className="border px-4 py-2">
                    <Link :href="route('category.edit', category)">
                      <div>
                        {{ category.name }}
                      </div>
                    </Link>
                  </td>

                  <td className="border px-4 py-2">
                    <Link :href="route('category.edit', category)">
                      <div>
                        {{ category.description }}
                      </div>
                    </Link>
                  </td>
                  
                  <td className="border px-4 py-2">
                    <Link :href="route('category.edit', category)">
                      <div>
                        {{ convertDate(category.created_at) }}
                      </div>
                    </Link>
                  </td>
              </tr>
          </tbody>
        </table>

        <!-- create button -->
        <div class=" mt-3 justify-end flex">
          <Link :href="route('category.create')">
            <button class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4">
              Add Category
            </button>
          </Link>
        </div>
      </div>
    </div>
 </auth-layout>
</template>