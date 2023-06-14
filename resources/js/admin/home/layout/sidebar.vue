<script setup>
  import DashboardIcon from "../icons/dashboard.svg";
  import axios from 'axios';
  import { reactive,ref, onMounted } from 'vue'



  const menus = ref([]);
  
  const getMenu = () => {
    axios.get('/api/menu')
    .then( response => {
       menus.value = response.data;
    })
  };

  onMounted(() => {
     getMenu();
  })
</script>
<template>
     <aside class="flex w-64 flex-col px-4 pt-5 pb-6 bg-white">
      <a href="#" class="flex items-center gap-x-4 px-8 text-xl font-medium text-sky-500 focus:outline-none">
        <DashboardIcon class="h-6 w-6 stroke-current" />
        <span>Admin</span>
      </a>
      <ul class="flex flex-1 flex-col gap-y-5 px-5 pt-5">
        <li v-for="item in menus" class="px-1 py-1 is-bg-gray-500 ">
          <a :href="item.url" class="flex items-center gap-x-1 text-gray-800 hover:font-medium hover:text-sky-300 focus:font-medium focus:text-sky-300 focus:outline-none">
            <Component :is="item.icon" class="h-6 w-6 stroke-current" />
            <span>{{ item.name }}</span>
          </a>
        </li>
      </ul>
    </aside>
</template>