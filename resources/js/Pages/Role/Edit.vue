<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import VueDatePicker from '../../../../node_modules/@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const props = defineProps({
  role: {
    type: Object,
    default: () => ({}),
  },
});

// Form ref/object
const form = useForm({
  id: props.role.id,
  name: props.role.name,
  description: props.role.description,
});

let updatedRole = ref({
  "id": form.id,
  "name": form.name,
  "description": form.description,
});

// Function/s
const submitSave = (updatedRole) => {
  form.put(route('role.update', updatedRole));
}

const destroy = (id) => {
  if (confirm("Are you sure you want to delete this record?")) {
    form.delete(route('role.destroy', id));
  }
}
</script>

<template lang="">
 <auth-layout>
  <div class=" py-6 space-y-12 px-12">
   <div class=" justify-between flex">
    <div>
     Roles
    </div>
    <div>
     User Management > Roles
    </div>
   </div>
  </div>

  <!-- Modal -->
  <div id="modal" class=" fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
   <div class=" relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
    <div class="text-center">
     <div fill="none" class=" mx-auto flex-col flex items-center justify-center">
      <div class=" w-full flex">
       <div class=" text-lg leading-6 font-medium text-gray-900">Edit Role</div>
      </div>

      <div class=" h-[1px] bg-black w-full"></div>
      
      <!-- FORM -->
      <div class=" w-full mt-2 py-3">
       <form name="createForm" @submit.prevent="submitSave" class=" space-y-3">
        <!-- name -->
        <div class=" flex-col flex">
          <div class=" items-center justify-between flex">
           <div class=" items-center flex">
            <div>Display Name</div>
           </div>
           <input :class="{' hidden' : form.name == 'admin'}" class=" w-[calc(100%/3)]" id="name" name="name" v-model="form.name" type="text">
           <input disabled :class="{' hidden' :form.name != 'admin' }" class=" border-gray-300 border-spacing-2 text-gray-400 w-[calc(100%/3)]" id="name" name="name" v-model="form.name" type="text">
          </div>
          <div class=" items-center justify-end flex text-red-600" v-if="form.errors.name">
            {{ form.errors.name }}
          </div>
        </div>

        <!-- description -->
        <div class=" flex-col flex">
          <div class=" items-center justify-between flex">
            <label for="description">Description</label>
            <textarea 
             id="description"
             v-model="form.description"
             name="description"
             rows="3"
             :class="{' hidden' : form.name == 'admin'}"
            ></textarea>
            <textarea 
             id="description"
             v-model="form.description"
             name="description"
             rows="3"
             disabled
             :class="{'hidden' : form.name != 'admin'}"
             class=" border-2 border-gray-300 text-gray-400"
            ></textarea>
          </div>
          <div class=" items-center justify-end flex text-red-600" v-if="form.errors.description">
           {{ form.errors.description }}
          </div>
        </div>

        <!-- buttons -->
        <div class=" gap-3 justify-between flex py-3">
          <div :class="{' justify-end flex' : form.name == 'admin'}"></div>
         <button @click="destroy(form.id)" :class="{'hidden' : form.name == 'admin'}" class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4 hover:h-[34px]">
          Delete
         </button>
         
         <div class=" gap-3 flex">
           <Link :href="route('role.index')">
            <button id="ok-btn" class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4 hover:h-[34px]">
             Cancel
            </button>
           </Link>

           <button type="submit" @click="submitSave(updatedRole)" id="ok-btn" class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4 hover:h-[34px]">
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