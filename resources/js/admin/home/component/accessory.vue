
<script setup>

  import EditIcon from "../icons/edit.svg";
  import DeleteIcon from "../icons/delete.svg";
  import sidebar from "../layout/sidebar.vue";
  import navbar from "../layout/navbar.vue";
  import pagination from 'laravel-vue-semantic-ui-pagination';

  import axios from 'axios';
  import { reactive,ref, onMounted } from 'vue'
  import { Form, Field } from 'vee-validate';
  import * as yup from 'yup';
  import moment from "moment";
  const token = localStorage.getItem('token');


  const accessories = ref([]);

  const currentPage = ref(1);
  const form = reactive({
       id: '',
       name: '',
  });
  const errorName = ref('');

  
  const getResults = (page) => {
    if (page === 'undefined') { 
      page = 1;
    }

    axios.get('/api/admin/accessory?page=' + page,{
        headers:{
            Authorization: ' Bearer ' + token
        }
    })
      .then(response => {
         accessories.value = response.data;
         reset();
      })
  };

  const showUpdate = ref(false);

  const schema = yup.object({
     name: yup.string().required(),
  });

   const reset = () => {
      form.name = '';
   }

  const createAccessory = () => {
    const formData = new FormData();
    formData.append('name', form.name);
    axios.post('/api/accessory/create', formData,{
        headers: {
            'content-type': 'multipart/form-data'
        }
    })
    .then(response =>{
       getResults();
    })
    .catch(function (error){
        if(error.response){
            if (error.response.status === 422) {
                errorName.value = error.response.data.errors.name;

            }
            else if (error.request) {
                console.log(error.request);
            } else {
                console.log('Error', error.message);
            }
        }
    })
  };

  const updateAccessory  = (values, {resetForm}) => {
    axios.post(`/api/accessory/update/${form.id}`, values,{
          headers:{
              Authorization: ' Bearer ' + token
          }
      })
    .then(response =>{
        getResults();
        closeAccessory();
    })
  };
  
  const editAccessory = (accessory) => {
      showUpdate.value = true;
      form.id = accessory.id;
      form.name = accessory.name;
  }
 
  const closeAccessory = () => {
      showUpdate.value = false
  }
  const deleteAccessory  = (accessory) => {
    const remove = '/api/accessory/delete/' + accessory.id;
    if(confirm('Are you sure, you want to delete this data?')) {
        axios.delete(remove,{
          headers:{
              Authorization: ' Bearer ' + token
          }
        })
        .then(response =>{
           getResults();
        })
    }
  };

  onMounted(() => {
    getResults();
  })

 
</script>

<template>
  <div class="flex min-h-screen w-full bg-gray-100 font-sans">
    <sidebar/>
    <main class="flex min-h-screen flex-1 flex-col  bg-gray-100 p-8" >
      <navbar />
      <div class="flex gap-x-2  h-[200px] mt-5">
        <div class="w-2/5 bg-white ">
            <div class="flex flex-col pt-5">
                <span class="px-10 pt-2">Thêm danh mục phụ kiện</span>
                <div class="flex justify-between px-10 pt-2 ">
                    <input type="text" name="name" v-model="form.name" :class="{'is-invalid': errorName}" class="round-full focus:outline-none is-input-start px-2 w-[300px] py-1 bg-gray-100"  placeholder="Enter name"/>
                    <button type="submit" @click="createAccessory" class="text-white bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2 text-center ml-5">Thêm</button>
                </div>
                <span class="px-10 pt-2 text-red-400" v-html="errorName"></span>
            </div>
        </div>
        <div class="flex w-3/5 flex-col gap-y-8">
          <div class="flex flex-col justify-between rounded-10 bg-white p-7">
            <div class="flex items-center justify-between">
              <h2 class="text-[20px] font-medium bg-white">All accessory</h2>
            </div>
            <table class="mt-4">
              <thead>
                <tr>
                  <td class="py-1 text-sm text-gray-400">No</td>
                  <td class="py-1 text-sm text-gray-400">Date</td> 
                  <td class="py-1 text-sm text-gray-400">name</td>
                  <td class="py-1 text-sm text-gray-400"></td>
                  <td class="py-1 text-sm text-gray-400">Status</td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="accessory in accessories.data" :key="accessory.id" class="border-b bg-white last:border-none" >
                  <td class="py-4">
                    <span class="text-sm font-medium bg-white ">
                      {{ accessory.id }}
                    </span>
                  </td>
                  <td class="py-4">
                    <span class="text-sm text-gray-400">
                      {{ moment(accessory.created_at).format("YYYY-MM-DD") }}
                    </span>
                  </td>
                  <td class="py-4">
                    <div class="flex items-center gap-x-2">
                      <span class="text-sm bg-white">
                        {{ accessory.name }}
                      </span>
                    </div>
                  </td>
                  <td class="py-4">
                  </td>
                  <td class="py-4">
                    <div class="flex items-center gap-x-2">
                      <div @click.prevent="editAccessory (accessory)" class="flex items-center justify-center rounded-full bg-white p-2 hover:text-green-400 focus:text-green-400" >
                          <EditIcon lass="h-6 w-6 stroke-current text-gray-400 cursor-pointer"/>
                      </div>
                      <div @click.prevent="deleteAccessory (accessory)" class="flex items-center justify-center rounded-full bg-white p-2 hover:text-red-400 focus:text-red-400" >
                          <DeleteIcon lass="h-6 w-6 stroke-current text-gray-400 "/>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="flex items-center justify-center mt-10">
              <pagination class="" :data="accessories" v-bind:showDisabled="true" icon="chevron" v-on:change-page="getResults"></pagination>
            </div>
          </div>
        </div>
      </div>
    </main>
    <div v-show="showUpdate"  class="fixed inset-0 bg-black bg-opacity-25 backdrop-blue-sm flex justify-center items-center">
        <div class="w-[500px]"> 
            <div class="bg-white m-5 px-5 py-5">
                <span class=" text-[16px] px-5">Tên phụ kiên</span>
                <Form @submit="updateAccessory " :validation-schema="schema" v-slot="{errors}" class="flex flex-col space-y-2 " >
                    <Field type="text" name="name" v-model="form.name"  :class="{'is-invalid': errors.name}" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5 mt-2"  placeholder="Enter name"/>
                    <span class="text-red-500 text-[14px] invalid-feedback px-5">{{ errors.name }}</span>
                    <div class="flex justify-center items-center">
                        <button type="submit" class="text-white bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-1.5 text-center  mb-5 mr-5">Update</button>
                        <button @click="closeAccessory " class="text-white bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-1.5 mb-5 text-center mr-5">Cancel</button>
                    </div>
              </Form>
            </div>
        </div>
    </div>
  </div>
</template>
