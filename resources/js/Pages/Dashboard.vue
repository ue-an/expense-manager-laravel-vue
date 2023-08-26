<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    categories: Object,
    sums: Object,
});

ChartJS.register(ArcElement, Tooltip, Legend)

// Extracting category names for chart label
const categoryNames = [];
for (let i = 0; i < props.categories.length; i++) {
    console.log(props.categories[i].name);
    categoryNames.push(props.categories[i].name);
}

// Pie Chart data and configuration
const chartData = {
    labels: categoryNames,
    datasets: [{
        backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16', '#eded15', '#5fdd16', '#15edd0', '#1581ed', '#1915ed', '#6f15ed', '#bb15ed', '#ed15d0', '#ed157d', '#a5ed15', '#edc515'],
        data: props.sums
    }]
};

const chartOptions = {
    responsive: true
};

const options = {
    responsive: true,
    maintainAspectRatio: false
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class=" py-6 space-y-12 px-12">
            <div class=" justify-between flex">
                <div>
                    My Expenses
                </div>
                <div>
                    Dashboard
                </div>
            </div>

            <div class=" grid-cols-2 grid">
                <!-- table data display -->
                <div class=" col-span-1 px-12">
                    <div class=" grid-cols-2 grid">
                        <Link>
                        <div>
                            <div class=" font-bold text-md">
                                Expense Categories
                            </div>
                            <div class=" bg-gray-800 h-[1px]">
                            </div>
                            <div class=" mr-2 px-2 my-1 border-black border-2" v-for="category in categories"
                                :key="category.id">
                                {{ category.name }}
                            </div>
                        </div>
                        </Link>

                        <div>
                            <div class=" font-bold text-md">
                                Total
                            </div>
                            <div class=" bg-gray-800 h-[1px]"></div>
                            <div class=" px-2 my-1 border-black border-2" v-for="sum in sums">
                                ₱{{ sum }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- visual daigrams display -->
                <div>
                    <div>
                        <Pie id="my-chart-id" :options="options" :data="chartData" />
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>
