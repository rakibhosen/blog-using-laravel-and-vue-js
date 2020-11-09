import adminHome from './components/admin/adminHome.vue'
import categoryList from './components/admin/category/index'
import categoryCreate from './components/admin/category/create'
import categoryEdit from './components/admin/category/edit'
import postList from './components/admin/post/index'
import postCreate from './components/admin/post/create'
import postEdit from './components/admin/post/edit'
import PublicHome from './components/public/PublicHome.vue'
import BlogPost from './components/public/blog/BlogPost.vue'
import SingleBlog from './components/public/blog/SingleBlog'
import Contact from './components/public/contact/Contact'
import About from './components/public/about/About'



export const routes = [
  // admin route
    { path: '/dashboard', component: adminHome },
    { path: '/category-list', component: categoryList },
    { path: '/category-create', component: categoryCreate },
    { path: '/category-edit/:categoryid', component: categoryEdit },
    // post route
    { path: '/post-list', component: postList },
    { path: '/post-create', component: postCreate },
    { path: '/post-edit/:postid', component: postEdit },

    // frontend route
    {
      path:'/',
      component:PublicHome
  },
  {
      path:'/blog',
      component:BlogPost
  },

  { 
   path: '/blog/:id',
   component: SingleBlog
   },

   { 
    path: '/categorypost/:id',
    component:BlogPost
    },

    { 
    path: '/about',
    component:About
    },
    { 
    path: '/contact',
    component:Contact
    },
  


  ]