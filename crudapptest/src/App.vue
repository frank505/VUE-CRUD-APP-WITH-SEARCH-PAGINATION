<template>
  <div id="app">
    <div id="nav" class="nav-bar-content">
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
         <a class="nav-link"><router-link to="/">Home</router-link></a>
      </li>
      <li class="nav-item">
          <a class="nav-link"><router-link to="/about">About</router-link></a>
      </li>
      <li class="nav-item">
        <a class="nav-link"><router-link to="/save-post">add</router-link></a>
      </li>
      <li class="nav-item">
       <a class="nav-link"> <router-link to="/view-post">View Post</router-link></a>
      </li>
    </ul>
  </div>
</nav>
   

    </div>

    


    <router-view :url="url"/>
    
  </div>
</template>

<script>


export default {
 name:"app",
 component:{

 },
 
 data() {
   return {
     url:{
       link:"http://localhost/CRUDAPPVUE",
       headers:{
         type: 'application/json',
        Authorization: 'password'
       }
     }
   }
 }, 
}
</script>

<style>
#app {
 /** font-family: 'Avenir', Helvetica, Arial, sans-serif;*/
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 0px;
}
.nav-bar-content{margin-bottom:20px;}
.nav-link > a{color:white !important;font-weight:bolder;}
</style>
