export default{
    state:{
        category:[],
        post:[],
        BlogPost:[],
        SinglePost:[],
        categories:[]
    },
    getters:{
        getCategory(state){
            return state.category
        },
        getCategories(state){
          return state.categories
      },
        getPost(state){
          return state.post
        },
        BlogPost(state){
          return state.BlogPost
        },
        SinglePost(state){
          return state.SinglePost
        }
    },
    actions:{
        allCategory(contex){
            axios.get('/category')
            .then((response)=>{
              contex.commit('category',response.data.data);
            })
        },
        allCategories(contex){
          axios.get('/categories')
          .then((response)=>{
            contex.commit('categories',response.data.data);
          })
      },

        allPost(contex){
         axios.get('/post')
         .then((response)=>{
           contex.commit('posts',response.data.data)
         })
        },

       BlogPost(contex){
          axios.get('/blog')
          .then((response)=>{
            
            contex.commit('BlogPost',response.data.data)
          })
         },

         SinglePost(contex,payload){
          axios.get('/blog/'+payload)
          .then((response)=>{
            console.log(response.data.data);
            contex.commit('SinglePost',response.data.data)
          })
         },

         getCategoryPost(contex,payload){
          axios.get('/categorypost/'+payload)
          .then((response)=>{
            console.log(response.data.data);     
            contex.commit('categoryPost',response.data.data)
          })
         },

         RealSearch(contex,payload){
          axios.get('/search?s='+payload)
          .then((response)=>{
            console.log(response.data.data);
            contex.commit('RealSearch',response.data.data)
          })
         },
    },

    mutations:{
      category(state,data){
        return state.category = data;
      },
      categories(state,data){
        return state.categories = data;
      },

      posts(state,data){
        return state.post = data
      },
      BlogPost(state,data){
        return state.BlogPost = data
      },
      SinglePost(state,data){
        return state.SinglePost= data;
      },
      categoryPost(state,data){
        return  state.BlogPost = data;
      },
      RealSearch(state,data){
        return  state.BlogPost = data;
      }

    }
    
    
}