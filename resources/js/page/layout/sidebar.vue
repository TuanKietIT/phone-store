<script setup>
  import axios from 'axios';
  import { reactive,ref, onMounted } from 'vue'
  import {useRouter,useRoute} from 'vue-router'
  

  
  const router = useRouter();
  const route = useRoute();
  const phones = ref([]);
  const locations = ref([]);
  const locationId = route.params.id;
  const phoneId = route.params.id;

  const form = reactive({
      indexOne: 1,
      indexTwo: 2,
      indexThree: 3,
  });

  const getPhone = () => {
    axios.get('/api/phone')
    .then( response => {
      phones.value = response.data;
    })
  };
  const getLocation = () => {
    axios.get('/api/location')
    .then( response => {
      locations.value = response.data;
      console.log(form.priceBegin);
      console.log(form.priceEnd);
    })
  };

  const onePrice = () => {
    axios.get('/api/searchPrice/iphone/' + form.indexOne)
    .then(response => {
      router.push({path: '/home/search/phone/'+ form.indexOne})
    })
  }
  const twoPrice = () => {
    axios.get('/api/searchPrice/iphone/' + form.indexTwo)
    .then(response => {
      router.push({path: '/home/search/phone/'+ form.indexTwo})
    })
  }
  const threePrice = () => {
    axios.get('/api/searchPrice/iphone/' + form.indexThree)
    .then(response => {
       router.push({path: '/home/search/phone/'+ form.indexThree})
    })
  }
  const showLocation = (itemLocation) => {
        if(itemLocation.id ){
          router.push({path: '/home/location/'+ itemLocation.id})
            const show = '/api/search/product/location/' + locationId
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
            })
        }
        else {
            router.push({path: '/home/location/'+ itemLocation.id})
            const show = '/api/search/product/location/' + itemLocation.id
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
            })
        }
    };
    const showPhone = (item) => {
        if(item.id){
              router.push({path: '/home/phone/'+ item.id})
              const show = '/api/search/product/phone/' + phoneId
              return axios.get(show)
              .then( response => {
                  product.value = response.data.product;
                  console.log(response.data);
              })
        }
        else {
          router.push({path: '/home/phone/'+ item.id})
          const show = '/api/search/product/phone/' + item.id
          return axios.get(show)
          .then( response => {
              product.value = response.data.product;
          })
        }
        
    }

  onMounted(() => {
    getPhone();
    getLocation();
  })
</script>
<template>
     <div class="md:w-[250px] h-[800px] shadow-x-full mt-5 mx-3 my-3 px-5 py-5 ">
        <span class="text-[18px] font-medium text-sky-500 focus:outline-none ">Lọc theo Khu vực</span>
        <ul class="flex flex-col gap-y-4 py-3">
            <li v-for="itemLocation in locations" class="">
              <a @click="showLocation(itemLocation)" class="flex items-center is-bg-green-page-500 gap-x-1 text-gray-800 focus:outline-none">
                    <span class="uppercase ">{{ itemLocation.name }}</span>
              </a>
            </li>
        </ul>
        <span class="text-[18px] font-medium text-sky-500 focus:outline-none ">Danh mục sản phẩm</span>
        <ul class="flex flex-col gap-y-4 py-3">
            <li v-for="item in phones" class="">
              <a @click="showPhone(item)" class="flex items-center is-bg-green-page-500 gap-x-1 text-gray-800 focus:outline-none">
                <span class="uppercase ">{{ item.name }}</span>
              </a>
            </li>
        </ul>

        <span class="text-[18px] my-10 font-medium text-sky-500 focus:outline-none ">Lọc theo giá sản phẩm</span>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" @click="onePrice" name="" id="" class="mr-2">
              <span>Từ 1 - 3 triệu</span>
            </div>
        </div>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" @click="twoPrice" name="" id="" class="mr-2">
              <span>Từ 3 - 5 triệu</span>
            </div>
        </div>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" @click="threePrice" name="" id="" class="mr-2">
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
              <span>Từ 10 - 12 triệu</span>
            </div>
        </div>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" name="" id="" class="mr-2">
              <span>Từ 12 - 15 triệu</span>
            </div>
        </div>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" name="" id="" class="mr-2">
              <span>Từ 15 - 18 triệu</span>
            </div>
        </div>
        <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
            <div class="flex">
              <input type="checkbox" name="" id="" class="mr-2">
              <span>Trên 18 triệu</span>
            </div>
        </div>
     </div>
     
</template>