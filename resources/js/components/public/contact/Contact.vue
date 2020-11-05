<template>
<div>
        <section id="content">
     

      <div class="container">
        <div class="row">
          <div class="span12">
            <h4>Get in touch with us by filling <strong>contact form below</strong></h4>

            <form  role="form" class="contactForm" @submit.prevent="userMessage()">
              <div id="sendmessage">Your message has been sent. Thank you!</div>
              <div id="errormessage"></div>

              <div class="row">
                <div class="span4 form-group">
                  <input type="text" v-model="form.name" class="form-control" id="name" placeholder="Your Name" :class="{ 'is-invalid': form.errors.has('name') }"  />
                   <has-error :form="form" field="name"></has-error>
                </div>
                <div class="span4 form-group">
                  <input type="email" class="form-control" v-model="form.email" id="email" placeholder="Your Email" :class="{ 'is-invalid': form.errors.has('email') }"  />
                     <has-error :form="form" field="email"></has-error>
                </div>
                <div class="span4 form-group">
                  <input type="text" class="form-control" v-model="form.subject" id="subject" placeholder="Subject"  :class="{ 'is-invalid': form.errors.has('subject') }" />
                     <has-error :form="form" field="subject"></has-error>
                </div>
                <div class="span12 margintop10 form-group">
                  <textarea class="form-control" v-model="form.message" rows="12" data-rule="required"  placeholder="Message" :class="{ 'is-invalid': form.errors.has('message') }" ></textarea>
                     <has-error :form="form" field="message"></has-error>
                  <p class="text-center">
                    <button class="btn btn-info btn-large" type="submit">Submit message</button>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
</div>
    
</template>

<script>

export default {
    name:"Contact",
    data(){
        return{
            form:new Form({
                name:'',
                email:'',
                subject:'',
                message:'',
            })
        }
    },

    methods:{
            userMessage(){
                this.form.post('/userMessage')
                    .then((response)=>{
                        console.log(response.data.data)
                      toast.fire({
            icon: 'success',
            title: 'Message sent '
            })
                    })
                    .catch(()=>{

                    })
            }
    }

}
</script>

     data(){
         return{
             form : new Form({
                 cat_name:'',
             })

         }
     },
    //  methods:{
    //  addCategory(){
    //      this.form.post('/add-category')
    //      .then((response)=>{
    //         this.$router.push('/category-list');
    //         toast.fire({
    //         icon: 'success',
    //         title: 'Category inserted successfully'
    //         })

    //      })
    //      .catch(()=>{

    //      })
    //  }
    //  }