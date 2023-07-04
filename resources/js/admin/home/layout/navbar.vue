<script setup>
  import SearchIcon from "../icons/search.svg";
  import MailIcon from "../icons/mail.svg";
  import BellIcon from "../icons/bell.svg";
  import InboxIcon from "../icons/inbox.svg";
  import ChevronDownIcon from "../icons/chevron-down.svg";
  import axios from 'axios';
  import { reactive,ref, onMounted } from 'vue'


  const form = reactive({
    name: '',
    image: ''
  });

  const getInfoAdmin = () =>{
    const token = localStorage.getItem('token');
    axios.get('/api/user',{
        headers:{
            Authorization: ' Bearer ' + token
        }
    })
    .then(response => {
        form.name = response.data[0].name;
        form.image = response.data[0].image;
        
    })
  }
  
  onMounted(() => {
     getInfoAdmin();
  })

 

</script>
<template>
      <nav class="flex items-center gap-x-6">
        <div class="flex w-3/5 items-center justify-between">                   
          <div class="flex items-center gap-x-1">
            <div class="relative">
              <span class="pointer-events-none absolute inset-y-0 flex items-center px-3" >
                <SearchIcon class="h-6 w-6 stroke-current text-gray-400" />
              </span>
              <input type="text" placeholder="Search" class="rounded-10 bg-white py-1.5 pr-4 pl-10 text-sm text--400 focus:bg-white focus:outline-none"/>
            </div>
          </div>
        </div>
        <div class="flex w-2/5 items-center justify-between">
          <div class="flex items-center gap-x-2.5">
            <button class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-500 text-gray-400 hover:bg-gray-300 hover:text-white">
              <MailIcon class="h-7 w-7 stroke-current" />
            </button>
            <button class="relative flex h-11 w-11 items-center justify-center rounded-full bg-gray-500 text-gray-400 hover:bg-gray-300 hover:text-white">
              <BellIcon class="h-7 w-7 stroke-current" />
              <div class="absolute top-3 right-3 flex h-2 w-2">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-indigo-400 opacity-75"/>
                <span class="inline-flex h-2 w-2 rounded-full bg-indigo-400" />
              </div>
            </button>
            <button class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-500 text-gray-400 hover:bg-gray-300 hover:text-white">
              <InboxIcon class="h-7 w-7 stroke-current" />
            </button>
          </div>
          <a class="flex h-11 items-center justify-center rounded-full bg-white px-2 text-gray-400 hover:bg-sky-400 hover:text-white">
            <span class="pl-2 text-sm">{{ form.name }}</span>
            <ChevronDownIcon class="h-6 w-6 stroke-current" />
          </a>
        </div>
      </nav>
</template>