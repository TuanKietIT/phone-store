<script setup>
    import navbarVue from "../layout/navbar.vue";
    import sidebarVue from "../layout/sidebar.vue";
    import footerVue from "../layout/footer.vue";
    import pagination from 'laravel-vue-semantic-ui-pagination';

    import axios from 'axios';
    import { reactive,ref, onMounted } from 'vue'

    const iphone = ref([]);
    const samsung = ref([]);
    const laptop = ref([]);
    const ipad = ref([]);
    const formatPrice = (value) =>{
      let val = (value/1).toFixed(0).replace('.', ',');
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}

    const currentPage = ref(1);
    const getResults = () => {
      axios.get('/api/home/iphone')
        .then(response => {
          iphone.value = response.data;
        })
    };
    const getSamSung = () => {
      axios.get('/api/home/samsung')
      .then(response => {
        samsung.value = response.data;
      })
    };
    const getIpad = () => {
      axios.get('/api/home/ipad')
      .then(response => {
        ipad.value = response.data;
      })
    };
    const getLaptop = () => {
      axios.get('/api/home/laptop')
      .then(response => {
        laptop.value = response.data;
      })
    };
    onMounted(() => {
      getResults();
      getSamSung();
      getLaptop();
      getIpad();
    })
</script>

<template>
   <div class="container mx-auto p-5">
    <navbarVue />
    <div class="md:flex md:flex-row mt-5">
       <div class="gallery-display-area">
        <div class="gallery-wrap">
           <div class="image">
               <img class="w-[1240px] h-[280px]" src="../images/background3.jpg" alt="">
           </div>
        </div>
       </div>
    </div>
    <div class="flex  w-full font-sans">
      <div class="">
        <div class="mt-5 shadow-x-full px-10 py-5">
          <div class="mx-3">
            <span class="text-[20px] text-sky-500 mt-10 font-medium uppercase">iphone chính hãng</span>
          </div>
          <div class="grid grid-flow-row grid-cols-1 md:grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 xl:grid-cols-4 gap-10">
            <div v-for="product in iphone.data" :key="product.id" class="my-5 ml-2 rounded-lg shadow-product-is">
              <a href="#" class="flex flex-row justify-center ">
                <img v-bind:src="'/img/' + product.image1" class="rounded-tl-lg my-2 mx-3 h-[180px] w-[200px] rounded-tr-lg" />
              </a>
              <div class="p-5">
                <h3><a href="#" class=" flex flex-row justify-center text-center">{{ product.title }}</a></h3>
                <div class="flex flex-row justify-center text-center my-1">
                  <span>Giá: {{ formatPrice(product.price) }} VND </span>
                </div>
                <div class="flex flex-col justify-between items-center">
                  <a class=" bg-gray-200 rounded-full py-2 px-8 my-1 text-sm text-gray-700 hover:bg-green-300 hover:text-white flex flex-row justify-center" href="#">
                    <router-link  :to="{ path: '/home/product/'+ product.id}" class="btn-see" >
                        Xem thêm
                    </router-link>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="mx-3">
            <span class="text-[20px] text-sky-500 mt-10 font-medium uppercase">sam sung chính hãng</span>
            <hr class="px-2"/>
          </div>
          <div class="grid grid-flow-row grid-cols-1 md:grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 xl:grid-cols-4 gap-10">
            <div v-for="item in samsung.data" :key="item.id" class="my-5 ml-2 rounded-lg shadow-product-is">
              <a href="#" class="flex flex-row justify-center ">
                <img v-bind:src="'/img/' + item.image1" class="rounded-tl-lg my-2 mx-3 h-[180px] w-[200px] rounded-tr-lg" />
              </a>
              <div class="p-5">
                <h3><a href="#" class=" flex flex-row justify-center text-center">{{ item.title }}</a></h3>
                <div class="flex flex-row justify-center text-center my-1">
                  <span>Giá: {{ formatPrice(item.price) }} VND </span>
                </div>
                <div class="flex flex-col justify-between items-center">
                  <a class=" bg-gray-200 rounded-full py-2 px-8 my-1 text-sm text-gray-700 hover:bg-green-300 hover:text-white flex flex-row justify-center" href="#">
                    <router-link  :to="{ path: '/home/product/'+ item.id}" class="btn-see" >
                        Xem thêm
                    </router-link>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="mx-3">
            <span class="text-[20px] text-sky-500 mt-10 font-medium uppercase">ipad chính hãng</span>
            <hr class="px-2"/>
          </div>
          <div class="grid grid-flow-row grid-cols-1 md:grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 xl:grid-cols-4 gap-10">
            <div v-for="itemIpad in ipad.data" :key="itemIpad.id" class="my-5 ml-2 rounded-lg shadow-product-is">
              <a href="#" class="flex flex-row justify-center ">
                <img v-bind:src="'/img/' + itemIpad.image1" class="rounded-tl-lg my-2 mx-3 h-[180px] w-[200px] rounded-tr-lg" />
              </a>
              <div class="p-5">
                <h3><a href="#" class=" flex flex-row justify-center text-center">{{ itemIpad.title }}</a></h3>
                <div class="flex flex-row justify-center text-center my-1">
                  <span>Giá: {{ formatPrice(itemIpad.price) }} VND </span>
                </div>
                <div class="flex flex-col justify-between items-center">
                  <a class=" bg-gray-200 rounded-full py-2 px-8 my-1 text-sm text-gray-700 hover:bg-green-300 hover:text-white flex flex-row justify-center" href="#">
                    <router-link  :to="{ path: '/home/itemIpad/'+ itemIpad.id}" class="btn-see" >
                        Xem thêm
                    </router-link>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="mx-3">
            <span class="text-[20px] text-sky-500 mt-10 font-medium uppercase">Laptop chính hãng</span>
            <hr class="px-2"/>
          </div>
          <div class="grid grid-flow-row grid-cols-1 md:grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 xl:grid-cols-4 gap-10">
            <div v-for="itemLaptop in laptop.data" :key="itemLaptop.id" class="my-5 ml-2 rounded-lg shadow-product-is">
              <a href="#" class="flex flex-row justify-center ">
                <img v-bind:src="'/img/' + itemLaptop.image1" class="rounded-tl-lg my-2 mx-3 h-[180px] w-[200px] rounded-tr-lg" />
              </a>
              <div class="p-5">
                <h3><a href="#" class=" flex flex-row justify-center text-center">{{ itemLaptop.title }}</a></h3>
                <div class="flex flex-row justify-center text-center my-1">
                  <span>Giá: {{ formatPrice(itemLaptop.price) }} VND </span>
                </div>
                <div class="flex flex-col justify-between items-center">
                  <a class=" bg-gray-200 rounded-full py-2 px-8 my-1 text-sm text-gray-700 hover:bg-green-300 hover:text-white flex flex-row justify-center" href="#">
                    <router-link  :to="{ path: '/home/itemLaptop/'+ itemLaptop.id}" class="btn-see" >
                        Xem thêm
                    </router-link>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <footerVue />
  </div>
</template>