<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

defineProps({
  roles: Object,
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
  <div class=" py-6 space-y-12 md:px-12">
      <div class=" justify-between flex">
        <div>
          Roles
        </div>
        <div>
          User Management > Roles
        </div>
      </div>

      <!-- MAIN CONTENT - Roles Table -->
      <div class=" overflow-auto md:px-12">
        <table className=" table-auto w-full">
        <thead>
              <tr className="bg-gray-100">
                <th className="px-4 py-2">Display Name</th>
                <th className="px-4 py-2">Description</th>
                <th className="px-4 py-2">Created at</th>
              </tr>
          </thead>

          <tbody>
              <tr v-for="role in roles" :key="role.id">
                  <td className="border px-4 py-2">
                    <Link :href="route('role.edit', role)">
                      <div>
                        {{ role.name }}
                      </div>
                    </Link>
                  </td>

                  <td className="border px-4 py-2">
                    <Link :href="route('role.edit', role)">
                      <div>
                        {{ role.description }}
                      </div>
                    </Link>
                  </td>

                  <td className="border px-4 py-2">
                    <Link :href="route('role.edit', role)">
                      <div>
                        {{ convertDate(role.created_at) }}
                      </div>
                    </Link>
                  </td>
              </tr>
          </tbody>
        </table>
        
        <div class=" w-full mt-3 justify-end flex">
          <Link :href="route('role.create')">
            <button class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4">
              Add Role
            </button>
          </Link>
        </div>
      </div>
    </div>
 </auth-layout>
</template>