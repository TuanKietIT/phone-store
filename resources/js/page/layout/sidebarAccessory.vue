<script setup>
  import axios from 'axios';
  import { reactive,ref, onMounted } from 'vue'


  const accessories = ref([]);
  const locations = ref([]);
  
  const getAccessory = () => {
    axios.get('/api/accessory')
    .then( response => {
        accessories.value = response.data;
    })
  };
  const getLocation = () => {
    axios.get('/api/location')
    .then( response => {
      locations.value = response.data;
    })
  };

  onMounted(() => {
    getAccessory();
    getLocation();
  })
</script>
<template>
     <div class="md:w-[250px] h-[800px] shadow-x-full mt-5 mx-3 my-3 px-5 py-5 ">
        <span class="text-[18px] font-medium text-sky-500 focus:outline-none ">Lọc theo Khu vực</span>
        <ul class="flex flex-col gap-y-4 py-3">
            <li v-for="itemLocation in locations" class="">
              <a  class="flex items-center is-bg-green-page-500 gap-x-1 text-gray-800 focus:outline-none">
                <span class="uppercase ">{{ itemLocation.name }}</span>
              </a>
            </li>
        </ul>
        <span class="text-[18px] font-medium text-sky-500 focus:outline-none ">Danh mục sản phẩm</span>
        <ul class="flex flex-col gap-y-4 py-3">
            <li v-for="item in accessories" class="">
              <a :href="item.url" class="flex items-center is-bg-green-page-500 gap-x-1 text-gray-800 focus:outline-none">
                <span class="uppercase ">{{ item.name }}</span>
              </a>
            </li>
        </ul>

        <span class="text-[18px] my-10 font-medium text-sky-500 focus:outline-none ">Lọc theo giá sản phẩm</span>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" name="" id="" class="mr-2">
              <span>Từ 3 - 5 triệu</span>
            </div>
        </div>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" name="" id="" class="mr-2">
              <span>Từ 5 - 8 triệu</span>
            </div>
        </div>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" name="" id="" class="mr-2">
              <span>Từ 8 - 10 triệu</span>
            </div>
        </div>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" name="" id="" class="mr-2">
              <span>Từ 10 - 15 triệu</span>
            </div>
        </div>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" name="" id="" class="mr-2">
              <span>Từ 15 - 20 triệu</span>
            </div>
        </div>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" name="" id="" class="mr-2">
              <span>Từ 20 - 25 triệu</span>
            </div>
        </div>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" name="" id="" class="mr-2">
              <span>Từ 25 - 30 triệu</span>
            </div>
        </div>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" name="" id="" class="mr-2">
              <span>Trên 30 triệu</span>
            </div>
        </div>
     </div>
     
</template>