<script setup>
  import axios from 'axios';
  import { reactive,ref, onMounted } from 'vue'



  const categories = ref([]);
  
  const getCategory = () => {
    axios.get('/api/category')
    .then( response => {
       categories.value = response.data;
    })
  };
  const laptops = ref([]);
  
  const getLaptop = () => {
    axios.get('/api/laptop')
    .then( response => {
        laptops.value = response.data;
    })
  };

  onMounted(() => {
    getCategory();
    getLaptop();
  })
</script>
<template>
     <div class="md:w-1/5 shadow-x-full mt-5 mr-3 px-5 py-5 h-[800px]">
         <span class="text-[18px] font-medium text-sky-500 focus:outline-none ">Danh mục sản phẩm</span>
         <ul class="flex flex-col gap-y-4 pt-3">
            <li v-for="item in categories" class="">
              <a :href="item.url" class="flex items-center is-bg-green-page-500 gap-x-1 text-gray-800 focus:outline-none">
                <span class="uppercase ">{{ item.title }}</span>
              </a>
            </li>
          </ul>
     </div>
</template>