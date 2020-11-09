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
                  <img :src="`uploadimage/${singlepost.photo}`" alt="" id="blog_img"/>
                  </div>
                  <p>
                    {{ singlepost.description }}
                  </p>
                <div class="comment_box">
                  <form role="form" @submit.prevent="addComment()">
                <div class="card-body">
                  <div class="form-group">
                    <label for="category">Coment here</label>
    
                     <textarea 
                        v-model="form.comment_body"
                        id="" cols="30" rows="5" 
                        lass="form-control"
                        :class="{ 'is-invalid': form.errors.has('comment_body') }">
                     </textarea>
                     <has-error :form="form" field="comment_body"></has-error> 
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
              </div>

            <div class="comment_body">
              <div v-if="allComments.length>0">
              <div style="border-bottom:1px #ccc solid; padding:10px;" class="card" v-for="(comment,index) in allComments" key="comment.id">
                <div class="card-header"><b>{{comment.user.name}}</b></div>
                <div class="card-body">
                  <p style="padding-left:20px">{{comment.comment_body}}</p>
                </div>
                <ul>
                 <li style="list-style:none"><i class="icon-calendar"></i><a href="#"> {{comment.created_at | timeFormat }}</a></li>
                </ul>
              </div>
              </div>
              <div v-else>
                <p>No comment yet</p>
              </div>
            </div>
 
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
         data(){
         return{
             form : new Form({
                 comment_body:'',
                 post_id:this.$route.params.id,
             })

         }
     },
            components:{
          BlogSidebar,
        },

mounted(){
  // console.log('/blog/'+this.$route.params.id)
   this.SinglePost();
   this.PostComment();
},

computed:{
    singlepost(){
    return this.$store.getters.SinglePost
    },
    allComments(){
      return this.$store.getters.PostComments
    }

},

methods:{
        SinglePost(){
         this.$store.dispatch("SinglePost",this.$route.params.id)
      },

      addComment(){
                 this.form.post('/addcomment')
         .then((response)=>{
           this.form.comment_body=''
            
             
            toast.fire({
            icon: 'success',
            title: 'comment added'
            })
              this.PostComment();

         })
         .catch(()=>{

         })
      },
        PostComment(){
         this.$store.dispatch("PostComment",this.$route.params.id)
      },


},

watch:{
    $route(to,from){
        this.SinglePost();
        // this.PostComment();
    }
}

}
</script>