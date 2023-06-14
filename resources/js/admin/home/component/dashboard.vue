<script setup>

  import SendIcon from "../icons/send.svg";
  import ReceiveIcon from "../icons/receive.svg";
  import CalendarIcon from "../icons/calendar.svg";
  import PlusIcon from "../icons/plus.svg";
  import sidebar from "../layout/sidebar.vue";
  import navbar from "../layout/navbar.vue";
  import axios from 'axios';
  import { reactive,ref, onMounted } from 'vue'
  import * as yup from 'yup';
  import moment from "moment";

  
   
  const users = ref([]);

  const showCreate = ref(false);
  const showCreateUser = () => {
    showCreate.value = true;
  }; 

  const form = reactive({
        id: '',
        name: '',
        email: '',
        password: '',
        c_password: '',
        phone:'',
        image: ''
  });

  const errorName = ref('');
  const errorEmail = ref('');
  const errorPassword = ref('');
  const errorCPassword = ref('');
  const errorPhone = ref('');
  const errorFile = ref('');

  const getUser = () => {
    axios.get('/api/home/user')
    .then( response => {
       users.value = response.data;
    })
  };

  const imgPreview = ref('');

    const onChangeImage = (e) => {
      form.image = e.target.files[0];
      const reader = new FileReader();
      reader.addEventListener("load", function () {
          imgPreview = reader.result;
      }.bind(this), false);

      if (form.image) {
          if ( /\.(jpe?g|png|gif)$/i.test(form.image.name) ) {
              reader.readAsDataURL(form.image);
          }
      }
    }

  const createNews = () => {
    const formData = new FormData();
    formData.append('name', form.name);
    formData.append('email', form.email);
    formData.append('password', form.password);
    formData.append('c_password', form.c_password);
    formData.append('phone', form.phone);
    formData.append('file', form.image);
    axios.post('/api/user/register', formData,{
        headers: {
            'content-type': 'multipart/form-data'
        }
    })
    .then(response =>{
      getUser();
        form.id = '';
        form.name = '';
        form.image = '';
        form.email = 0;
        form.password = '';
        form.c_password = '';
        form.phone = '';
        closeUser();
    })
    .catch(function (error){
        if(error.response){
            if (error.response.status === 422) {
                errorName.value = error.response.data.errors.name;
                errorEmail.value = error.response.data.errors.email;
                errorPassword.value = error.response.data.errors.password;
                errorCPassword.value = error.response.data.errors.c_password;
                errorPhone.value = error.response.data.errors.phone;
                errorFile.value = error.response.data.errors.file;

            }
            else if (error.request) {
                console.log(error.request);
            } else {
                console.log('Error', error.message);
            }
        }
    })
  };
  const closeUser = () => {
    showCreate.value = false;
    form.id = '';
    form.name = '';
    form.image = '';
    form.email = 0;
    form.password = '';
    form.c_password = '';
    form.phone = '';

  };
  
  onMounted(() => {
    getUser();
  })



  const recentTransactions = [
    {
      icon: SendIcon,
      type: "Send transaction",
      date: "Dec 24, 2021",
      amount: "$ 123.00",
      balance: "$ 334.00",
    },
    {
      icon: ReceiveIcon,
      type: "Receive fund",
      date: "Jul 20. 2021",
      amount: "$ 322.00",
      balance: "$ 658.00",
    },
  ];

</script>

<template>
  <div class="flex min-h-screen w-full bg-gray-100 font-sans">
    <sidebar/>
    <main class="flex min-h-screen flex-1 flex-col  bg-gray-100 p-8" >
      <navbar />
      <div class="flex gap-x-6 py-8">
        <div class="flex w-3/5 flex-col gap-y-8">
          <div class="flex items-center justify-between rounded-10 bg-white  p-7" >
            <div class="flex items-center gap-x-4">
              <div>
                <div class="text-sm text-gray-400">User</div>
                <div class="pt-1 bg-white text-center">05</div>
              </div>
            </div>
            <div class="h-full w-px bg-white" />
            <div>
              <div class="text-sm text-gray-400">Contact</div>
              <div class="pt-1 bg-white text-center">08</div>
            </div>
            <div class="h-full w-px bg-white" />
            <div>
              <div class="text-sm text-gray-400 text-center">Product</div>
              <div class="pt-1 bg-white text-center">08</div>
            </div>
            <div class="h-full w-px bg-white" />
            <div>
              <div class="text-sm text-gray-400">See</div>
              <div class="pt-1 bg-white text-center">15</div>
            </div>
          </div>
          <div class="flex flex-col justify-between rounded-10 bg-white p-7">
            <div class="flex items-center justify-between">
              <h2 class="text-[20px] font-medium bg-white">All user</h2>
              <button class="inline-flex items-center gap-x-1 border-double border-4 border-indigo-600 rounded-10 bg-white py-2 px-4 text-sm text-gray-400 hover:bg-green-300">
                <PlusIcon class="h-6 w-6 stroke-current" />
                <span @click="showCreateUser">New User</span>
              </button>
            </div>
            <table class="mt-4">
              <thead>
                <tr>
                  <td class="py-1 w-[50px] text-sm text-gray-400">ID</td>
                  <td class="py-1 w-[120px] text-sm text-gray-400">Date</td>
                  <td class="py-1 w-[220px] text-sm text-gray-400">Name</td>
                  <td class="py-1 w-[150px] text-sm text-gray-400">Email</td>
                  <td class="py-1 text-sm text-gray-400">Status</td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" class="border-b bg-white last:border-none">
                  <td class="py-4">
                    <span class="text-sm font-medium bg-white ">
                      {{ user.id }}
                    </span>
                  </td>
                  <td class="py-4">
                    <span class="text-sm text-gray-400">
                      {{ moment(user.created_at).format("YYYY-MM-DD") }}
                    </span>
                  </td>
                  <td class="py-4">
                    <div class="flex items-center gap-x-2">
                      <img v-bind:src="'/img/' +user.image" alt="" class="h-7 w-7 rounded-full object-cover"/>
                      <span class="text-sm bg-white">
                        {{ user.name }}
                      </span>
                    </div>
                  </td>
                  <td class="py-4">
                    <span class="text-sm bg-white">
                      {{ user.email }}
                    </span>
                  </td>
                  <td class="py-4">
                    <div class="flex items-center justify-center gap-x-2 rounded-10 border py-2 px-1" :class="user.status === 'Successful'? 'border-green-400/10 bg-green-700/20 text-green-400': 'border-indigo-400/10 bg-indigo-700/20 text-indigo-400'">
                      <span class="h-2 w-2 rounded-full" :class=" user.status === 'Successful'? 'bg-green-400': 'bg-indigo-400'" />
                      <span class="text-xs">
                        {{ user.status }}
                      </span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="flex w-2/5 flex-col gap-y-8">
          <div class="flex flex-col justify-between rounded-10 bg-white p-7">
            <div class="flex flex-col gap-y-4 pt-4">
                <div class="flex flex-col justify-between rounded-10  p-7">
                    <div class="flex items-center justify-between">
                    <h2 class="text-[20px] font-medium text-gray-500">
                        User
                    </h2>
                    <button class="inline-flex items-center gap-x-1 rounded-10 border-2 border-sky-400 py-2 px-4 text-sm text-gray-400 hover:bg-gray-500 hover:text-white">
                        View All
                    </button>
                    </div>
                    <table>
                    <tbody>
                        <tr v-for="transaction in recentTransactions" class="border-b bg-white last:border-none">
                        <td class="py-4">
                            <div class="flex items-center gap-x-4">
                            <div class="flex items-center justify-center rounded-full p-2" :class=" transaction.type === 'Send transaction'? 'bg-indigo-700': 'bg-green-400' ">
                                <Component :is="transaction.icon" class="h-5 w-5 fill-current text-gray-900"/>
                            </div>
                            <span class="text-sm bg-white">
                                {{ transaction.type }}
                            </span>
                            </div>
                        </td>
                        <td class="py-4">
                            <div class="flex items-center gap-x-2">
                            <div class="flex items-center justify-center rounded-full bg-white p-2" >
                                <CalendarIcon class="h-6 w-6 stroke-current text-gray-400"/>
                            </div>
                            <span class="text-sm text-gray-400">
                                {{ transaction.date }}
                            </span>
                            </div>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <div v-show="showCreate" class="fixed inset-0 bg-black bg-opacity-25 backdrop-blue-sm flex justify-center items-center">
        <div class="w-[500px]"> 
            <div class="bg-white">
                <h2 class="px-5 py-5 text-center font-bold text-[20px] text-sky-500">Register User</h2>
                <hr class="py-2"/>
                <form  class="flex flex-col space-y-2 " >
                    <input type="text" v-model="form.name" :class="{'is-invalid': errorName}" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5"  placeholder="Enter Name"/>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorName"></span>
                    <input type="email" v-model="form.email" :class="{'is-invalid': errorEmail}" autocomplete class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5"  placeholder="Enter Email"/>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorEmail"></span>
                    <input type="password" v-model="form.password" :class="{'is-invalid': errorPassword}" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5"  placeholder="Enter Password"/>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorPassword"></span>
                    <input type="password" v-model="form.c_password" :class="{'is-invalid': errorCPassword}" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5"  placeholder="Enter Confirm Password"/>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorCPassword"></span>
                    <input type="text" v-model="form.phone" :class="{'is-invalid': errorPhone}" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5"  placeholder="Enter Phone"/>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorPhone"></span> 
                    <input type="file" v-on:change="onChangeImage" :class="{'is-invalid': errorFile}" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5"  placeholder="Enter url"/>
                    <span class="text-red-500 text-[14px] invalid-feedback px-5" v-html="errorFile"></span>
                    <div v-if="form.image">
                        <img v-bind:src="imgPreview" style="margin-left: 30px;" width="180" height="100"/>
                    </div>
                    <div class="flex justify-center items-center ">
                        <button  @click.prevent="createNews" type="submit" class="text-white my-5 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">Create</button>
                        <button @click="closeUser" class="text-white my-5 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">Cancel</button>
                    </div>
              </form>
            </div>
        </div>
    </div>
  </div>
</template>
