<template>
   <div>

    <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">
            <article>
              <div class="row">
                <div class="span8">
                  <div class="post-image">
                    <div class="post-heading">
                      <h3><a href="#">{{ singlepost.title }}</a></h3>
                    </div>
                  <img :src="`uploadimage/${singlepost.photo}`" alt="" />
                  </div>
                  <p>
                    {{ singlepost.description }}
                  </p>
 
                  <div class="bottom-article">
                    <ul class="meta-post">
                            <li><i class="icon-calendar"></i><a href="#"> {{singlepost.created_at | timeFormat }}</a></li>
                      <li v-if="singlepost.user"><i class="icon-user"></i><a href="#">{{singlepost.user.name}}</a></li>
                     
                      <li v-if="singlepost.category"><i class="icon-folder-open"></i><a href="#">{{ singlepost.category.cat_name }}</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </article>

      
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

    name:"SinglePost",
            components:{
          BlogSidebar,
        },

mounted(){
   this.SinglePost()
},

computed:{
    singlepost(){
    return this.$store.getters.SinglePost
    }
},

methods:{
        SinglePost(){
         this.$store.dispatch("SinglePost",this.$route.params.id)
      },


},

watch:{
    $route(to,from){
        this.SinglePost();
    }
}

}
</script>