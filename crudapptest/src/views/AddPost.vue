<template>
    <div class="save-post">
        <h1>Add User Details</h1>
        <div class="container">
         
           <div class="form-group">
             <label for="username"></label>
             <input type="text"
               class="form-control" name="" id="username" v-model="username" aria-describedby="helpId" placeholder="add first name">
             <small id="helpId" class="form-text text-muted">Help text</small>
           </div>
            
      <div class="form-group">
        <label for="email"></label>
        <input type="email"
          class="form-control" name="" id="email" v-model="email" aria-describedby="helpId" placeholder="add email">
        <small id="helpId" class="form-text text-muted helper-texts">Help text</small>
      </div>

  <div class="form-group">
    <label for="age"></label>
    <input type="number" name="" id="age" v-model="userage" class="form-control" placeholder="add age" aria-describedby="helpId">
    <small id="helpId" class="text-muted helper-texts">Help text</small>
  </div>

   <div class="form-group">
     <label for="file"></label>
     <input type="file" class="form-control-file" name="" @change="onFileChange" id="file_upload" placeholder="upload image" aria-describedby="fileHelpId">
     <small id="fileHelpId" class="form-text text-muted">Help text</small>
   </div>

    <button type="button" @click="AddNewContent" class="btn btn-primary">Submit</button>
        
        </div>
        
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'add',
  components: {
 
  },
  props:["url"],
  data() {
      return {
          username:"",
          email:"",
          userage:"",
          files:"",
          response:"",
      }
  },

  methods: {

    
   async AddNewContent()
      {
        const AddUser = {
            username:this.username,
            email:this.email,
            userage:this.userage,
            file:this.files,
        }
        // console.log(AddUser)zz
        if(this.username==""){
          alert("username field cannot be left empty")
        }else if(this.email==""){
          alert("email field cannot be left empty")
        }else if(this.userage==""){
          alert("userage cannot be left empty")
        }else if(this.files==""){
          alert("please select a file to be uploaded")
        }else{
    let form_data = new FormData();
        form_data.append("file",this.files);
        form_data.append("username",this.username);
        form_data.append("email",this.email);
        form_data.append("userage",this.userage);
       

        const res_data = await axios({
    method: 'post',
    url: this.url.link+"/add",
    data: form_data,
   //xsrfHeaderName:{headers:this.url.headers},
   headers:{
     'Authorization': this.url.headers.Authorization,
     'content-type':this.url.headers.type,
   }
    })
    .then(function (response) {
        //handle success
        
        console.log(response);
        if(response != undefined){
     if(response.data.hasOwnProperty("error")){
              console.log(response.data.error)
              alert(response.data.error)
          } else{
              console.log(response.data.success)
              alert(response.data.success)
          }
        }else{

        }
    })
    .catch(function (response) {
        //handle error
        console.log(response);
    });
       }
        
      },
      //once file changes return the file object 
      onFileChange(e)
      {
       this.files = e.target.files[0];
         return files;
      }
  },
}
</script>

<style scoped>
    
</style>