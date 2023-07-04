<script setup>
      import navbar from "../page/layout/navbar.vue";
      import sidebar from "../page/layout/sidebar.vue";
      import axios from 'axios';
      import { reactive,ref, onMounted } from 'vue'

    const product = ref([]);
  
    const getProduct = () => {
        axios.get('/api/category')
        .then( response => {
        product.value = response.data;
        })
    };
    onMounted(() => {
        getProduct();
    })
</script>

<template>
    <navbar />
    <main class="flex min-h-screen ju flex-1 flex-col  bg-gray-200 p-2" >
      <div class="flex gap-x-6 py-8">
        <sidebar/>
        <div class="flex w-3/5 flex-col gap-y-1">
          <div class="flex flex-col justify-between rounded-10 bg-gray-300 p-7">
            <div class=" backdrop-blue-sm flex justify-center items-center">
                <div class="w-[1000px]"> 
                    <div class="bg-white flex ">
                        <div class="flex justify-center">
                            <img src="../home/images/logo.PNG" class="w-[160px] h-[150px] " alt="">
                        </div>
                        <div class="flex flex-1 flex-col gap-y-2 px-2 pt-2">
                            <span>Điện thoại iphone 11</span>
                            <span>Giá: 2222</span>
                            <span>Số lượng: 2222</span>
                            <span>Nguời xem: 2222</span>
                        </div>
                        <button class=" px-5  bg-gray-400  mx-10 my-[60px] py-2  text-white rounded-full hover:bg-green-300">xem thêm</button>
                    </div>
                </div>
            </div>
            <div class=" backdrop-blue-sm flex justify-center items-center">
                <div class="w-[1000px] mt-5"> 
                    <div class="bg-white flex ">
                        <div class="flex justify-center">
                            <img src="../home/images/logo.PNG" class="w-[160px] h-[150px] " alt="">
                        </div>
                        <div class="flex flex-1 flex-col gap-y-2 px-2 pt-2">
                            <span>Điện thoại iphone 11</span>
                            <span>Giá: 2222</span>
                            <span>Số lượng: 2222</span>
                            <span>Nguời xem: 2222</span>
                        </div>
                        <button class=" px-5  bg-gray-400  mx-10 my-[60px] py-2  text-white rounded-full hover:bg-green-300">xem thêm</button>
                    </div>
                </div>
            </div>
            <div class=" backdrop-blue-sm flex justify-center items-center">
                <div class="w-[1000px] mt-5"> 
                    <div class="bg-white flex ">
                        <div class="flex justify-center">
                            <img src="../home/images/logo.PNG" class="w-[160px] h-[150px] " alt="">
                        </div>
                        <div class="flex flex-1 flex-col gap-y-2 px-2 pt-2">
                            <span>Điện thoại iphone 11</span>
                            <span>Giá: 2222</span>
                            <span>Số lượng: 2222</span>
                            <span>Nguời xem: 2222</span>
                        </div>
                        <button class=" px-5  bg-gray-400  mx-10 my-[60px] py-2  text-white rounded-full hover:bg-green-300">xem thêm</button>
                    </div>
                </div>
            </div>
            <div class=" backdrop-blue-sm flex justify-center items-center">
                <div class="w-[1000px] mt-5"> 
                    <div class="bg-white flex ">
                        <div class="flex justify-center">
                            <img src="../home/images/logo.PNG" class="w-[160px] h-[150px] " alt="">
                        </div>
                        <div class="flex flex-1 flex-col gap-y-2 px-2 pt-2">
                            <span class="text-[15px]">Điện thoại iphone 11</span>
                            <span class="text-[15px]">Giá: 2222</span>
                            <span class="text-[15px]">Số lượng: 2222</span>
                            <span class="text-[15px]">Nguời xem: 2222</span>
                            <span class="text-[15px]">Cập nhật: 2222</span>
                        </div>
                        <button class=" px-5  bg-gray-400  mx-10 my-[60px] py-2  text-white rounded-full hover:bg-green-300">xem thêm</button>
                    </div>
                </div>
            </div>
          </div>
          
        </div>
        <div class="flex w-1/5 flex-col gap-y-8">
          <div class="flex flex-1 flex-col justify-between rounded-10 bg-white p-7">
            <div>
                <h2 class="text-[20px] font-medium bg-white ml-2">Lọc theo khu vực</h2>
                <div class="flex flex-1 flex-col gap-y-2 px-2 pt-2 text-[14px]">
                    <div class="flex">
                      <input type="checkbox" name="" id="" class="mr-2">
                      <span>Từ 3 - 5 triệu</span>
                    </div>
                </div>
                <div class="flex flex-1 flex-col gap-y-2 px-2 pt-2 text-[14px]">
                    <div class="flex">
                      <input type="checkbox" name="" id="" class="mr-2">
                      <span>Từ 5 - 8 triệu</span>
                    </div>
                </div>
                <div class="flex flex-1 flex-col gap-y-2 px-2 pt-2 text-[14px]">
                    <div class="flex">
                      <input type="checkbox" name="" id="" class="mr-2">
                      <span>Từ 8 - 10 triệu</span>
                    </div>
                </div>
                <div class="flex flex-1 flex-col gap-y-2 px-2 pt-2 text-[14px]">
                    <div class="flex">
                      <input type="checkbox" name="" id="" class="mr-2">
                      <span>Từ 10 - 15 triệu</span>
                    </div>
                </div>
                <div class="flex flex-1 flex-col gap-y-2 px-2 pt-2 text-[14px]">
                    <div class="flex">
                      <input type="checkbox" name="" id="" class="mr-2">
                      <span>Từ 15 - 20 triệu</span>
                    </div>
                </div>
                <div class="flex flex-1 flex-col gap-y-2 px-2 pt-2 text-[14px]">
                    <div class="flex">
                      <input type="checkbox" name="" id="" class="mr-2">
                      <span>Từ 20 - 25 triệu</span>
                    </div>
                </div>
                <div class="flex flex-1 flex-col gap-y-2 px-2 pt-2 text-[14px]">
                    <div class="flex">
                      <input type="checkbox" name="" id="" class="mr-2">
                      <span>Từ 25 - 30 triệu</span>
                    </div>
                </div>
                <div class="flex flex-1 flex-col gap-y-2 px-2 pt-2 text-[14px]">
                    <div class="flex">
                      <input type="checkbox" name="" id="" class="mr-2">
                      <span>Trên 30 triệu</span>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </main>
</template>