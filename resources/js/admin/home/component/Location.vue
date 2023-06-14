
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


  const locations = ref([]);
  const form = reactive({
       id: '',
       name: '',
  });

  const showUpdate = ref(false);

  const schema = yup.object({
     name: yup.string().required(),
  });

  const getLocation = () => {
    axios.get('/api/location')
    .then( response => {
       locations.value = response.data;
    })
  };


  const createLocation = (values, {resetForm}) => {
    axios.post('/api/location/create', values)
    .then(response =>{
        getLocation();
        resetForm();
    })
  };

  const updateLocation  = (values, {resetForm}) => {
    axios.post(`/api/location/update/${form.id}`, values)
    .then(response =>{
        getLocation();
        resetForm();
        closeLocation();
    })
  };
  
  const editLocation = (location) => {
      showUpdate.value = true;
      form.id = location.id;
      form.name = location.name;
      form.url = location.url;
  }
 
  const closeLocation = () => {
      showUpdate.value = false
  }
  const deleteLocation  = (location) => {
    const remove = '/api/location/delete/' + location.id;
    axios.delete(remove)
    .then(response =>{
        getLocation();
    })
  };

  onMounted(() => {
     getLocation();
  })

 
</script>

<template>
  <div class="flex min-h-screen w-full bg-gray-100 font-sans">
    <sidebar/>
    <main class="flex min-h-screen flex-1 flex-col  bg-gray-100 p-8" >
      <navbar />
      <div class="flex gap-x-2 py-8 h-[220px]">
        <div class="flex w-2/5 flex-col gap-y-8 bg-white">
          <div class="flex flex-col">
              <div class="flex items-center justify-center">
                <Form @submit="createLocation" :validation-schema="schema" v-slot="{errors}" class="flex flex-col space-y-2 w-[400px]" >
                    <Field type="text" name="name" :class="{'is-invalid': errors.name}" class="round-full focus:outline-none is-input-start px-1 py-1 bg-gray-100 mt-10"  placeholder="Enter name"/>
                    <span class="text-red-500 text-[13px] invalid-feedback">{{ errors.name }}</span>
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
              <h2 class="text-[20px] font-medium bg-white">All location</h2>
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
                <tr v-for="location in locations" :key="location.id" class="border-b bg-white last:border-none" >
                  <td class="py-4">
                    <span class="text-sm font-medium bg-white ">
                      {{ location.id }}
                    </span>
                  </td>
                  <td class="py-4">
                    <span class="text-sm text-gray-400">
                      {{ moment(location.created_at).format("YYYY-MM-DD") }}
                    </span>
                  </td>
                  <td class="py-4">
                    <div class="flex items-center gap-x-2">
                      <span class="text-sm bg-white">
                        {{ location.name }}
                      </span>
                    </div>
                  </td>
                  <td class="py-4">
                    <span class="text-sm bg-white">
                        {{ location.url }}
                    </span>
                  </td>
                  <td class="py-4">
                    <div class="flex items-center gap-x-2">
                      <div @click.prevent="editLocation (location)" class="flex items-center justify-center rounded-full bg-white p-2 hover:text-green-400 focus:text-green-400" >
                          <EditIcon lass="h-6 w-6 stroke-current text-gray-400 cursor-pointer"/>
                      </div>
                      <div @click.prevent="deleteLocation (location)" class="flex items-center justify-center rounded-full bg-white p-2 hover:text-red-400 focus:text-red-400" >
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
                <Form @submit="updateLocation " :validation-schema="schema" v-slot="{errors}" class="flex flex-col space-y-5 " >
                    <Field type="text" name="name" v-model="form.name"  :class="{'is-invalid': errors.name}" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5 mt-10"  placeholder="Enter name"/>
                    <span class="text-red-500 text-[14px] invalid-feedback px-5">{{ errors.name }}</span>
                    <div class="flex justify-center items-center">
                        <button type="submit" class="text-white my-5 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">Update</button>
                        <button @click="closeLocation " class="text-white my-5 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">Cancel</button>
                    </div>
              </Form>
            </div>
        </div>
    </div>
  </div>
</template>
