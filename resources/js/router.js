import {createRouter, createWebHistory} from 'vue-router';

import Login from './admin/auth/login.vue';
import Dashboard from './admin/home/component/dashboard.vue';
import Category from './admin/home/component/category.vue';
import Menu from './admin/home/component/menu.vue';
import Contact from './admin/home/component/contact.vue';
import Location from './admin/home/component/location.vue';
import Page from './admin/home/component/page.vue';
import JobWiki from './admin/home/component/jobWiki.vue';
import Wiki from './admin/home/component/wiki.vue';
import News from './admin/home/component/news.vue';
import Error from './notFound.vue';



const routes = [
    //admin Category 
    {
        path:'/category',
        name: 'Category',
        component: Category,
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
        path:'/login-admin',
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