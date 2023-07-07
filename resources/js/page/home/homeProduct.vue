<script setup>
    import navbarVue from "../layout/navbar.vue";
    import sidebarVue from "../layout/sidebar.vue";
    import footerVue from "../layout/footer.vue";
    import pagination from 'laravel-vue-semantic-ui-pagination';

    import axios from 'axios';
    import { reactive,ref, onMounted } from 'vue'
    import {useRoute,useRouter} from 'vue-router'

    const jobWiki = ref([]);
    const products = ref([]);
    const route = useRoute();
    const postId = route.params.id;
    const showImage1 = ref(true);
    const showImage2 = ref(false);
    const showImage3 = ref(false);
    const showImage4 = ref(false);
    
    const form = reactive({
      id: '',
      title: '',
      description: '',
      price:'',
      number: '',
      status: '',
      choose: 0,
      image1: '',
      image2: 'null',
      image3: 'null',
      image4: 'null',
      user_id:'',
      category_id: '',
      color: '',
      capacity: '',
      location_id:'',
      accessory_id:'',
      phone_id:'',
      laptop_id:'',
      itemAccessory:'',
      itemPhone:'',
      itemLaptop:''
      
  });
    const formatPrice = (value) =>{
      let val = (value/1).toFixed(0).replace('.', ',');
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}
    
    const Image1 = () => {
        showImage1.value = true;
        showImage2.value = false;
        showImage3.value = false;
        showImage4.value = false;
    }
    const Image2 = () => {
        showImage1.value = false;
        showImage2.value = true;
        showImage3.value = false;
        showImage4.value = false;
    }
    const Image3 = () => {
        showImage1.value = false;
        showImage2.value = false;
        showImage3.value = true;
        showImage4.value = false;
    }
    const Image4 = () => {
        showImage1.value = false;
        showImage2.value = false;
        showImage3.value = true;
        showImage4.value = false;
    }

    const getJobWiki = () => {
      axios.get('/api/home/jobwiki')
      .then(response => {
        jobWiki.value = response.data;
      })
    };
    const getProduct = () => {
        var show = '/api/product/' + postId
        axios.get(show).then(response =>{
            form.id = response.data.product.id;
            form.title = response.data.product.title;
            form.description = response.data.product.description;
            form.price = response.data.product.price;
            form.number = response.data.product.number;
            form.status = response.data.product.status;
            form.image1 = response.data.product.image1;
            form.image2 = response.data.product.image2;
            form.image3 = response.data.product.image3;
            form.image4 = response.data.product.image4;
            form.user_id = response.data.product.user.name;
            form.category_id= response.data.product.category.name;
            form.color = response.data.product.color;
            form.capacity = response.data.product.capacity;
            form.location_id = response.data.product.location.name;
            form.accessory_id = response.data.product.accessory.name;
            form.phone_id= response.data.product.phone.name;
            form.laptop_id= response.data.product.laptop.name;
            form.itemAccessory = response.data.product.accessory_id;
            form.itemPhone= response.data.product.phone_id;
            form.itemLaptop= response.data.product.laptop_id;
            console.log(response.data)
        })
        .catch(function (error){
            if(error.response){
                if (error.response.status == 404) {
                    alert(error.response.data.message);
                }
            }
        })
    }
    const getProductByID = () => {
      const show = '/api/home/product/suggest'
      axios.get(show)
      .then(response => {
          products.value = response.data
      })
    };
    const uploadProduct = (product) =>{
        const show = '/api/product/' + product.id
        axios.get(show).then(response =>{
            form.id = response.data.product.id;
            form.title = response.data.product.title;
            form.description = response.data.product.description;
            form.price = response.data.product.price;
            form.number = response.data.product.number;
            form.status = response.data.product.status;
            form.image1 = response.data.product.image1;
            form.image2 = response.data.product.image2;
            form.image3 = response.data.product.image3;
            form.image4 = response.data.product.image4;
            form.user_id = response.data.product.user.name;
            form.category_id= response.data.product.category.name;
            form.color = response.data.product.color;
            form.capacity = response.data.product.capacity;
            form.location_id = response.data.product.location.name;
            form.accessory_id = response.data.product.accessory.name;
            form.phone_id= response.data.product.phone.name;
            form.laptop_id= response.data.product.laptop.name;
            form.itemAccessory = response.data.product.accessory_id;
            form.itemPhone= response.data.product.phone_id;
            form.itemLaptop= response.data.product.laptop_id;
            console.log(response.data)
        })
        .catch(function (error){
            if(error.response){
                if (error.response.status == 404) {
                    alert(error.response.data.message);
                }
            }
        })
    }
    onMounted(() => {
      getJobWiki();
      getProduct();
      getProductByID();
    })
</script>

<template>
   <div class="container mx-auto p-5">
    <navbarVue />
    <hr class="mx-2 h-2 bg-cyan-300"/>
    <div class="flex  w-full font-sans">
        <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800">
            <div class=" py-4 mx-auto lg:py-2 md:px-6">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/2">
                        <div class="sticky top-0 z-50 overflow-hidden  px-2 ">
                            <div class="relative mb-6 lg:mb-10 lg:h-2/4 is-bg-green-500 ">
                                <img v-show="showImage1" v-bind:src="'/img/' + form.image1" alt="" class="object-cover w-[800px] h-[600px]">
                                <img v-show="showImage2" v-bind:src="'/img/' + form.image2" alt="" class="object-cover w-[800px] h-[600px]">
                                <img v-show="showImage3" v-bind:src="'/img/' + form.image3" alt="" class="object-cover w-[800px] h-[600px]">
                                <img v-show="showImage4" v-bind:src="'/img/' + form.image4" alt="" class="object-cover w-[800px] h-[600px]">
                            </div>
                            <div class="flex-wrap hidden md:flex ">
                                <div class="w-1/2 p-2 sm:w-1/4">
                                    <a href="#" @click="Image1" class="block border border-blue-300 dark:border-transparent dark:hover:border-blue-300 hover:border-blue-300">
                                        <img v-bind:src="'/img/' + form.image1" alt="" class="object-cover w-full lg:h-20">
                                    </a>
                                </div>
                                <div class="w-1/2 p-2 sm:w-1/4">
                                    <a href="#" v-if="form.image2 != null" @click="Image2" class="block border border-transparent dark:border-transparent dark:hover:border-blue-300 hover:border-blue-300">
                                        <img v-bind:src="'/img/' + form.image2" alt="" class="object-cover w-full lg:h-20">
                                    </a>
                                </div>
                                <div class="w-1/2 p-2 sm:w-1/4">
                                    <a href="#" v-if="form.image3 != null" @click="Image3" class="block border border-transparent dark:border-transparent dark:hover:border-blue-300 hover:border-blue-300">
                                        <img v-bind:src="'/img/' + form.image3" alt="" class="object-cover w-full lg:h-20">
                                    </a>
                                </div>
                                <div class="w-1/2 p-2 sm:w-1/4">
                                    <a href="#" v-if="form.image4 != null" @click="Image4"
                                        class="block border border-transparent dark:border-transparent dark:hover:border-blue-300 hover:border-blue-300">
                                        <img v-bind:src="'/img/' + form.image4" alt="" class="object-cover w-full lg:h-20">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="w-full px-4  md:w-2/4 is-bg-green-500 ">
                        <div class="lg:pl-10">
                            <div class="mb-2 ">
                                <h2 class="max-w-xl mt-2 mb-2 text-xl font-bold dark:text-gray-400 md:text-xl">{{ form.title }}</h2>
                                <div class="flex items-center mb-3">
                                    <ul class="flex mr-2">
                                        <li>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor"
                                                    class="w-4 mr-1 dark:text-gray-400 bg-yellow-200 bi bi-star "
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor"
                                                    class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor"
                                                    class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor"
                                                    class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                    <p class="text-xs dark:text-gray-400 ">(2 customer reviews)</p>
                                </div>                                <p v-if="form.itemAccessory != 0" class="text-[16px] ml-5 font-medium text-rose-500 dark:text-rose-200">Hãng: {{ form.accessory_id }}</p>
                                <span v-if="form.itemPhone !=  0" class="text-[16px] ml-5 font-medium text-rose-500 dark:text-rose-200">Hãng: {{ form.phone_id }}</span>
                                <p  v-if="form.itemLaptop != 0" class="text-[16px] ml-5 font-medium text-rose-500 dark:text-rose-200">Hãng: {{ form.laptop_id }}</p>
                                <p class="max-w-md mb-3  mt-3 text-gray-700 dark:text-gray-400" v-html="form.description"></p>
                                <p class="inline-block mb-2 text-xl font-bold text-red-700 dark:text-gray-400 ">
                                    <span>Giá: {{ formatPrice( form.price) }} VND</span>
                                </p>
                                <p class="text-green-600  mb-2 dark:text-green-300 ">Dung lượng: {{ form.capacity }}</p>
                                <p class="text-gray-600  mb-2 dark:text-gray-300 ">Trạng thái: {{ form.status }}</p>
                                <p class="text-gray-600  mb-2 dark:text-gray-300 ">Màu sắc: {{ form.color }}</p>
                                <p class="text-gray-600  mb-2 dark:text-gray-300 ">Khu vực: {{ form.location_id }}</p>
                            </div>
                            <div class="w-32 mb-8 ">
                                <label for=""
                                    class="w-full text-xl font-semibold text-gray-700 dark:text-gray-400">Quantity</label>
                                <div class="relative flex flex-row w-full h-10 mt-4 bg-transparent rounded-lg">
                                    <button
                                        class="w-20 h-full text-gray-600 bg-gray-300 rounded-l outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-400">
                                        <span class="m-auto text-2xl font-thin">-</span>
                                    </button>
                                    <input type="number" v-model="form.number"
                                        class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-300 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black"
                                        placeholder="1">
                                    <button
                                        class="w-20 h-full text-gray-600 bg-gray-300 rounded-r outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-400">
                                        <span class="m-auto text-2xl font-thin">+</span>
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center -mx-4 mb-5 ">
                                <div class="w-full px-4 mb-4 lg:w-1/2 lg:mb-0">
                                    <button class="flex items-center justify-center p-2 text-green-500 border border-green-500 rounded-md dark:text-gray-200 dark:border-green-600 hover:bg-green-600 hover:border-green-600 hover:text-gray-100 dark:bg-green-600 dark:hover:bg-green-700 dark:hover:border-blue-700 dark:hover:text-gray-300">
                                        Thêm vào giỏ hàng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <hr class="h-2 bg-cyan-300"/>
    <div class="flex text-center items-center justify-center">
        <span class="text-[20px] text-sky-500 uppercase">Sản phẩm được gợi ý</span>
    </div>
    <hr class="h-2 bg-cyan-300"/>
    <div class="flex w-full font-sans">
      <div class="">
        <div class="mt-5 shadow-x-full px-10 py-5">
          <div class="grid grid-flow-row grid-cols-1 md:grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 xl:grid-cols-4 gap-10">
            <div v-for="product in products.data" :key="product.id" class="my-5 ml-2 rounded-lg shadow-product-is">
              <a href="#" class="flex flex-row justify-center ">
                <img v-bind:src="'/img/' + product.image1" class="rounded-tl-lg my-2 mx-3 h-[180px] w-[200px] rounded-tr-lg" />
              </a>
              <div class="p-5">
                <h3><a href="#" class=" flex flex-row justify-center text-center">{{ product.title }}</a></h3>
                <div class="flex flex-row justify-center text-center my-1">
                  <span>Giá: {{ formatPrice(product.price) }} VND </span>
                </div>
                <div class="flex flex-col justify-between items-center">
                    <a @click="uploadProduct(product)" class=" bg-gray-200 rounded-full py-2 px-8 my-1 text-sm text-gray-700 hover:bg-green-300 hover:text-white flex flex-row justify-center" href="#">
                        Xem thêm
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