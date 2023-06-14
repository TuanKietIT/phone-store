<script setup>

  import EditIcon from "../icons/edit.svg";
  import DeleteIcon from "../icons/delete.svg";
  import PlusIcon from "../icons/plus.svg";
  import sidebar from "../layout/sidebar.vue";
  import navbar from "../layout/navbar.vue";
  import axios from 'axios';
  import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
  import { reactive,ref, onMounted } from 'vue'
  import * as yup from 'yup';
  import moment from "moment";

  const reader = new FileReader();

  const editor = ref(ClassicEditor);
  const editorData = ref('<p>Content of the editor.</p>');
  const editorConfig = ref('<p>Content of the editor.</p>');

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

    const news = ref([]);
    
    const errorDescription = ref('');
    const errorTitle = ref('');
    const errorFile = ref('');
    
    const form = reactive({
        id: '',
        title: '',
        description: '',
        image: '',
        status: 0,
    });
    const imgPreview = ref(null);

    const onChangeImage = (e) => {
        form.image = e.target.files[0];
        reader.addEventListener("load", function () {
            imgPreview = reader.result;
        }.bind(), false);
        if (form.image) {
            if ( /\.(jpe?g|png|gif)$/i.test( form.image.name ) ) {
                reader.readAsDataURL( form.image );
            }
        }
    }


    const createNews = () => {
        const formData = new FormData();
        formData.append('title', form.title);
        formData.append('description', form.description);
        formData.append('status', form.status);
        formData.append('file', form.image);
        axios.post('/api/news/create', formData,{
            headers: {
                'content-type': 'multipart/form-data'
            }
        })
        .then(response =>{
            getNews();
            form.id = '';
            form.description = '';
            form.image = '';
            form.status = 0;
            form.title = '';
            closeNews();
        })
        .catch(function (error){
            if(error.response){
                if (error.response.status === 422) {
                    errorTitle.value = error.response.data.errors.title;
                    errorDescription.value = error.response.data.errors.description;
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
    

    const status = (news) => {
        if(news.status > 0){
            return true;
        }
        else {
            return false;
        }
    }

    const statusTrue = reactive({
        status: 1,
    });
    const statusFalse = reactive({
        status: 0,
    });

    const updateStatus = (news) => {
        form.id = news.id;
        if (news.status == 0) {
           return axios.post(`/api/news/updated/${form.id}`, statusTrue)
            .then(response =>{
                getNews();
                closeNews();
            })
        }
        else {
            return axios.post(`/api/news/updated/${form.id}`, statusFalse)
            .then(response =>{
                getNews();
                closeNews();
            })
        }
        
    }
    const editNews = (news) => {
      showCreate.value = true;
      save.value = false;
      update.value = true;
      form.id = news.id;
      form.description = news.description;
      form.image = news.image;
      form.status = news.status;
      form.title = news.title;
      console.log(form.id)
    }

    const updateNews = () => {
        const formData = new FormData();
        formData.append('description', form.description);
        formData.append('status', form.status);
        formData.append('title', form.title);
        formData.append('file', form.image);
        axios.post(`/api/news/update/${form.id}`, formData,{
            headers: {
                'content-type': 'multipart/form-data'
            }
        })
        .then(response =>{
            getNews();
            form.id = '';
            form.description = '';
            form.image = '';
            form.status = 0;
            form.title = '';
            closeNews();
        })
    };

    const deleteNews  = (news) => {
        const remove = '/api/news/delete/' + news.id;
        axios.delete(remove)
        .then(response =>{
            getJobnews();
        })
    };

    const getNews = () => {
        axios.get('/api/news')
        .then( response => {
            news.value = response.data;
        })
    };

  onMounted(() => {
     getNews();
  })

  const save = ref(false);
  const update = ref(false);

  const showCreate = ref(false);
  const showCreateNews = () => {
    showCreate.value = true;
    save.value = true;
    update.value = false;
  };
  const closeNews = () => {
    showCreate.value = false;
    form.id = '';
    form.description = '';
    form.image = '';
    form.status = 0;
    form.title = '';

  };
 
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
              <h2 class="text-[20px] font-medium bg-white">news</h2>
              <button class="inline-flex items-center gap-x-1 border-double border-4 border-green-600 rounded-10 bg-white py-1.5 px-2 text-sm text-gray-400 hover:bg-green-300 hover:text-white">
                <PlusIcon class="h-6 w-6 stroke-current" />
                <span @click="showCreateNews">Create news</span>
              </button>
            </div>
            <table class="mt-4">
              <thead>
                <tr>
                  <td class="py-1 w-[50px] text-sm text-gray-400">No</td>
                  <td class="py-1 w-[150px] text-sm text-gray-400">Date</td>
                  <td class="py-1 w-[100px] text-sm text-gray-400">Image</td>
                  <td class="py-1 w-[600px] text-sm text-gray-400">Client</td>
                  <td class="py-1 w-[100px] text-center text-sm text-gray-400">Status</td>
                  <td class="py-1 text-sm text-center text-gray-400">Status</td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="news in news" class="border-b bg-white last:border-none">
                  <td class="py-4">
                    <span class="text-sm font-medium bg-white ">
                      {{ news.id }}
                    </span>
                  </td>
                  <td class="py-4">
                    <span class="text-sm text-gray-400">
                        {{ moment(news.created_at).format("YYYY-MM-DD") }}
                    </span>
                  </td>
                  <td class="py-4">
                    <div v-if="news.image" >
                      <img v-bind:src="'/img/' +news.image" alt="" class="h-10 w-10 rounded-full object-cover"/>
                    </div>
                  </td>
                  <td class="py-4 flex items-center gap-x-2">
                    <span  v-html="news.description" class="text-sm mr-10 bg-white description-page"></span>
                  </td>
                  <td class="py-4 text-center" @click="updateStatus(news)">
                      <span class="text-[14px] text-white bg-sky-300 px-10 py-1.5 is-curser">{{ status(news) }}</span>
                  </td>
                  <td class="py-4 flex items-center justify-center">
                    <div class="flex items-center text-center gap-x-2">
                      <div @click.prevent="editNews(news)" class="flex items-center justify-center rounded-full bg-white p-2 hover:text-green-400 focus:text-green-400" >
                          <EditIcon lass="h-6 w-6 stroke-current text-gray-400 cursor-pointer"/>
                      </div>
                      <div @click.prevent="deleteNews(news)" class="flex items-center justify-center rounded-full bg-white p-2 hover:text-red-400 focus:text-red-400" >
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
    <div v-show="showCreate" class="fixed inset-0 bg-black bg-opacity-25 backdrop-blue-sm flex justify-center items-center">
        <div class="w-[800px]"> 
            <div class="bg-white">
                <h2 class="px-5 py-5 text-center font-bold text-[20px] text-sky-500">news Form</h2>
                <hr class="py-2"/>
                <form  class="flex flex-col space-y-2 " >
                    <input type="text" v-model="form.title" :class="{'is-invalid': errorTitle}" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5"  placeholder="Enter title"/>
                    <span class=" text-red-500 text-[14px] invalid-feedback px-5" v-html="errorTitle"></span>
                    <div class=" is-input-start mx-4 flex justify-center items-center bg-gray-100 " :class="{'is-invalid': errorDescription}">
                        <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                    </div>
                    <span class="text-red-500 text-[14px] invalid-feedback  px-5" v-html="errorDescription" ></span>
                    <input type="file" v-on:change="onChangeImage" :class="{'is-invalid': errorFile}" class="outline-0 px-5 py-1 bg-gray-100 is-input-start mx-5"  placeholder="Enter url"/>
                    <span class="text-red-500 text-[14px] invalid-feedback px-5" v-html="errorFile"></span>
                    <div  v-if="form.image">
                        <img v-bind:src="imgPreview" style="margin-left: 30px;" width="180" height="100"/>
                    </div>
                    <div class="flex justify-center items-center ">
                        <button v-show="save" @click.prevent="createNews" type="submit" class="text-white my-5 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">Create</button>
                        <button v-show="update" @click.prevent="updateNews" type="submit" class="text-white my-5 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">update</button>
                        <button @click="closeNews" class="text-white my-5 bg-green-500 hover:bg-green-300 focus:outline-none font-medium text-sm rounded-lg px-5 py-2.5 text-center mr-5">Cancel</button>
                    </div>
              </form>
            </div>
        </div>
    </div>
  </div>
</template>
