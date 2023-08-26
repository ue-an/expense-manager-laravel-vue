<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
const isOpen = ref(false);

const toggle = () => {

   isOpen.value = !isOpen.value;
   console.log(isOpen.value);
}

</script>
<template lang="">
 
<button @click="toggle()" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
 <span class="sr-only">Open sidebar</span>
 <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
 </svg>
</button>

<aside id="default-sidebar" :class="{
 '-translate-x-full': !isOpen
}" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform sm:translate-x-0" aria-label="Sidebar">
 <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <ul class="space-y-2 font-medium">
         <li>
            <Link :href="route('profile.edit')">
               <div>
                  <div class=" items-center flex bg-gray-300 rounded-full w-16 h-16">
                     <div class=" m-auto">
                        {{$page.props.auth.user.name[0]}}
                     </div>
                  </div>
                  <div class=" mb-10 text-white">
                     {{$page.props.auth.user.name}}
                  </div>
               </div>
            </Link>
         </li>
         <li>
            <Link :href="route('dashboard')" :active="route().current('dashboard')" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <span class="ml-3">Dashboard</span>
            </Link>
         </li>
         <li :class="{' hidden' : $page.props.auth.user.role == 'admin'}">
            <Link :href="route('expense.index')" :active="route().current('expense.*')" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <span class="flex-1 ml-3 whitespace-nowrap">Expenses</span>
            </Link>
         </li>
         <!-- <div v-if="($page.props.auth.user.role === 'admin')"> -->
         <div>
            <li :class="{' hidden' : $page.props.auth.user.role != 'admin'}">
               <span class="flex-1 ml-3 whitespace-nowrap text-white">User Management</span>
            </li>
            <div class=" pl-6">
            <li :class="{' hidden' : $page.props.auth.user.roles[0].name != 'admin'}">
               <Link :href="route('role.index')" :active="route().current('role.*')" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <span class="flex-1 ml-3 whitespace-nowrap">Roles</span>
               </Link>
            </li>
            <li :class="{' hidden' : $page.props.auth.user.roles[0].name != 'admin'}">
               <Link :href="route('user.index')" :active="route().current('user.*')" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <span class="flex-1 ml-3 whitespace-nowrap">Users</span>
               </Link>
            </li>
            </div>
         </div>
         <li :class="{' hidden' : $page.props.auth.user.roles[0].name != 'admin'}">
            <span class="flex-1 ml-3 whitespace-nowrap text-white">Expense Management</span>
         </li>
         <div :class="{' hidden' : $page.props.auth.user.roles[0].name != 'admin'}" class=" pl-6">
            <li>
               <Link :href="route('category.index')" :active="route().current('category.*')" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <span class="flex-1 ml-3 whitespace-nowrap">Expense Categories</span>
               </Link>
            </li>
            <li>
               <Link :href="route('expense.index')" :active="route().current('expense.*')" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <span class="flex-1 ml-3 whitespace-nowrap">Expenses</span>
               </Link>
            </li>
         </div>

       <!-- <li>
         <Link :href="route('logout')" method="post" as="button" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <span class="flex-1 ml-3 whitespace-nowrap">Log Out</span>
         </Link>
       </li> -->
    </ul>
 </div>
</aside>

<div class="px-4 sm:ml-64">
 <div class=" border-gray-300 border-b-2 gap-3 items-center justify-end w-full flex">
   <div>
      Welcome to Expense Manager
   </div>
   <Link :href="route('logout')" method="post" as="button" class="flex items-center p-2 hover:opacity-25 text-gray-900 rounded-lg group">
      <span class="flex-1 ml-3 whitespace-nowrap">Log Out</span>
   </Link>
 </div>
 <slot></slot>
</div>

</template>
<style lang="">
 
</style>