
<script setup>

  import EditIcon from "../icons/edit.svg";
  import DeleteIcon from "../icons/delete.svg";
  import sidebar from "../layout/sidebar.vue";
  import navbar from "../layout/navbar.vue";
  import axios from 'axios';
  import { reactive,ref, onMounted } from 'vue'
  import { Form, Field } from 'vee-validate';
  import * as yup from 'yup';
  import moment from "moment";


  const categories = ref([]);
  const form = reactive({
       id: ''
  });

  const showUpdate = ref(false);

  const schema = yup.object({
     title: yup.string().required(),
  });

  const getCategory = () => {
    axios.get('/api/category')
    .then( response => {
       categories.value = response.data;
    })
  };


  const createCategory = (values, {resetForm}) => {
    axios.post('/api/category/create', values)
    .then(response =>{
        getCategory();
        resetForm();
    })
  };

  const updateCategory = (values, {resetForm}) => {
    axios.post(`/api/category/update/${form.id}`, values)
    .then(response =>{
        getCategory();
        resetForm();
        closeCategory();
    })
  };
  
  const editCategory= (category) => {
      showUpdate.value = true;
      form.id = category.id;
      console.log(form.id);
  }
 
  const closeCategory= () => {
      showUpdate.value = false
  }
  const deleteCategory = (category) => {
    const remove = '/api/category/delete/' + category.id;
    axios.delete(remove)
    .then(response =>{
        getCategory();
    })
  };

  onMounted(() => {
     getCategory();
  })

 
</script>

<template>
  <div class="flex min-h-screen w-full bg-gray-100 font-sans">
    <sidebar/>
    <main class="flex min-h-screen flex-1 flex-col  bg-gray-100 p-8" >
      <navbar />
      <div class="flex gap-x-2 py-8 h-[250px]">
        <div class="flex w-2/5 flex-col gap-y-8 bg-white">
          <div class="flex flex-col justify-between">
              <div class="flex items-center justify-center">
                <Form @submit="createCategory" :validation-schema="schema" v-slot="{errors}" class="flex flex-col space-y-5 " >
                    <Field type="text" name="title" :class="{'is-invalid': errors.title}" class="w-[400px] focus:outline-none focus:ring focus:border-sky-500 px-1 py-1 bg-gray-100 mt-10"  placeholder="Enter title"/>
                    <span class="text-red-500 text-[14px] invalid-feedback">{{ errors.title }}</span>
                    <div class="flex justify-center items-center">
                        <button type="submit" class="text-white my-2 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2 text-center mr-5">create</button>
                    </div>
              </Form>
          </div>
        </div>
        </div>
        <div class="flex w-3/5 flex-col gap-y-8">
          <div class="flex flex-col justify-between rounded-10 bg-white p-7">
            <div class="flex items-center justify-between">
              <h2 class="text-[20px] font-medium bg-white">All Category</h2>
            </div>
            <table class="mt-4">
              <thead>
                <tr>
                  <td class="py-1 text-sm text-gray-400">No</td>
                  <td class="py-1 text-sm text-gray-400">Date</td> 
                  <td class="py-1 text-sm text-gray-400">Title</td>
                  <td class="py-1 text-sm text-gray-400"></td>
                  <td class="py-1 text-sm text-gray-400">Status</td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="category in categories" :key="category.id" class="border-b bg-white last:border-none" >
                  <td class="py-4">
                    <span class="text-sm font-medium bg-white ">
                      {{ category.id }}
                    </span>
                  </td>
                  <td class="py-4">
                    <span class="text-sm text-gray-400">
                      {{ moment(category.created_at).format("YYYY-MM-DD") }}
                    </span>
                  </td>
                  <td class="py-4">
                    <div class="flex items-center gap-x-2">
                      <span class="text-sm bg-white">
                        {{ category.title }}
                      </span>
                    </div>
                  </td>
                  <td class="py-4">
                    <span class="text-sm bg-white">
                    </span>
                  </td>
                  <td class="py-4">
                    <div class="flex items-center gap-x-2">
                      <div @click.prevent="editCategory(category)" class="flex items-center justify-center rounded-full bg-white p-2 hover:text-green-400 focus:text-green-400" >
                          <EditIcon lass="h-6 w-6 stroke-current text-gray-400 cursor-pointer"/>
                      </div>
                      <div @click.prevent="deleteCategory(category)" class="flex items-center justify-center rounded-full bg-white p-2 hover:text-red-400 focus:text-red-400" >
                          <DeleteIcon lass="h-6 w-6 stroke-current text-gray-400 "/>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
    <div v-show="showUpdate" class="fixed inset-0 bg-black bg-opacity-25 backdrop-blue-sm flex justify-center items-center">
        <div class="w-[500px]"> 
            <div class="bg-white">
                <Form @submit="updateCategory" :validation-schema="schema" v-slot="{errors}" class="flex flex-col space-y-5 " >
                    <Field type="text" name="title"  :class="{'is-invalid': errors.title}" class="outline-0 px-5 py-1 bg-gray-100 mx-5 mt-10"  placeholder="Enter Title"/>
                    <span class="text-red-500 text-[14px] invalid-feedback px-5">{{ errors.title }}</span>
                    <div class="flex justify-center items-center">
                        <button type="submit" class="text-white my-5 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">Update</button>
                        <button @click="closeCategory" class="text-white my-5 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">Cancel</button>
                    </div>
              </Form>
            </div>
        </div>
    </div>
  </div>
</template>
