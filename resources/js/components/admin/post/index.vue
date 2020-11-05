<template>
    <div>
            <section class="content pt-5">
      <div class="row">
        <div class="col-12">
          <div class="card">
                <div class="card-header">
                  <p class="text-right">
                <router-link to="/post-create" class="btn btn-primary">
                <span>Add post</span>
                </router-link>
                  </p>
   
            </div>
              
              
 
        
          
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover text-center">
                <thead>
                <tr>
                  <th>Sl No</th>
                  <th>user</th>
                    <th>Category</th>
                    <th>Tilte</th>
                    <th>Description</th>
                    <th>Photo</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               <tr v-for="(post, index) in getallPost" :key="post.id">
                     <td>{{ index+1 }}</td>
                   <td v-if="post.user">{{post.user.name}}</td>
                     <td v-if="post.category">{{post.category.cat_name}}</td>
                    <td>{{ post.title |sortlength(15,"...")}}</td>
                    <td>{{ post.description |sortlength(25,"...") }}</td>
                    <td><img :src="ourImage(post.photo)" alt="" width="40" height="50"></td>
                    <td>
                  
<router-link :to="`/post-edit/${post.id}`" class="btn btn-info color-white">Edit</router-link>
<button class="btn btn-danger" @click.prevent= "deletePost(post.id)">Delete</button>

                         
                    </td>
                  </tr>
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
          </div>

        </section>

    </div>
</template>

<script>
export default {
  name:"List",
  mounted(){
     this.$store.dispatch("allPost");
  },
  computed:{

    getallPost(){
     return this.$store.getters.getPost;
    }
  },
  methods:{
     ourImage(img){
                return "uploadimage/"+img;
            },

deletePost(id){
  axios.get('/post/'+id)
     .then((response)=>{
       this.$store.dispatch("allPost")
       toast.fire({
         icon:'success',
         title:'Post deleted successfully'
       })
     })
}
  }
}
</script>

<style scoped>

</style>