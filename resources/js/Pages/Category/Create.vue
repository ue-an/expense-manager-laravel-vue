<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { CalendarIcon } from '@heroicons/vue/24/solid';
import VueDatePicker from '../../../../node_modules/@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const props = defineProps({
  user: Object,
});

const modal = ref(0);

const form = useForm({
  name: '',
  description: '',
  user_id: props.user.id,
});

function showModal() {
  let modal = document.getElementById('modal');
  modal.style.display = 'block';
}

function hideModal() {
  let modal = document.getElementById('modal');
  modal.style.display = 'none';
}

const submitAdd = () => {
  form.post(route('category.store'));
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
  </div>

  <!-- Modal -->
  <div id="modal" class=" fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
   <div class=" relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
    <div class="text-center">
     <div fill="none" class=" mx-auto flex-col flex items-center justify-center">
      <div class=" w-full flex">
       <div class=" text-lg leading-6 font-medium text-gray-900">Add Category</div>
      </div>
      
      <div class=" w-full mt-2 py-3">
       <form name="createForm" @submit.prevent="submitAdd" class=" space-y-3">
        <div class=" flex-col flex">
          <div class=" items-center justify-between flex">
            <div>Display Name</div>
            <input class=" w-[calc(100%/3)]"
             id="name"
             name="name"
             v-model="form.name"
             type="text"
             placeholder="Name"
            >
          </div>
          <div class=" items-center justify-end flex text-red-600" v-if="form.errors.name">
            {{ form.errors.name }}
          </div>
        </div>

        <div class=" flex-col flex">
          <div class=" items-center justify-between flex">
            <label for="description">Description</label>
            <input 
             id="description"
             v-model="form.description"
             type="text"
             name="description"
             placeholder="Description"
            />
          </div>
          <div class=" items-center justify-end flex text-red-600" v-if="form.errors.description">
           {{ form.errors.description }}
          </div>
        </div>

        <div class=" gap-3 justify-end flex py-3">
         <div class=" gap-3 flex">
            <input
              hidden
              type="text"
              id="user_id"
              name="user_id"
              v-model="form.user_id"
            />
           <Link :href="route('category.index')">
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