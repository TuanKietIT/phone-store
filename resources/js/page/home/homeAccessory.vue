<script setup>
      import navbar from "../layout/navbar.vue";
      import sidebar from "../layout/sidebar.vue";
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
    <hr class="mx-2 h-2 bg-cyan-300"/>
    <main class="flex min-h-screen ju flex-1 flex-col p-2" >
      <div class="flex gap-x-6 py-8">
        <sidebar/>
        <div class="flex w-3/5 flex-col gap-y-1">
            <div class="mt-5 shadow-x-full px-10 py-5">
                <div class="grid grid-flow-row grid-cols-1 md:grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 xl:grid-cols-3 gap-10">
                    <div  class="my-5 ml-2 rounded-lg shadow-product-is">
                        <a href="#" class="flex flex-row justify-center ">
                            <img v-bind:src="'/img/' " class="rounded-tl-lg my-2 mx-3 h-[180px] w-[180px] rounded-tr-lg" />
                        </a>
                        <div class="p-5">
                            <h3><a href="#" class=" flex flex-row justify-center text-center">name</a></h3>
                            <div class="flex flex-row justify-center text-center my-1">
                            <span>Giá: VND </span>
                            </div>
                            <div class="flex flex-col justify-between items-center">
                            <a class=" bg-gray-200 rounded-full py-2 px-8 my-1 text-sm text-gray-700 hover:bg-green-300 hover:text-white flex flex-row justify-center" href="#">
                                <router-link  :to="{ path: '/home/product/'}" class="btn-see" >
                                    Xem thêm
                                </router-link>
                            </a>
                            </div>
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