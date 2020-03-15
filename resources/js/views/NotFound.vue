<template>
  

  <div class="container  ">
       {{$t("error404")}}
      <router-link :to="{ name: 'home'}"><a  >{{$t("homepage")}}</a></router-link>
  </div>


</template>
<script>
import * as auth   from '.././api/auth.js'

export default {
  props: ['personName'],
 data: function() {
  return {
    message: ''
  };
},
  methods:{

    login() {
    }
  },
    mounted () {
     console.log(auth.getToken());
    if ( auth.getToken())
    axios
      .post('/api/details' ,{headers: {
    'Authorization': `Bearer ${token}`
        },email:"admin"
        ,password:"123456"
         })
      .then(response => (this.info = response));


  }

}
</script>
<style scoped>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
  max-width: 360px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

  h2 {
    font-size: 40px;
    color: mediumseagreen;
  }
</style>