<template>
<span id="sidebar">
             <div class="span4">
            <aside class="right-sidebar">
              <div class="widget">
                <form class="form-search">
                  <input @keyup="RealSearch" placeholder="Type something" v-model="keyword" type="text" class="input-medium search-query">
                  <button type="submit" @click.prevent="RealSearch" class="btn btn-square btn-theme">Search</button>
                </form>
              </div>
              <div class="widget">
                <h5 class="widgetheading">Categories</h5>
              
                <ul class="cat" v-for="(category,index) in  getallCategories" :key="category.id">
                  <li><i class="icon-angle-right"></i>
                  <router-link :to="`/categorypost/${category.id}`">{{ category.cat_name }}</router-link><span>({{ category.posts_count}})</span>
                  </li>
                  
                </ul>
              </div>
              <div class="widget">
                <h5 class="widgetheading">Latest posts</h5>
                <ul class="recent">
                   <!-- <li v-for="(post,index) in blogpost"  v-if="index<5"> -->
                  <li v-for="(post,index) in getBlogPost.data"  v-if="index<5">
                  <img :src="ourImage(post.photo)" alt="" class="pull-left" id="sidebar_img">
                    <h6><router-link :to="`/blog/${post.id}`">{{post.title}}</router-link></h6>
                    <p>
                      {{ post.description | sortlength(60,"...") }}
                    </p>
                  </li>

                </ul>
              </div>
              <div class="widget">
                <h5 class="widgetheading">Popular tags</h5>
                <ul class="tags">
                  <li><a href="#">Web design</a></li>
                  <li><a href="#">Trends</a></li>
                  <li><a href="#">Technology</a></li>
                  <li><a href="#">Internet</a></li>
                  <li><a href="#">Tutorial</a></li>
                  <li><a href="#">Development</a></li>
                </ul>
              </div>
            </aside>
          </div>
</span>
</template>
<script>
 import _ from 'lodash'

export default {
           name: "BlogSidebar",
           
                   data(){
           return {
               keyword:''
           }
        },
  mounted(){
     this.$store.dispatch("allCategories");
      this.$store.dispatch("BlogPost");
  },

  computed:{
    getallCategories(){
     return this.$store.getters.getCategories;
    },

    getBlogPost(){
     return this.$store.getters.BlogPost;
    }
  },
    methods:{
     ourImage(img){
                return "uploadimage/"+img;
      },
             RealSearch:_.debounce(function () {
                this.$store.dispatch('RealSearch',this.keyword);
            },1000)
    },


}
</script>