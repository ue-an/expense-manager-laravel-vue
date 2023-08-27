<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';

defineProps({
  users: Object,
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
          Users
        </div>

        <div>
          User Management > Users
        </div>
      </div>

      <!-- MAIN CONTENT - Users Table -->
      <div class=" overflow-auto md:px-12">
        <table className=" table-auto w-full">
          <thead>
              <tr className="bg-gray-100">
                  <th className="px-4 py-2">Name</th>
                  <th className="px-4 py-2">Email Address</th>
                  <th className="px-4 py-2">Role</th>
                  <th className="px-4 py-2">Created at</th>
              </tr>
          </thead>

          <tbody>
              <tr v-for="user in users" :key="user.id">
                  <td className="border px-4 py-2">
                    <Link :href="route('user.edit', user)">
                      <div>
                        {{ user.name }}
                      </div>
                    </Link>
                  </td>

                  <td className="border px-4 py-2">
                    <Link :href="route('user.edit', user)">
                      <div>
                        {{ user.email }}
                      </div>
                    </Link>
                  </td>

                  <td className="border px-4 py-2">
                    <Link :href="route('user.edit', user)">
                      <div>
                        {{ user.roles[0].name }}
                      </div>
                    </Link>
                  </td>
                  
                  <td className="border px-4 py-2">
                    <Link :href="route('user.edit', user)">
                      <div>
                        {{ convertDate(user.created_at) }}
                      </div>
                    </Link>
                  </td>
              </tr>
          </tbody>
        </table>

        <!-- create button -->
        <div class=" w-full mt-3 justify-end flex">
          <Link :href="route('user.create')">
            <button class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4">
              Add User
            </button>
          </Link>
        </div>
      </div>
    </div>

  </auth-layout>
</template>


