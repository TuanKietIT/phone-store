<script setup>

  import EditIcon from "../icons/edit.svg";
  import DeleteIcon from "../icons/delete.svg";
  import PlusIcon from "../icons/plus.svg";
  import sidebar from "../layout/sidebar.vue";
  import navbar from "../layout/navbar.vue";
  import loadingCreateButton from "./loadingCreateButton.vue";

  import pagination from 'laravel-vue-semantic-ui-pagination';
  import axios from 'axios';
  import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
  import { reactive,ref, onMounted } from 'vue'
  import * as yup from 'yup';
  import moment from "moment";
  import {useRoute,useRouter} from 'vue-router'
 
  const route = useRoute();
  const router = useRouter();

  let reader = new FileReader();
  const token = localStorage.getItem('token');
  const editor = ref(ClassicEditor);
  const editorData = ref('<p>Content of the editor.</p>');

  const editorOption = {
      placeholder: 'core',
      modules: {
          toolbar: [
              ['bold', 'italic', 'underline', 'strike'],
              ['blockquote', 'code-block'],
              [{ header: 1 }, { header: 2 }],
              [{ list: 'ordered' }, { list: 'bullet' }],
              [{ script: 'sub' }, { script: 'super' }],
              [{ indent: '-1' }, { indent: '+1' }],
              [{ direction: 'rtl' }],
              [{ size: ['small', false, 'large', 'huge'] }],
              [{ header: [1, 2, 3, 4, 5, 6, false] }],
              [{ color: [] }, { background: [] }],
              [{ font: [] }],
              [{ align: [] }],
              ['clean'],
              ['link', 'image', 'video']
          ]
      }
  }

  const products = ref([]);
  const locations = ref([]);
  const categories = ref([]);
  const accessories = ref([]);
  const phones = ref([]);
  const laptops = ref([]);

  const errorDescription = ref('');
  const errorTitle = ref('');
  const errorPrice = ref('');
  const errorNumber = ref('');
  const errorStatus = ref('');
  const errorCategory = ref('');
  const errorLocation = ref('');
  const errorFile1 = ref('');
  const errorFile2 = ref('');
  const errorFile3 = ref('');
  const errorFile4 = ref('');
  const errorColor = ref('');
  const errorCapacity = ref('');

  const isLoading = ref(false);
  const showCreate = ref(false);
  const save = ref(false);
  const update = ref(false);
  const file2 = ref(false);
  const file3 = ref(false);
  const file4 = ref(false);
  
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
      accessory_id:'0',
      phone_id:'0',
      laptop_id:'0'
  });

  const reset = () => {
    form.title = '',
    form.description = '',
    form.price = '',
    form.number = '',
    form.status = '',
    form.choose = 0,
    form.image1 = '',
    form.image2 = 'null',
    form.image3 = 'null',
    form.image4 = 'null',
    form.user_id ='',
    form.category_id = '',
    form.location_id ='',
    form.color = '',
    form.capacity = '',
    form.location_id ='',
    form.accessory_id ='0',
    form.phone_id ='0',
    form.laptop_id ='0'
  }
  
  const getResults = (page) => {
    isLoading.value = true;
    if (page === 'undefined') { 
        page = 1;
    }

    axios.get('/api/admin/product?page=' + page,{
        headers:{
            Authorization: ' Bearer ' + token
        }
    })
      .then(response => { 
        setTimeout(() => isLoading.value = false,1000);
        products.value = response.data;
        closeProduct();
        reset();
      })
  };

  const getInfoAdmin = () =>{
    const token = localStorage.getItem('token');
    axios.get('/api/user',{
        headers:{
            Authorization: ' Bearer ' + token
        }
    })
    .then(response => {
        form.user_id = response.data[0].id;
    })
  }

  const getCategory = () => {
    axios.get('/api/category')
    .then( response => {
      categories.value = response.data;
    })
  };
  
  const getAccessory = () => {
    axios.get('/api/accessory')
    .then( response => {
      accessories.value = response.data;
    })
  };
  
  const getPhone = () => {
    axios.get('/api/phone')
    .then( response => {
      phones.value = response.data;
    })
  };
  
  const getLaptop = () => {
    axios.get('/api/laptop')
    .then( response => {
      laptops.value = response.data;
    })
  };
  
  const getLocation = () => {
    axios.get('/api/location')
    .then( response => {
      locations.value = response.data;
    })
  };

  const createProduct = () => {
      const formData = new FormData();
      formData.append('title', form.title);
      formData.append('description', form.description);
      formData.append('price', form.price);
      formData.append('number', form.number);
      formData.append('status', form.status);
      formData.append('choose', form.choose);
      formData.append('file1', form.image1);
      formData.append('file2', form.image2);
      formData.append('file3', form.image3);
      formData.append('file4', form.image4);
      formData.append('user_id', form.user_id);
      formData.append('category_id', form.category_id);
      formData.append('location_id', form.location_id);
      formData.append('color', form.color);
      formData.append('capacity', form.capacity);
      formData.append('phone_id', form.phone_id);
      formData.append('laptop_id', form.laptop_id);
      formData.append('accessory_id', form.accessory_id);
      
      axios.post('/api/product/create', formData,{
          headers: {
              'content-type': 'multipart/form-data',
              Authorization: ' Bearer ' + token
          }
      })
      .then(response =>{
          getResults();
          reset();
          window.location.reload();
          form.image1 = "";
          closeProduct();
      })
      .catch(function (error){
          if(error.response){
              if (error.response.status === 422) {
                  setTimeout(() => isLoading.value = false,1000);
                  errorTitle.value = error.response.data.errors.title;
                  errorDescription.value = error.response.data.errors.description;
                  errorPrice.value = error.response.data.errors.price;
                  errorNumber.value = error.response.data.errors.number;
                  errorCategory.value = error.response.data.errors.category_id;
                  errorLocation.value = error.response.data.errors.location_id;
                  errorStatus.value = error.response.data.errors.status;
                  errorFile1.value = error.response.data.errors.file1;
                  errorFile2.value = error.response.data.errors.file2;
                  errorFile3.value = error.response.data.errors.file3;
                  errorFile4.value = error.response.data.errors.file4;
                  errorColor.value = error.response.data.errors.color;
                  errorCapacity.value = error.response.data.errors.capacity;

              }
              else if (error.request) {
                  console.log(error.request);
              } else {
                  console.log('Error', error.message);
              }
          }
      })
  };
  

  const choose = (product) => {
      if(product.choose > 0){
          return true;
      }
      else {
          return false;
      }
  }



  const chooseTrue = reactive({
      choose: 1,
  });
  const chooseFalse = reactive({
      choose: 0,
  });

  const updateChoose = (product) => {
      form.id = product.id;
      if (product.choose == 0) {
          return axios.post(`/api/product/updated/${form.id}`, chooseTrue,{
              headers: {
                  Authorization: ' Bearer ' + token
              }
          })
          .then(response =>{
              getResults();
              closeProduct();
          })
      }
      else {
          return axios.post(`/api/product/updated/${form.id}`, chooseFalse,{
              headers: {
                  Authorization: ' Bearer ' + token
              }
          })
          .then(response =>{
              getResults();
              closeProduct();
          })
      }
      
  }
  const editProduct = (product) => {
    showCreate.value = true;
    save.value = false;
    update.value = true;
    form.id = product.id,
    form.title = product.title,
    form.description = product.description,
    form.price = product.price,
    form.number = product.number,
    form.status = product.status,
    form.image1 = product.image1,
    form.image2 = 'null',
    form.image3 = 'null',
    form.image4 = 'null',
    form.category_id = product.category_id,
    form.location_id =product.location_id,
    form.color = product.color,
    form.capacity = product.capacity,
    form.accessory_id = pagination.accessory_id,
    form.phone_id = product.phone_id,
    form.laptop_id = product.laptop_id
  }

  const updateProduct = () => {
      const formData = new FormData();
      formData.append('title', form.title);
      formData.append('description', form.description);
      formData.append('price', form.price);
      formData.append('number', form.number);
      formData.append('status', form.status);
      formData.append('choose', form.choose);
      formData.append('file1', form.image1);
      formData.append('file2', form.image2);
      formData.append('file3', form.image3);
      formData.append('file4', form.image4);
      formData.append('category_id', form.category_id);
      formData.append('location_id', form.location_id);
      formData.append('color', form.color);
      formData.append('capacity', form.capacity);
      axios.post(`/api/product/update/${form.id}`, formData,{
          headers: {
              'content-type': 'multipart/form-data',
              Authorization: ' Bearer ' + token
          }
      })
      .then(response =>{
          getResults();
          reset();
          closeProduct();
      })
      .catch(function (error){
          if(error.response){
              if (error.response.status === 422) {
                  setTimeout(() => isLoading.value = false,1000);
                  errorTitle.value = error.response.data.errors.title;
                  errorDescription.value = error.response.data.errors.description;
                  errorPrice.value = error.response.data.errors.price;
                  errorNumber.value = error.response.data.errors.number;
                  errorCategory.value = error.response.data.errors.category_id;
                  errorLocation.value = error.response.data.errors.location_id;
                  errorStatus.value = error.response.data.errors.status;
                  errorFile1.value = error.response.data.errors.file1;
                  errorFile2.value = error.response.data.errors.file2;
                  errorFile3.value = error.response.data.errors.file3;
                  errorFile4.value = error.response.data.errors.file4;
                  errorColor.value = error.response.data.errors.color;
                  errorCapacity.value = error.response.data.errors.capacity;

              }
              else if (error.request) {
                  console.log(error.request);
              } else {
                  console.log('Error', error.message);
              }
          }
      })
  };

  const deleteProduct  = (product) => {
      const remove = '/api/product/delete/' + product.id;
        if(confirm('Are you sure, you want to delete this data?')) {
          axios.delete(remove,{
            headers: {
                Authorization: ' Bearer ' + token
            }
        })
        .then(response =>{
           getResults();
        })
      }
  };

  const showCreateProduct = () => {
    showCreate.value = true;
    save.value = true;
    update.value = false;
  };
  const closeProduct = () => {
    showCreate.value = false;
    reset();
  };
  
  

  let imageFile = ref('');
  const handleImage1 = (e) => {
    form.image1 = e.target.files[0];
    reader.addEventListener("load", function () {
      imageFile = reader.result;
    }.bind(), false);
    if (form.image1) {
        if ( /\.(jpe?g|png|gif)$/i.test( form.image1.name ) ) {
            reader.readAsDataURL( form.image1 );
        }
    }
    file2.value = true;
  };
  const handleImage2 = (e) => {
    form.image2 = e.target.files[0];
    reader.addEventListener("load", function () {
      imageFile = reader.result;
    }.bind(), false);
    if (form.image2) {
        if ( /\.(jpe?g|png|gif)$/i.test( form.image2.name ) ) {
            reader.readAsDataURL( form.image2 );
        }
    }
    file3.value = true;
  };
  const handleImage3 = (e) => {
    form.image3 = e.target.files[0];
    reader.addEventListener("load", function () {
      imageFile = reader.result;
    }.bind(), false);
    if (form.image3) {
        if ( /\.(jpe?g|png|gif)$/i.test( form.image3.name ) ) {
            reader.readAsDataURL( form.image3 );
        }
    }
    file4.value = true;
  };
  const handleImage4 = (e) => {
    form.image4 = e.target.files[0];
    reader.addEventListener("load", function () {
      imageFile = reader.result;
    }.bind(), false);
    if (form.image4) {
        if ( /\.(jpe?g|png|gif)$/i.test( form.image4.name ) ) {
            reader.readAsDataURL( form.image4 );
        }
    }
  };


  onMounted(() => {
     getResults();
     getInfoAdmin();
     getCategory();
     getLocation();
     getAccessory();
     getPhone();
     getLaptop();
  })

 
  
 
</script>

<template>
  <div class="flex min-h-screen w-full bg-gray-100 font-sans">
    <sidebar/>
    <main class="flex min-h-screen flex-1 flex-col  bg-gray-100 p-8" >
      <navbar />
      <div class="flex gap-x-6 py-8">
        <div class="flex w-full flex-col gap-y-8">
          <div class="flex flex-col justify-between rounded-10 bg-white p-7">
            <div class="flex items-center justify-between">
              <h2 class="text-[20px] font-medium bg-white">product</h2>
              <button class="inline-flex items-center gap-x-1 border-double border-4 border-green-600 rounded-10 bg-white py-1.5 px-2 text-sm text-gray-400 hover:bg-green-300 hover:text-white">
                <PlusIcon class="h-6 w-6 stroke-current" />
                <span @click="showCreateProduct">Create product</span>
              </button>
            </div>
            <table class="mt-4">
              <thead>
                <tr>
                  <td class="py-1 w-[50px] text-sm text-gray-400">ID</td>
                  <td class="py-1 w-[150px] text-sm text-gray-400">Ngày tạo</td>
                  <td class="py-1 w-[100px] text-sm text-gray-400">Hình ảnh</td>
                  <td class="py-1 w-[600px] text-sm text-gray-400">Mô tả</td>
                  <td class="py-1 w-[100px] text-center text-sm text-gray-400">Trạng thái</td>
                  <td class="py-1 text-sm text-center text-gray-400">Chức năng</td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in products.data" :key="product.id" class="border-b bg-white last:border-none">
                  <td class="py-4">
                    <span class="text-sm font-medium bg-white ">
                      {{ product.id }}
                    </span>
                  </td>
                  <td class="py-4">
                    <span class="text-sm text-gray-400">
                        {{ moment(product.created_at).format("YYYY-MM-DD") }}
                    </span>
                  </td>
                  <td class="py-4">
                    <div v-if="product.image1" >
                      <img v-bind:src="'/img/' + product.image1" alt="" class="h-10 w-10 rounded-full object-cover"/>
                    </div>
                  </td>
                  <td class="py-4 flex items-center gap-x-2">
                    <span  v-html="product.description" class="text-sm mr-10 bg-white description-page"></span>
                  </td>
                  <td class="py-4 text-center" @click="updateChoose(product)">
                      <span class="text-[14px] text-white bg-sky-300 px-10 py-1.5 is-curser">{{ choose(product) }}</span>
                  </td>
                  <td class="py-4 flex items-center justify-center">
                    <div class="flex items-center text-center gap-x-2">
                      <div @click.prevent="editProduct(product)" class="flex items-center justify-center rounded-full bg-white p-2 hover:text-green-400 focus:text-green-400" >
                          <EditIcon lass="h-6 w-6 stroke-current text-gray-400 cursor-pointer"/>
                      </div>
                      <div @click.prevent="deleteProduct(product)" class="flex items-center justify-center rounded-full bg-white p-2 hover:text-red-400 focus:text-red-400" >
                          <DeleteIcon lass="h-6 w-6 stroke-current text-gray-400 "/>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="flex items-center justify-center mt-10">
              <pagination class="" :data="products" v-bind:showDisabled="true" icon="chevron" v-on:change-page="getResults"></pagination>
            </div>
          </div>
        </div>
      </div>
    </main>
    <div v-show="showCreate" class="fixed inset-0 bg-black bg-opacity-25 backdrop-blue-sm flex justify-center items-center">
        <div class="w-[650px] overflow h-[800px]"> 
            <div class="bg-white">
                <h2 class="px-5 py-5 text-center font-bold text-[20px] text-sky-500">Điện thoại</h2>
                <hr class="py-2"/>
                <form  class="flex flex-col space-y-2 " >
                    <input type="text" v-model="form.title" :class="{'is-invalid': errorTitle}" class="outline-0 px-2 py-2 bg-gray-100 is-input-start mx-5" max="190"  placeholder="Nhập tiêu đề"/>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorTitle"></span>
                    <input type="text" v-model="form.number" :class="{'is-invalid': errorNumber}" class="outline-0 px-2 py-2 bg-gray-100 is-input-start mx-5" min="1"  placeholder="Nhập số lượng"/>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorNumber"></span>
                    <input type="text" v-model="form.price" :class="{'is-invalid': errorPrice}" class="outline-0 px-2 py-2 bg-gray-100 is-input-start mx-5" min="1"  placeholder="Nhập mức giá"/>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorPrice"></span>
                    <select name="" v-model="form.status" :class="{'is-invalid': errorStatus}" class="outline-0 px-2 py-2 bg-gray-100 is-input-start mx-5 my-5">
                       <option value="" disabled>Chọn trạng thái</option>
                       <option value="Đang cập nhật">Đang cập nhật</option>
                       <option value="Mới">Mới</option>
                       <option value="Đã qua sử dụng">Đã qua sử dụng</option>
                    </select>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorStatus"></span>
                    <select name=""  v-model="form.color" :class="{'is-invalid': errorColor}" class="outline-0 px-2 py-2 bg-gray-100 is-input-start mx-5 my-5">
                       <option value="" disabled>Chọn màu sắc</option>
                       <option value="Đang cập nhật">Đang cập nhật</option>
                       <option value="màu Xanh">màu Xanh</option>
                       <option value="màu Đen">màu Đen</option>
                       <option value="màu Trắng">màu Trắng</option>
                       <option value="màu Vàng">màu Vàng</option>
                       <option value="màu Đỏ">màu Đỏ</option>
                       <option value="màu Hồng">màu Hồng</option>
                    </select>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorColor"></span>
                    <select name="" v-model="form.capacity" :class="{'is-invalid': errorCapacity}" class="outline-0 px-2 py-2 bg-gray-100 is-input-start mx-5 my-5">
                       <option value="" disabled>Chọn dung lượng</option>
                       <option value="Đang cập nhật">Đang cập nhật</option>
                       <option value="16GB">16GB</option>
                       <option value="32GB">32GB</option>
                       <option value="64GB">64GB</option>
                       <option value="128GB">128GB</option>
                       <option value="256GB">256GB</option>
                       <option value="512GB">512GB</option>
                    </select>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorCapacity"></span>
                    <select name="" v-model="form.category_id" :class="{'is-invalid': errorCategory}" class="outline-0 px-2 py-2 bg-gray-100 is-input-start mx-5 my-5">
                       <option value="" disabled>Chọn danh mục</option>
                       <option :value="category.id" v-for="category in categories" :key="category.id">{{category.name}}</option>
                    </select>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorCategory"></span>
                    <select  v-model="form.location_id" :class="{'is-invalid': errorLocation}" class="outline-0 px-2 py-2 bg-gray-100 is-input-start mx-5">
                       <option value="" disabled>Chọn khu vực</option>
                       <option :value="location.id" v-for="location in locations" :key="location.id">{{location.name}}</option>
                    </select>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorLocation"></span>
                    <select v-if="form.category_id == 1 || form.category_id == 6"  v-model="form.phone_id"  class="outline-0 px-2 py-2 bg-gray-100 is-input-start mx-5 my-5">
                       <option value="" disabled>Chon điện thoại</option>
                       <option :value="phone.id" v-for="phone in phones" :key="phone.id">{{phone.name}}</option>
                    </select>
                    <select v-else-if="form.category_id == 2" name="" v-model="form.laptop_id" :class="{'is-invalid': errorCategory}" class="outline-0 px-2 py-2 bg-gray-100 is-input-start mx-5 my-5">
                       <option value="" disabled>Chon laptop</option>
                       <option :value="laptop.id" v-for="laptop in laptops" :key="laptop.id">{{laptop.name}}</option>
                    </select>
                    <select  v-else="form.category_id == 4" relative v-model="form.accessory_id" :class="{'is-invalid': errorCategory}" class="outline-0 px-2 py-2 bg-gray-100 is-input-start mx-5 my-5">
                       <option value="Chọn phụ kiện" disabled>Chọn phụ kiện</option>
                       <option :value="accessory.id" v-for="accessory in accessories" :key="accessory.id">{{accessory.name}}</option>
                    </select>
                    <div class=" is-input-start mx-4 flex justify-center items-center bg-gray-100 " :class="{'is-invalid': errorDescription}">
                        <ckeditor :editor="editor" v-model="form.description" :config="editorOption"></ckeditor>
                    </div>
                    <span class="text-red-500 text-[14px] invalid-feedback  px-5" v-html="errorDescription" ></span>
                    <div class=" is-input-start mx-4 flex bg-gray-100">
                      <input type="file"  :class="{'is-invalid': errorFile1}" @change="handleImage1" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5"  placeholder="Enter url"/>
                      <span class="text-red-500 text-[14px] invalid-feedback px-5" v-html="errorFile1"></span>
                    </div>
                    <div class=" is-input-start mx-4 flex bg-gray-100">
                      <input v-show="file2" type="file" :class="{'is-invalid': errorFile2}" @change="handleImage2" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5"  placeholder="Enter url"/>
                    </div>
                    <div class=" is-input-start mx-4 flex bg-gray-100">
                      <input v-show="file3" type="file" :class="{'is-invalid': errorFile3}"  @change="handleImage3" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5"  placeholder="Enter url"/>
                    </div>
                    <div class=" is-input-start mx-4 flex bg-gray-100">
                      <input v-show="file4" type="file"  :class="{'is-invalid': errorFile4}" @change="handleImage4" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5"  placeholder="Enter url"/>
                    </div>
                    <div class="flex justify-center items-center ">
                        <button v-show="save" @click.prevent="createProduct" type="submit" class="text-white bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">
                           Tạo mới
                        </button>
                        <button v-show="update" @click.prevent="updateProduct" type="submit" class="text-white my-5 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">update</button>
                        <button @click="closeProduct" class="text-white my-5 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">Cancel</button>
                    </div>
              </form>
            </div>
        </div>
    </div>
    <loadingCreateButton :is-loading="isLoading" class="text-orange fixed  bg-opacity-25 flex justify-center items-center">
    </loadingCreateButton>
  </div>
</template>
