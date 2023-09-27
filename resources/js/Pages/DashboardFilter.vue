<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Head, Link, useForm } from '@inertiajs/vue3';
import VueDatePicker from '../../../node_modules/@vuepic/vue-datepicker';
import { ref, onMounted, nextTick } from 'vue';

const props = defineProps({
 categories: Object,
 sums: Object,
 allExpenses: Object,
 startDate: Object,
 endDate: Object,
});

// Extracting category names for chart label
let categoryNames = [];
for (let i = 0; i < props.categories.length; i++) {
 console.log(props.categories[i].name);
 categoryNames.push(props.categories[i].name);
}

const backgroundColors = ['#41B883', '#E46651', '#00D8FF', '#DD1B16', '#eded15', '#5fdd16', '#15edd0', '#1581ed', '#1915ed', '#6f15ed', '#bb15ed', '#ed15d0', '#ed157d', '#a5ed15', '#edc515'];


// Pie Chart data and configuration
ChartJS.register(ArcElement, Tooltip, Legend)

let chartData = ref({
 labels: [],
 datasets: [
  {
   backgroundColor: [],
   data: [],
  }
 ]
});

const refChartData = () => {
 let initChartData = {
  labels: categoryNames,
  datasets: [{
   backgroundColor: backgroundColors,
   data: props.sums
  }]
 };
 chartData.value = initChartData;
}

const options = {
 responsive: true,
 maintainAspectRatio: false
}

const form = useForm({
 startDate: '',
 endDate: '',
})

refChartData();

const renderComponent = ref(true);
const initSums = ref(true);

</script>

<template>
 <Head title="Dashboard" />

 <AuthLayout>
  <template #header>
   <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
  </template>

  <div class=" md:py-6 md:space-y-12 md:px-12">
   <div class=" justify-between flex">
    <div>
     My Expenses
    </div>
    <div>
     Dashboard
    </div>
   </div>

   <div class=" grid-cols-1 md:grid-cols-2 grid">
    <!-- table data display -->
    <div class=" order-last md:order-first col-span-1 px-12">
     <div class=" grid-cols-2 grid">
      <Link>
      <div>
       <div class=" font-bold text-md">
        Categories
       </div>
       <div class=" bg-gray-800 h-[1px]">
       </div>
       <div class=" mr-2 px-2 my-1 border-black border-2" v-for="category in categories" :key="category.id">
        {{ category.name }}
       </div>
      </div>
      </Link>

      <div>
       <div class=" font-bold text-md">
        Total
       </div>
       <div class=" bg-gray-800 h-[1px]"></div>
       <div v-if="initSums" class=" px-2 my-1 border-black border-2" v-for="sum in props.sums">
        ₱{{ sum }}
       </div>
       <div v-if="!initSums" class=" px-2 my-1 border-black border-2" v-for="sum in props.sums">
        ₱{{ sum }}
       </div>
      </div>
     </div>
    </div>

    <!-- visual daigrams display -->
    <div>
     <div class=" flex">
      <div class=" flex-col flex">
       <div class=" gap-2 items-center flex">
        <label for="email">Start Date</label>
        <div class="w-[calc(100%-42%)]">
         <VueDatePicker disabled="" v-model="props.startDate"></VueDatePicker>
        </div>
       </div>
       <div class=" items-center justify-end flex text-red-600" v-if="form.errors.startDate">
        {{ form.errors.startDate }}
       </div>
      </div>

      <div class=" flex-col flex">
       <div class=" gap-2 items-center flex">
        <label for="email">End Date</label>
        <div class="w-[calc(100%-42%)]">
         <VueDatePicker disabled v-model="props.endDate"></VueDatePicker>
        </div>
       </div>
       <div class=" items-center justify-end flex text-red-600" v-if="form.errors.endDate">
        {{ form.errors.endDate }}
       </div>
      </div>

      <div>
       <Link :href="route('dashboard')"
        class=" py-1 px-2 border-black border-2 hover:border-b-4 hover:border-r-4 hover:h-[34px]">
       Clear
       </Link>
      </div>

     </div>
     <!-- <div>{{ num }}</div> -->
     <div v-if="renderComponent">
      <Pie id="expense-chart" :options="options" :data="chartData" />
     </div>
    </div>
   </div>
  </div>
 </AuthLayout>
</template>
