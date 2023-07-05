<script setup>
    import navbarVue from "../layout/navbar.vue";
    import sidebarVue from "../layout/sidebar.vue";
    import footerVue from "../layout/footer.vue";
    import pagination from 'laravel-vue-semantic-ui-pagination';

    import axios from 'axios';
    import { reactive,ref, onMounted } from 'vue'

    const iphone = ref([]);
    
    const formatPrice = (value) =>{
      let val = (value/1).toFixed(0).replace('.', ',');
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}

    const currentPage = ref(1);
    const getResults = (page) => {
      if (page === 'undefined') {
        page = 1;
      }

      // Using vue-resource as an example
      axios.get('/api/home/iphone?page=' + page)
        .then(response => {
          iphone.value = response.data;
        })
    };
    onMounted(() => {
      getResults();
    })
</script>

<template>
   <div class="container mx-auto p-5">
    <navbarVue />
    <div class="md:flex md:flex-row mt-5">
      <div class="sliderAx h-auto w-full">
            <div id="slider-1" class="container mx-auto">
              <div class="bg-cover bg-center  h-auto text-white py-24 px-10 object-fill" style="background-image: url(https://images.unsplash.com/photo-1544427920-c49ccfb85579?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1422&q=80)">
              </div> <!-- container -->
              <br>
            </div>
            <div id="slider-2" class="container mx-auto">
              <div class="bg-cover bg-top  h-auto text-white py-24 px-10 object-fill" style="background-image: url(https://images.unsplash.com/photo-1544144433-d50aff500b91?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80)">
              </div> <!-- container -->
              <br>
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
            <div class="flex items-center justify-center mt-10">
              <pagination class="" :data="iphone" v-bind:showDisabled="true" icon="chevron" v-on:change-page="getResults"></pagination>
            </div>
          </div>
          <div class="mx-3">
            <span class="text-[20px] text-sky-500 mt-10 font-medium uppercase">sam sung chính hãng</span>
            <hr class="px-2"/>
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
            <div class="flex items-center justify-center mt-10">
              <pagination class="" :data="iphone" v-bind:showDisabled="true" icon="chevron" v-on:change-page="getResults"></pagination>
            </div>
          </div>
          <div class="mx-3">
            <span class="text-[20px] text-sky-500 mt-10 font-medium uppercase">ipad chính hãng</span>
            <hr class="px-2"/>
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
            <div class="flex items-center justify-center mt-10">
              <pagination class="" :data="iphone" v-bind:showDisabled="true" icon="chevron" v-on:change-page="getResults"></pagination>
            </div>
          </div>
          <div class="mx-3">
            <span class="text-[20px] text-sky-500 mt-10 font-medium uppercase">Laptop chính hãng</span>
            <hr class="px-2"/>
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
            <div class="flex items-center justify-center mt-10">
              <pagination class="" :data="iphone" v-bind:showDisabled="true" icon="chevron" v-on:change-page="getResults"></pagination>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <footerVue />
  </div>
</template>