# VUE-CRUD-APP-WITH-SEARCH-PAGINATION
CRUD APP with pagination and search pagination with vue js and php REST API
    All you need to do is seperate all the three files apart, and first fo the crudapptest do an npm install
    to install all neccessary dependencies next move the sql database to you sql server and give it the same name
    after that you move the CRUDAPPVUE to your localserver.go to your config folder in the functions class and change the
    function base_url_without_other_route to your own local server url with leaving the name of the file you left on your server 
    example:
    your local server uses port:8000 you can change it to http://localhost:8000/CRUDAPPVUE not changing the CRUDAPPVUE
    file which should be in your local server.
    also in your crudapptest App.vue file change the 
    link object which is a child link link in the data function to your local server where CRUDAPPVUE is and dint forget to add
    CRUDAPPVUE after you server url. after that run npm run serve and there you have it you can see pagination as well as search
    pagination with vue js and pure php oop no frameworks! yeah sometimes we need things like this...
     VUECRUDist is the production file and to produce your own production file simply go to the 
     vue.config.js file and change the sub path to your own path or url and then run npm run build.
