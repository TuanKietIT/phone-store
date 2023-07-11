import {createRouter, createWebHistory} from 'vue-router';

import Login from './admin/auth/login.vue';
import Dashboard from './admin/home/component/dashboard.vue';
import Category from './admin/home/component/category.vue';
import Phone from './admin/home/component/phone.vue';
import Laptop from './admin/home/component/laptop.vue';
import Accessory from './admin/home/component/accessory.vue';
import Menu from './admin/home/component/menu.vue';
import Contact from './admin/home/component/contact.vue';
import Location from './admin/home/component/location.vue';
import Page from './admin/home/component/page.vue';
import JobWiki from './admin/home/component/jobWiki.vue';
import Wiki from './admin/home/component/wiki.vue';
import News from './admin/home/component/news.vue';
import Product from './admin/home/component/product.vue';
import HomePage from './page/home/homePage.vue';
import HomePhone from './page/home/homePhone.vue';
import HomeLaptop from './page/home/homeLaptop.vue';
import HomeIpad from './page/home/homeIpad.vue';
import HomeAccessory from './page/home/homeAccessory.vue';
import HomeProduct from './page/home/homeProduct.vue';
import HomeSearchLocation  from './page/component/homeSearchLocation.vue';
import HomeSearchAccessory  from './page/component/homeSearchAccessory.vue';
import HomeSearchLaptop  from './page/component/homeSearchLaptop.vue';
import HomeSearchPhone  from './page/component/homeSearchPhone.vue';
import HomeSearchPrice  from './page/component/searchPrice.vue';
import HomeRegister  from './page/auth/register.vue';

import Error from './notFound.vue';



const routes = [
    //home Pages 
    {
        path:'/',
        name: 'HomePage',
        component: HomePage,
    },
    //home Pages 
    {
        path:'/home/phone',
        name: 'HomePhone',
        component: HomePhone,
    },
    //home Pages 
    {
        path:'/home/laptop',
        name: 'HomeLaptop',
        component: HomeLaptop,
    },
    //home Pages 
    {
        path:'/home/ipad',
        name: 'HomeIpad',
        component: HomeIpad,
    },
     //home Pages 
     {
        path:'/home/accessory',
        name: 'HomeAccessory',
        component: HomeAccessory,
    },
    //Product Post ID
    { 
        path: '/home/product/:id',
        name: 'HomeProduct',
        component: HomeProduct,
    },
    //Product Search  Location
    { 
        path: '/home/location/:id',
        name: 'HomeSearchLocation',
        component: HomeSearchLocation,

    },
    //Product Search Accessory
    { 
        path: '/home/accessory/:id',
        name: 'HomeSearchAccessory',
        component: HomeSearchAccessory,
    },
    //Product Search Laptop
    { 
        path: '/home/laptop/:id',
        name: 'HomeSearchLaptop',
        component: HomeSearchLaptop,
    },
    //Product Search Phone
    { 
        path: '/home/phone/:id',
        name: 'HomeSearchPhone',
        component: HomeSearchPhone,
    },
    //Product Search Phone
    { 
        path: '/home/search/phone/:id',
        name: 'HomeSearchPrice',
        component: HomeSearchPrice,
    },

     //home Pages Register
     {
        path:'/home/register',
        name: 'HomeRegister',
        component: HomeRegister,
    },
    //admin Category 
    {
        path:'/category',
        name: 'Category',
        component: Category,
        meta:{
            requiresAuth:true
        }
    },
     //admin Category Phone
     {
        path:'/category-phone',
        name: 'Phone',
        component: Phone,
        meta:{
            requiresAuth:true
        }
    },
    //admin Category Laptop
    {
        path:'/category-laptop',
        name: 'Laptop',
        component: Laptop,
        meta:{
            requiresAuth:true
        }
    },
    //admin Category Accessory
    {
        path:'/category-accessory',
        name: 'Accessory',
        component: Accessory,
        meta:{
            requiresAuth:true
        }
    },
    //admin Menu
    {
        path:'/menu',
        name: 'Menu',
        component: Menu,
        meta:{
            requiresAuth:true
        }
    },
     //admin Contact
     {
        path:'/contact',
        name: 'Contact',
        component: Contact,
        meta:{
            requiresAuth:true
        }
    },
    //admin Contact
    {
        path:'/location',
        name: 'Location',
        component: Location,
        meta:{
            requiresAuth:true
        }
    },
    //admin Pages
    {
        path:'/page',
        name: 'Page',
        component: Page,
        meta:{
            requiresAuth:true
        }
    },
    //admin Job Wiki
    {
        path:'/job-wiki',
        name: 'JobWiki',
        component: JobWiki,
        meta:{
            requiresAuth:true
        }
    },
    //admin Wiki
    {
        path:'/wiki',
        name: 'Wiki',
        component: Wiki,
        meta:{
            requiresAuth:true
        }
    },
    //admin Post 
    {
        path:'/product',
        name: 'Product',
        component: Product,
        meta:{
            requiresAuth:true
        }
    },
    //admin News
    {
        path:'/news',
        name: 'News',
        component: News,
        meta:{
            requiresAuth:true
        }
    },
    //admin Post 
    {
        path:'/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta:{
            requiresAuth:true
        }
    },
    //admin Login
    {
        path:'/admin',
        name: 'Login',
        component: Login,
    },
    
    //Error
    {
        path:'/:pathMatch(.*)*',
        name: 'Error',
        component:Error,
    }
]






const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to,from)=>{
    if(to.meta.requiresAuth && !localStorage.getItem('token')){
       return { path: 'admin' }
    }
    if(to.meta.requiresAuth == false && localStorage.getItem('token')){
        return { name: 'Dashboard' }
    } 
 })
export default router