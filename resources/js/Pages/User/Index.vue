<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';

defineProps({
 users: Object,
});

// const count = ref(0)

// function increment() {
//  count.value++
// }

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
          Users
        </div>
        <div>
          User Management > Users
        </div>
      </div>

      <div class=" px-12">
        <table className=" table-fixed w-full">
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
        <div class=" mt-3 justify-end flex">
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


