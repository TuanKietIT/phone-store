<script setup>
import axios from 'axios';
  import { reactive,ref, onMounted } from 'vue'


  const pages = ref([]);

  const showLogin = ref(true);
  const showInfo = ref(false);
  const showLogout = ref(false);
  const showBar = ref(false);
  const form = reactive({
    name: '',
    image: ''
  });
  
  const token = localStorage.getItem('token');

  const getInfoUser = () =>{
    axios.get('/api/user',{
        headers:{
            Authorization: ' Bearer ' + token
        }
    })
    .then(response => {
        form.name = response.data[0].name;
        form.image = response.data[0].image;
        showLogout.value = true;
        showLogin.value = false;
        showInfo.value = true;
    })
  }

  const getPage = () => {
    axios.get('/api/page')
    .then( response => {
       pages.value = response.data;
    })
  };

  const logout = () => {
    localStorage.removeItem('token');
    getPage();
    showLogout.value = false;
  };

  onMounted(() => {
     getPage();
     getInfoUser();
  })
</script>
<template>
    <ul class="flex items-center justify-between bg-gray-100">
        <div class="flex w-1/5">
             <div class=" flex">
                  <span class="text-[18px] mx-5">Cửa hàng Etown</span>
             </div>
        </div>
        <div class="flex w-2/5">
             <div class="flex">
                 <form  class="flex" >
                    <input type="text" class="outline-0 px-5  w-[350px] py-1 bg-gray-100 input-bg-gray-500 mx-5"  placeholder="Enter title"/>
                    <button type="button" class="bg-sky-300 px-1 text-white">Tim kiếm</button>
                  </form>
             </div>
        </div>
        <li>
          <a href="#" class="bg-orange-300 text-gray-50 hover:bg-green-400 mx-5 p-2 px-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Cart (0)
          </a>
        </li>
        <li v-show="showLogin" class="px-1 py-1  my-5 flex  mx-5">
          <a  class="flex items-center text-gray-800 hover:font-medium hover:text-sky-300 focus:font-medium focus:text-sky-300 focus:outline-none">
            <butt>Đăng nhập</butt>
          </a>
        </li>
        <li v-show="showInfo" class="px-1 py-1 my-2 flex  mx-1">
          <a  class="flex items-center text-gray-800 hover:font-medium hover:text-sky-300 focus:font-medium focus:text-sky-300 focus:outline-none">
            <img v-bind:src="'/img/' +form.image" alt="" class="h-8 w-8 rounded-full object-cover"/>
            <button class="mx-1">{{ form.name }}</button>
          </a>
        </li>
        <li v-show="showLogout" class="px-1 py-1  my-5 flex  mx-5">
          <a  class="flex items-center text-gray-800 hover:font-medium hover:text-sky-300 focus:font-medium focus:text-sky-300 focus:outline-none">
            <button @click.prevent="logout">Đăng xuất</button>
          </a>
        </li>
    </ul>
    <div class="md:flex md:flex-row md:justify-between text-center mt-5 text-sm sm:text-base">
      <div class="w-2/6 flex justify-center ">
         <img src="../images/logo.PNG" alt="" class="h-8 w-8">
         <span class="uppercase">Uy tính - đảm bảo - hiệu quả - chất lượng  </span>
      </div>
      <div class=" w-4/6">
        <a v-show="showBar" class="uppercase text-gray-600  hover:text-purple-600">
          <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
            <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </a>    
        <a  v-for="item in pages" :href="item.url" class="uppercase text-gray-600  hover:text-purple-600 ml-2 py-4 pl-6 ">{{ item.name }}</a>    
      </div>
    </div><!-- Main Navigation -->
</template>