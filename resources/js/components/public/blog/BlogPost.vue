<template>
   <div>

    <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">

           
             <div v-if="getBlogPost.length>0">
            <article v-for="(blog, index) in getBlogPost" :key="blog.id" v-if="index<4">
              <div class="row">
                <div class="span8">
                  <div class="post-image">
                    <div class="post-heading">
                      <h3><a href="#">{{ blog.title }}</a></h3>
                    </div>
               <img :src="ourImage(blog.photo)" alt="Blog photo">
                  </div>
                  <p>
                   
                    {{blog.description |sortlength(200,"...")}}
                  </p>
                  <div class="bottom-article">
                    <ul class="meta-post">
                      <li><i class="icon-calendar"></i><a href="#"> {{blog.created_at | timeFormat }}</a></li>
                      <li v-if="blog.user"><i class="icon-user"></i><a href="#">{{blog.user.name}}</a></li>
                      <li><i class="icon-folder-open"></i><a href="#">{{blog.category.cat_name}}</a></li>
                      <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                    </ul>
                    <!-- <router-link :to="`/post-edit/${post.id}`" class="btn btn-info color-white">Edit</router-link> -->
                    <router-link :to="`/blog/${blog.id}`" class="pull-right">Continue reading <i class="icon-angle-right"></i></router-link>
                  </div>
                </div>
              </div>
            </article>
     
            
            <div id="pagination">
              <span class="all">Page 1 of 3</span>
              <span class="current">1</span>
              <a href="#" class="inactive">2</a>
              <a href="#" class="inactive">3</a>
            </div>
      </div>
            <div v-else>
             <p class="alert alert-info text-center">Sorry no post found</p>
            </div>
          </div>
          <BlogSidebar/>
        </div>
      </div>
    </section>
   </div>
</template>

<script>
 import BlogSidebar from "./BlogSidebar"

export default {
        name: "BlogPost",

        components:{
          BlogSidebar,
        },

  mounted(){
     this.$store.dispatch('BlogPost');
  },


computed:{
getBlogPost(){
return this.$store.getters.BlogPost
}
},
methods:{
getAllCategoryPost(){
if(this.$route.params.id!=null){
this.$store.dispatch('getCategoryPost',this.$route.params.id);
}else{
this.$store.dispatch('BlogPost');
}

},
ourImage(img){
          return "uploadimage/"+img;
      }, 
},
watch:{
$route(to,from){
this.getAllCategoryPost();
}
}
}
</script>

<style scoped>
</style>



