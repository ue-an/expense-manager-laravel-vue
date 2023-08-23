<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
  user: Object,
  roles: Object,
});

// Form ref/object
const form = useForm({
  id: props.user.id,
  name: props.user.name,
  email: props.user.email,
  role: props.user.roles[0].name,
});

let updatedUser = ref({
  "id": form.id,
  "email": form.email,
  "name": form.name,
  "role": form.role,
})

// Function/s
const destroy = (id) => {
  if (confirm("Are you sure you want to Delete")) {
    form.delete(route('user.destroy', id));
  }
}

const submitSave = (updatedUser) => {
  form.put(route('user.update', updatedUser));
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
  </div>

  <!-- Modal -->
  <div id="modal" class=" fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class=" relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
      <div class="text-center">
        <div fill="none" class=" mx-auto flex-col flex items-center justify-center">
          <div class=" w-full flex">
            <div class=" text-lg leading-6 font-medium text-gray-900">Update User</div>
          </div>

          <div class=" h-[1px] bg-black w-full"></div>

          <!-- FORM -->
          <div class=" w-full mt-2 py-3">
            <form @submit.prevent="submitSave" class=" space-y-3">
              <!-- name -->
              <div>
                <div class=" items-center justify-between flex">
                  <label for="name">Name</label>
                  <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    name="name"
                    class=""
                    placeholder=""
                  />
                </div>

                <div class=" items-center justify-end flex text-red-600" v-if="form.errors.name">
                  {{ form.errors.name }}
                </div>
              </div>

              <!-- email -->
              <div>
                <div class=" items-center justify-between flex">
                  <label for="email">Email Address</label>
                  <input
                    type="text"
                    id="email"
                    v-model="form.email"
                    name="email"
                    class=""
                    placeholder=""
                  />
                </div>

                <div class=" items-center justify-end flex text-red-600" v-if="form.errors.email">
                  {{ form.errors.email }}
                </div>
              </div>

              <!-- role -->
              <div class=" items-center justify-between flex">
                <div class="flex">
                  <div>Role</div>
                  <input hidden id="role" name="role" type="text" v-model="form.role">
                </div>

                <select v-model="form.role" @change="form.role" class="  border-black border-2">
                  <option v-for="role in roles" :key="role.id">
                    {{ role.name }}
                  </option>
                </select>
              </div>
              
              <!-- buttons -->
              <div class=" gap-3 justify-between flex py-3">
                <button @click="destroy(form.id)" id="ok-btn" class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4 hover:h-[34px]">
                  Delete
                </button>

                <div class=" gap-3 flex">
                  <Link :href="route('user.index')">
                    <button id="ok-btn" class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4 hover:h-[34px]">
                      Cancel
                    </button>
                  </Link>

                  <button type="submit" @click="submitSave(updatedUser)" id="ok-btn" class="py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4 hover:h-[34px]">
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

