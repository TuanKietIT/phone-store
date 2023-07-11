<script setup>
    import navbar from "../layout/navbar.vue";
    import sidebar from "../layout/sidebar.vue";
    import footerVue from "../layout/footer.vue";
    import axios from 'axios';
    import { reactive,ref, onMounted } from 'vue'
    import pagination from 'laravel-vue-semantic-ui-pagination';
    import {useRoute,useRouter} from 'vue-router'
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/css/index.css';

    const isLoading = ref(false);
    const fullPage = ref(true);
    const product = ref([]);

    const route = useRoute();
    const router = useRouter();
    const form = reactive({
      indexOne: 1,
      indexTwo: 2,
      indexThree: 3,
      indexFour: 4,
      indexFive: 5,
      indexSix: 6,
      indexSeven: 7,
      indexEight: 8,
    });
    const locationId = route.params.id;
    const phoneId = route.params.id;
    const priceId = route.params.id;
    const formatPrice = (value) =>{
      let val = (value/1).toFixed(0).replace('.', ',');
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}
    
    const getProduct = () => {
        isLoading.value = true;
        const show = '/api/searchPrice/iphone/' + locationId
        axios.get(show)
        .then( response => {
            product.value = response.data.product;
            setTimeout(() => {
                    isLoading.value = false
            }, 2000)
        })
    };
    const phones = ref([]);
    const locations = ref([]);
    
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
        })
    };

    const onePrice = () => {
        if(form.indexOne != priceId){
            router.push({path: '/home/search/phone/'+ form.indexOne});
            isLoading.value = true;
            return axios.get('/api/searchPrice/iphone/' + form.indexOne)
            .then(response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
        else {
            router.push({path: '/home/search/phone/'+ form.indexOne});
            isLoading.value = true;
            const show = '/api/searchPrice/iphone/' + priceId
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
    }
    const twoPrice = () => {
        if(form.indexTwo != priceId){
            router.push({path: '/home/search/phone/'+ form.indexTwo});
            isLoading.value = true;
            return axios.get('/api/searchPrice/iphone/' + form.indexTwo)
            .then(response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
        else {
            router.push({path: '/home/search/phone/'+ form.indexTwo});
            isLoading.value = true;
            const show = '/api/searchPrice/iphone/' + priceId
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
    }
    const threePrice = () => {
        if(form.indexThree != priceId){
            router.push({path: '/home/search/phone/'+ form.indexThree});
            isLoading.value = true;
            return axios.get('/api/searchPrice/iphone/' + form.indexThree)
            .then(response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
        else {
            router.push({path: '/home/search/phone/'+ form.indexThree});
            isLoading.value = true;
            const show = '/api/searchPrice/iphone/' + priceId
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
    }
    const  fourPrice = () => {
        if(form.indexFour != priceId){
            router.push({path: '/home/search/phone/'+ form.indexFour});
            isLoading.value = true;
            return axios.get('/api/searchPrice/iphone/' + form.indexFour)
            .then(response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
        else {
            router.push({path: '/home/search/phone/'+ form.indexFour});
            isLoading.value = true;
            const show = '/api/searchPrice/iphone/' + priceId
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
    }
    const fivePrice = () => {
        if(form.indexFive != priceId){
            router.push({path: '/home/search/phone/'+ form.indexFive});
            isLoading.value = true;
            return axios.get('/api/searchPrice/iphone/' + form.indexFive)
            .then(response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
        else {
            router.push({path: '/home/search/phone/'+ form.indexFive});
            isLoading.value = true;
            const show = '/api/searchPrice/iphone/' + priceId
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
    }
    const sixPrice = () => {
        if(form.indexSix != priceId){
            router.push({path: '/home/search/phone/'+ form.indexSix});
            isLoading.value = true;
            return axios.get('/api/searchPrice/iphone/' + form.indexSix)
            .then(response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
        else {
            router.push({path: '/home/search/phone/'+ form.indexSix});
            isLoading.value = true;
            const show = '/api/searchPrice/iphone/' + priceId
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
    }
    const sevenPrice = () => {
        if(form.indexSeven != priceId){
            router.push({path: '/home/search/phone/'+ form.indexSeven});
            isLoading.value = true;
            return axios.get('/api/searchPrice/iphone/' + form.indexSeven)
            .then(response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
        else {
            router.push({path: '/home/search/phone/'+ form.indexSeven});
            isLoading.value = true;
            const show = '/api/searchPrice/iphone/' + priceId
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
    }
    const eightPrice = () => {
        if(form.indexEight != priceId){
            router.push({path: '/home/search/phone/'+ form.indexEight});
            isLoading.value = true;
            return axios.get('/api/searchPrice/iphone/' + form.indexEight)
            .then(response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
        else {
            router.push({path: '/home/search/phone/'+ form.indexEight});
            isLoading.value = true;
            const show = '/api/searchPrice/iphone/' + priceId
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
    }
    const showLocation = (itemLocation) => {
        if(itemLocation.id != locationId){
            router.push({path: '/home/location/'+ itemLocation.id})
            isLoading.value = true;
            const show = '/api/search/product/location/' + itemLocation.id
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
        else {
            router.push({path: '/home/location/'+ itemLocation.id})
            isLoading.value = true;
            const show = '/api/search/product/location/' + locationId
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
    }

    const showPhone = (item) =>{
        if(item.id != phoneId){
            router.push({path: '/home/phone/'+ item.id})
            isLoading.value = true;
            const show = '/api/search/product/phone/' + item.id
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
        else {
            router.push({path: '/home/phone/'+ item.id})
            isLoading.value = true;
            const show = '/api/search/product/phone/' + phoneId
            return axios.get(show)
            .then( response => {
                product.value = response.data.product;
                setTimeout(() => {
                        isLoading.value = false
                }, 2000)
            })
        }
    }

    const onCancel = () => {
        console.log('User cancelled the loader.')
    }
    onMounted(() => {
        getProduct();
        getLocation();
        getPhone();
    })
</script>

<template>
    <navbar />
    <hr class="mx-2 h-2 bg-cyan-300"/>
    <main class="flex min-h-screen ju flex-1 flex-col p-2" >
      <div class="flex gap-x-6 py-8">
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
                <input type="checkbox" @click="fourPrice" name="" id="" class="mr-2">
                <span>Từ 8 - 10 triệu</span>
                </div>
            </div>
            <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
                <div class="flex">
                <input type="checkbox" @click="fivePrice" name="" id="" class="mr-2">
                <span>Từ 10 - 12 triệu</span>
                </div>
            </div>
            <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
                <div class="flex">
                <input type="checkbox" @click="sixPrice" name="" id="" class="mr-2">
                <span>Từ 12 - 15 triệu</span>
                </div>
            </div>
            <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
                <div class="flex">
                <input type="checkbox" @click="sevenPrice" name="" id="" class="mr-2">
                <span>Từ 15 - 18 triệu</span>
                </div>
            </div>
            <div class="flex flex-1 flex-col gap-y-2  pt-2 text-[14px]">
                <div class="flex">
                <input type="checkbox" @click="eightPrice" name="" id="" class="mr-2">
                <span>Trên 18 triệu</span>
                </div>
            </div>
        </div>
        <div class="flex w-4/5 flex-col gap-y-1">
            <div class="mt-5 shadow-x-full px-10 py-5">
                <div class="grid grid-flow-row grid-cols-1 md:grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 xl:grid-cols-3 gap-10">
                    <div v-for="item in product" :key="item.id" class="my-5 ml-2 rounded-lg shadow-product-is">
                        <a href="#" class="flex flex-row justify-center ">
                            <img v-bind:src="'/img/' + item.image1 " class="rounded-tl-lg my-2 mx-3 h-[180px] w-[180px] rounded-tr-lg" />
                        </a>
                        <div class="p-5">
                            <h3><a href="#" class=" flex flex-row justify-center text-center">{{ item.title }}</a></h3>
                            <div class="flex flex-row justify-center text-center my-1">
                            <span>Giá:{{ formatPrice( item.price) }} VND </span>
                            </div>
                            <div class="flex flex-col justify-between items-center">
                            <a class=" bg-gray-200 rounded-full py-2 px-8 my-1 text-sm text-gray-700 hover:bg-green-300 hover:text-white flex flex-row justify-center" href="#">
                                <router-link  :to="{ path: '/home/product/' + item.id}" class="btn-see" >
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
    </main>
    <footerVue />
    <div class="vl-parent">
        <loading v-model:active="isLoading"
                 :can-cancel="true"
                 :on-cancel="onCancel"
                 :is-full-page="fullPage"/>
    </div>
</template>