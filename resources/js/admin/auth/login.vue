<template>
    <div class="w-full h-screen bg-gray-100 flex justify-center items-center">
        <div class="lg:w-1/4 2xl:w-1/4 p-10 bg-white">
            <p class="text-danger text-red-500" v-if="error">{{ error }}</p>
            <div class="space-y-5">
              <h1 class="text-center text-3xl text-green-500 font-bold">Login</h1>
              <form class="flex flex-col space-y-5" @submit.prevent="login">
                <input type="email" v-model="form.email" class="outline-0 px-5 py-2 bg-gray-100"  placeholder="Enter Email"/>
                <input type="password" v-model="form.password" class="outline-0 px-5 py-2 bg-gray-100" placeholder="Enter PassWord"/>
                <div class="flex flex justify-between items-center">
                      <div class="flex items-center space-x-2">
                          <input type="checkbox" />
                          <p class="text-sm">Remember</p>
                      </div>
                      <a class="text-sm">Forget password?</a>
                </div>
                <button class="p-2 bg-sky-300 text-xl text-white font-boil rounded-md drop-shadow-md hover:bg-sky-500">Sign In</button>
              </form>
              <div class="space-y-5">
                <p class="text-center">OR Register</p>
              </div>
            </div>
        </div>   
    </div>     
</template>

<script>
    import { reactive,ref } from 'vue'
    import { useRouter } from "vue-router"
    import axios from 'axios';
    export default{
        setup(){
           const router = useRouter();

           let form = reactive({
              email: '',
              password: '',
           });

           let error = ref('');
           const login = async () => {
               await axios.post('/api/login', form).then( res => {
                  if(res.data.success) {
                     localStorage.setItem('token', res.data.data.token)
                    router.push({name: 'Dashboard'})
                  } 
                  else{
                     error.value = res.data.message;
                  }
               })
           }

           return{
             form,
             login,
             error
           }
        }
    }
</script>