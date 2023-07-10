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
    //admin Category 
    {
        path:'/category',
        name: 'Category',
        component: Category,
    },
     //admin Category Phone
     {
        path:'/category-phone',
        name: 'Phone',
        component: Phone,
    },
    //admin Category Laptop
    {
        path:'/category-laptop',
        name: 'Laptop',
        component: Laptop,
    },
    //admin Category Accessory
    {
        path:'/category-accessory',
        name: 'Accessory',
        component: Accessory,
    },
    //admin Menu
    {
        path:'/menu',
        name: 'Menu',
        component: Menu,
    },
     //admin Contact
     {
        path:'/contact',
        name: 'Contact',
        component: Contact,
    },
    //admin Contact
    {
        path:'/location',
        name: 'Location',
        component: Location,
    },
    //admin Pages
    {
        path:'/page',
        name: 'Page',
        component: Page,
    },
    //admin Job Wiki
    {
        path:'/job-wiki',
        name: 'JobWiki',
        component: JobWiki,
    },
    //admin Wiki
    {
        path:'/wiki',
        name: 'Wiki',
        component: Wiki,
    },
    //admin Post 
    {
        path:'/product',
        name: 'Product',
        component: Product,
    },
    //admin News
    {
        path:'/news',
        name: 'News',
        component: News,
    },
    //admin Post 
    {
        path:'/dashboard',
        name: 'Dashboard',
        component: Dashboard,
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


export default router