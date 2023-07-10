<script setup>
    import navbar from "../layout/navbar.vue";
    import sidebar from "../layout/sidebar.vue";
    import footerVue from "../layout/footer.vue";
    import axios from 'axios';
    import { reactive,ref, onMounted } from 'vue'
    import pagination from 'laravel-vue-semantic-ui-pagination';
    import {useRoute,useRouter} from 'vue-router'

    const product = ref([]);

    const route = useRoute();
    const locationId = route.params.id;
    
    const formatPrice = (value) =>{
      let val = (value/1).toFixed(0).replace('.', ',');
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	}
    
    const getProduct = () => {
        const show = '/api/search/product/location/' + locationId
        axios.get(show)
        .then( response => {
            product.value = response.data.product;
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
</template>