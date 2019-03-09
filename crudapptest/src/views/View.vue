<template>
    <div class="view-post">
        <div class="container">
         <h1>View All Users</h1>
     <div class="form-group">
             <label for=""></label>
             <input type="text" class="form-control" name="" v-model="SearchData" @keyup="SearchUserData" id="" aria-describedby="helpId" placeholder="search here">
             <small id="helpId" class="form-text user-search text-muted">search for a user here</small>
           </div>
           <table class="table table-striped ">
               <thead>
                   <tr>
                       <th style="" class="color-me">name</th>
                       <th>email</th>
                       <th>age</th>
                       <th>photo</th>
                       <th>edit</th>
                       <th>delete</th>
                   </tr>
                   </thead>
                   <tbody>
                       <tr v-bind:key="user_data_get.id"  v-for="user_data_get in data_response.data">
                           <td scope="row">{{ user_data_get.username }}</td>
                           <td>{{ user_data_get.email }}</td>
                           <td>{{ user_data_get.userage }}</td>
                           <td><img :src="getPic(user_data_get.image)"  clas="img_resize" style="height:50px;width:50px;"/></td>
                           <td><button @click="MoveToEditPage" class="btn btn-primary" :id="user_data_get.id">edit</button></td>
                           <td><button @click="DeleteContent" class="btn btn-primary" :id="user_data_get.id">delete</button></td>
                       </tr>
                       
                   </tbody>
           </table>
        
             <nav aria-label="Page navigation" v-bind:class="{ CurrentActive: CurrentActive }">
               <ul class="pagination justify-content-center">
                 <li class="page-item">
                   <a class="page-link"   style="cursor:pointer;"   @click.prevent="ShowFirstData" aria-label="Previous">
                     <span aria-hidden="true"><b>First Page</b></span>
                     <span class="sr-only">{{ data_response.links.first_back }}</span>
                   </a>
                 </li>
                 <li class="page-item">
                   <a class="page-link"   style="cursor:pointer;"   @click.prevent="ShowPrevData" aria-label="Previous">
                     <span aria-hidden="true">&laquo;</span>
                     <span class="sr-only">{{ data_response.links.first_back }}</span>
                   </a>
                 </li>
                 <li class="page-item active"><a class="page-link" ><b>{{ data_response.links.where }}</b></a></li>
                 <li class="page-item">
                   <a class="page-link"  style="cursor:pointer;"  @click.prevent="ShowNextData"   aria-label="Next">
                     <span aria-hidden="true">&raquo;</span>
                     <span class="sr-only">{{ data_response.links.next_Last }}</span>
                   </a>
                 </li>
                 <li class="page-item">
                   <a class="page-link"  style="cursor:pointer;"  @click.prevent="ShowLastData"   aria-label="Next">
                     <span aria-hidden="true">  <b>Last Page</b> </span>
                     <span class="sr-only">{{ data_response.links.next_Last }}</span>
                   </a>
                 </li>
               </ul>
             </nav>
        </div>
           
    </div>
</template>

<script>
import axios from 'axios';
//import qs from 'qs'; not needed anymore wanted to use it to parse string but found a way to do so without it
export default {
     name: 'view',
  components: {
 
  },
  props:["url"],
 data() {
     return {
         data_response:"",
         image_path:"",
         next_url:"",
         last_url:"",
         CurrentActive:false,
         SearchData:"",
     }
 },
 methods: {
   //this is to delete a content
   DeleteContent(e)
   {
 let id = e.target.id;
  let confirm_del = confirm("are you sue you want to delete this content?");
if (confirm_del == true) {
  let formdata = new FormData();
  formdata.append("id",id);
 const res_data = axios({
    method: 'post',
    url: this.url.link+"/delete",
    data: formdata,
   headers:{
     'Authorization': this.url.headers.Authorization,
     'content-type':this.url.headers.type,
   }
    })
    .then((response)=> {
        //handle success
     if(response.data.hasOwnProperty("error")){
       alert(response.data.error);
     }else{
       alert(response.data.success);
        this.data_response.data = this.data_response.data.filter(data=>data.id !== id);
     }
    })
    .catch(function (response) {
        //handle error
        console.log(response);
    }); 

  //alert("deleted")
} else {
  //alert("not deleted");
} 
   },
   MoveToEditPage(e)
   {
    let id = e.target.id;
    //how to pass query parameters like edit?user=a_value
   // this.$router.push({name: 'edit', query: { user: id } }); 
    this.$router.push('/edit/'+id);
   },
       getPic(index) {
    return this.data_response.user_Image_path + index;
  },
  httpgetData(url)
  {
     const res_data = axios({
    method: 'post',
    url: url,
   headers:{
     'Authorization': this.url.headers.Authorization,
     'content-type':this.url.headers.type,
   }
    })
    .then((response)=> {
        //handle success
      this.data_response = response.data;
      console.log(this.data_response.links);
      this.image_path = this.data_response.user_Image_path;
      this.next_url = this.data_response.links.next_last;
      this.prev_url = this.data_response.links.first_back;
      if(this.next_url==null){
        this.CurrentActive = false;
      }
    })
    .catch(function (response) {
        //handle error
        console.log(response);
    }); 
  },
  httpSearch(search_data,url)
  {  
    if(this.search_data==""){
      this.httpgetData(this.url.link+"/search");
    }else{
       let formdata = new FormData();
      formdata.append("search_val", search_data);
     const res_data = axios({
    method: 'post',
    url: url,
     data: formdata,
   headers:{
     'Authorization': this.url.headers.Authorization,
     'content-type':this.url.headers.type,
   }
    })
    .then((response)=> {
        console.log(response)
      this.data_response = response.data;
      console.log(this.data_response.links);
      this.image_path = this.data_response.user_Image_path;
       console.log(this.data_response.data)
      //to get the last id we perform a for loop here
      this.next_url = this.data_response.links.next_last;
      this.prev_url = this.data_response.links.first_back;
      if(this.next_url==null){
        this.CurrentActive = false;
      }
    })
    .catch(function (response) {
        //handle error
        console.log(response);
    });
    }
     
  },
  //if search input is empty and next is clicked fetch the next data but if there is a search
  //content entered and next is clicked return the next of the searched content
  ShowNextData()
  {
    if(this.SearchData==""){
     if(this.next_url[0]==null)
    {

    }else{
    this.httpgetData(this.next_url[0]);
    }
    }else{
      if(this.next_url[0]==null){

      }else{
     this.httpSearch(this.SearchData,this.next_url[0]);
      }
     
    }
     
  
        
  },
  ShowPrevData()
  {
    if(this.SearchData==""){
   if(this.prev_url[1]==null)
   {

   } else{
    this.httpgetData(this.prev_url[1]);
   }
    }else{
    if(this.prev_url[1]==null)
   {

   } else{
    this.httpSearch(this.SearchData,this.prev_url[1]);
   }  
    }
   
  },
  ShowLastData()
  {
    if(this.SearchData==""){
      if(this.next_url[1]==null){

    }else{
    this.httpgetData(this.next_url[1]);
    }
    }else{
      if(this.next_url[1]==null){

      }else{
        this.httpSearch(this.SearchData,this.next_url[1]);
      }
    }
   
  },
  ShowFirstData()
  {
    if(this.SearchData==""){
    if(this.prev_url[0]==null){

    }else{
      this.httpgetData(this.prev_url[0]);
    }
    }else{
      if(this.prev_url[0]==null){

      }else{
        this.httpSearch(this.SearchData,this.prev_url[1]);
      }
    }
     
  },
  SearchUserData()
  {
    if(this.SearchData=="")
    {

    }else{
      let formdata = new FormData();
      formdata.append("search_val", this.SearchData);
     const res_data = axios({
    method: 'post',
    url: this.url.link+"/search",
     data: formdata,
   headers:{
     'Authorization': this.url.headers.Authorization,
     'content-type':this.url.headers.type,
   }
    })
    .then((response)=> {
        console.log(response)
      this.data_response = response.data;
      console.log(this.data_response.links);
      this.image_path = this.data_response.user_Image_path;
       console.log(this.data_response.data)
      this.next_url = this.data_response.links.next_last;
      this.prev_url = this.data_response.links.first_back;
      if(this.next_url==null){
        this.CurrentActive = true;
      }else{
        this.CurrentActive =false;
      }
     
    })
    .catch(function (response) {
        //handle error
        console.log(response);
    }); 
    }
  }
 },
 created() {
     const res_data = axios({
    method: 'post',
    url: this.url.link+"/view",
   headers:{
     'Authorization': this.url.headers.Authorization,
     'content-type':this.url.headers.type,
   }
    })
    .then((response)=> {
        //handle success
      this.data_response = response.data;
      console.log(this.data_response.links);
      this.image_path = this.data_response.user_Image_path;
      this.next_url = this.data_response.links.next_last;
      this.prev_url = this.data_response.links.first_back;
      if(this.next_url==null){
        this.CurrentActive = true;
      }
     
    })
    .catch(function (response) {
        //handle error
        console.log(response);
    });
 },
}
</script>


<style scoped>
.CurrentActive{display:none;}
</style>
