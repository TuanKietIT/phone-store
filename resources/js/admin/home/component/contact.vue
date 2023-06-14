
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


  const contact = ref([]);
  const form = reactive({
       id: '',
       name:'',
       email: '',
       title:'',
       description:'',
  });

  const showUpdate = ref(false);
  const showSendMail = ref(false);

  const schema = yup.object({
    name: yup.string().required(),
    email: yup.string().email().required(),
    title: '',
    description: yup.string().required(),
  });

  const getContact = () => {
    axios.get('/api/contact')
    .then( response => {
       contact.value = response.data;
    })
  };


  const createContact = (values, {resetForm}) => {
    axios.post('/api/contact/create', values)
    .then(response =>{
        getContact();
        resetForm();
    })
  };

  
  const editContact= (contact) => {
      showUpdate.value = true;
      form.id = contact.id;
      form.name = contact.name;
      form.email = contact.email;
      form.title = contact.title;
      form.description = contact.description
  }
  

  const closeContact= () => {
      showUpdate.value = false
  }
  const deleteContact = (contact) => {
    const remove = '/api/contact/delete/' + contact.id;
    axios.delete(remove)
    .then(response =>{
        getContact();
    })
  };

  onMounted(() => {
    getContact();
  })

 
</script>

<template>
  <div class="flex min-h-screen w-full bg-gray-100 font-sans">
    <sidebar/>
    <main class="flex min-h-screen flex-1 flex-col  bg-gray-100 p-8" >
      <navbar />
      <div class="flex gap-x-2 py-8 ">
        <div class="flex w-2/5 flex-col gap-y-8 bg-white">
          <div class="flex flex-col justify-between">
              <div class="flex items-center justify-center">
                <Form @submit="createContact" :validation-schema="schema" v-slot="{errors}" class="flex flex-col space-y-5 " >
                    <Field type="text" name="name" :class="{'is-invalid': errors.name}" class="w-[400px] focus:outline-none is-input-start px-1 py-1 bg-gray-100 mt-10"  placeholder="Enter name"/>
                    <span class="text-red-500 text-[14px] invalid-feedback">{{ errors.name }}</span>
                    <Field type="text" name="email" :class="{'is-invalid': errors.email}" class="w-[400px] focus:outline-none is-input-start px-1 py-1 bg-gray-100 mt-1"  placeholder="Enter email"/>
                    <span class="text-red-500 text-[14px] invalid-feedback">{{ errors.email }}</span>
                    <Field type="text" name="title" :class="{'is-invalid': errors.title}" class="w-[400px] focus:outline-none is-input-start px-1 py-1 bg-gray-100 mt-1"  placeholder="Enter title"/>
                    <span class="text-red-500 text-[14px] invalid-feedback">{{ errors.title }}</span>
                    <Field type="text" name="description" :class="{'is-invalid': errors.description}" class="w-[400px] focus:outline-none is-input-start px-1 py-1 bg-gray-100 mt-5"  placeholder="write content you need support"/>
                    <span class="text-red-500 text-[14px] invalid-feedback">{{ errors.description }}</span>
                    <div class="flex justify-center items-center">
                        <button type="submit" class="text-white my-2 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2 text-center mr-5">Send Mail</button>
                    </div>
              </Form>
          </div>
        </div>
        </div>
        <div class="flex w-3/5 flex-col gap-y-8">
          <div class="flex flex-col justify-between rounded-10 bg-white p-7">
            <div class="flex items-center justify-between">
              <h2 class="text-[20px] font-medium bg-white">All contact</h2>
            </div>
            <table class="mt-4">
              <thead>
                <tr>
                  <td class="py-1 text-sm text-gray-400">No</td>
                  <td class="py-1 text-sm text-gray-400">Date</td> 
                  <td class="py-1 text-sm text-gray-400">Email</td>
                  <td class="py-1 text-sm text-gray-400">Name</td>
                  <td class="py-1 text-sm text-gray-400"></td>
                  <td class="py-1 text-sm text-gray-400">Status</td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="contact in contact" :key="contact.id" class="border-b bg-white last:border-none" >
                  <td class="py-4">
                    <span class="text-sm font-medium bg-white ">
                      {{ contact.id }}
                    </span>
                  </td>
                  <td class="py-4">
                    <span class="text-sm text-gray-400">
                      {{ moment(contact.created_at).format("YYYY-MM-DD") }}
                    </span>
                  </td>
                  <td class="py-4">
                    <div class="flex items-center gap-x-2">
                      <span class="text-sm bg-white">
                        {{ contact.email }}
                      </span>
                    </div>
                  </td>
                  <td class="py-4">
                    <div class="flex items-center gap-x-2">
                      <span class="text-sm bg-white">
                        {{ contact.name }}
                      </span>
                    </div>
                  </td>
                  <td class="py-4">
                    <span class="text-sm bg-white">
                    </span>
                  </td>
                  <td class="py-4">
                    <div class="flex items-center gap-x-2">
                      <div @click.prevent="editContact(contact)" class="flex items-center justify-center rounded-full bg-white p-2 hover:text-green-400 focus:text-green-400" >
                          <EditIcon lass="h-6 w-6 stroke-current text-gray-400 cursor-pointer"/>
                      </div>
                      <div @click.prevent="deleteContact(contact)" class="flex items-center justify-center rounded-full bg-white p-2 hover:text-red-400 focus:text-red-400" >
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
                <form class="flex flex-col space-y-5 " >
                    <input type="text" name="name" v-model="form.name" disabled   class="outline-0 px-5 py-1 is-input-start bg-gray-100 mx-5 mt-10"  placeholder="Enter Title"/>
                    <input type="text" name="email" v-model="form.email" disabled  class="outline-0 px-5 py-1 is-input-start bg-gray-100 mx-5 mt-10"  placeholder="Enter Title"/>
                    <input type="text" name="title" v-model="form.title" disabled  class="outline-0 px-5 py-1 is-input-start bg-gray-100 mx-5 mt-10"  placeholder="Enter Title"/>
                    <input type="text" name="description" v-model="form.description" disabled  class="outline-0 px-5 py-1 is-input-start bg-gray-100 mx-5 mt-10"  placeholder="Enter Title"/>
                    <div class="flex justify-center items-center">
                      <button @click="closeContact" class="text-white my-5 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">Cancel</button>
                    </div>
              </form>
            </div>
        </div>
    </div>
  </div>
</template>
