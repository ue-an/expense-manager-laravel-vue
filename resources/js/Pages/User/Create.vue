<script setup>
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue'

const props = defineProps({
  roles: Object,
});

// Form ref/object
const form = useForm({
  name: "",
  email: "",
  password: "password",
  role: "",
});

// Function/s
const submitAdd = () => {
  form.post(route('user.store'));
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
              <div class=" text-lg leading-6 font-medium text-gray-900">Add User</div>
            </div>
            
            <!-- FORM -->
            <div class=" w-full mt-2 py-3">
              <form name="createForm" @submit.prevent="submitAdd" class=" space-y-3">
                <!-- name -->
                <div class=" flex-col flex">
                  <div class=" items-center justify-between flex">
                    <label for="name">Name</label>
                    <input 
                    id="name"
                    v-model="form.name"
                    type="text"
                    name="name"
                    placeholder="Name"
                    />
                  </div>
                  <div class=" items-center justify-end flex text-red-600" v-if="form.errors.name">
                  {{ form.errors.name }}
                  </div>
                </div>

                <!-- email -->
                <div class=" flex-col flex">
                  <div class=" items-center justify-between flex">
                    <label for="email">Email Address</label>
                    <input 
                      id="email"
                      v-model="form.email"
                      type="text"
                      name="email"
                      placeholder="Email Address"
                    />
                  </div>
                  <div class=" items-center justify-end flex text-red-600" v-if="form.errors.email">
                    {{ form.errors.email }}
                  </div>
                </div>
                
                <!-- role -->
                <div class=" flex-col flex">
                  <div class=" items-center justify-between flex">
                    <div class=" items-center flex">
                      <div>Role</div>
                      <div class=" flex">
                        <input hidden class=" w-[calc(100%/2)]" id="role" name="role" v-model="form.role" type="text">
                        <input hidden class=" w-[calc(100%/2)]" id="password" name="password" v-model="form.password" type="text">
                      </div>
                    </div>
                  
                    <div>
                      <select v-model="form.role" @change="form.role" class=" border-black border-2">
                        <option v-for="role in roles" :key="role.id">
                          {{ role.name }}
                        </option>
                      </select>
                    </div>
                  </div>

                  <div class=" items-center justify-end flex text-red-600" v-if="form.errors.role">
                    {{ form.errors.role }}
                  </div>
                </div>

                <!-- buttons -->
                <div class=" gap-3 justify-end flex py-3">
                  <div class=" gap-3 flex">
                    <Link :href="route('user.index')">
                      <button id="ok-btn" class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4 hover:h-[34px]">
                        Cancel
                      </button>
                    </Link>

                    <button type="submit" id="ok-btn" class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4 hover:h-[34px]">
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

