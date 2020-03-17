<template>


  <div class="container  ">

    <div><label for="uname"><b>{{$t("email")}}</b></label>
    <input  @keyup.enter="login" :disabled="!enb" v-model="email" type="text" :placeholder="$t('enter-email')" name="uname" required>
    </div>
    <div>
    <label for="psw"><b>{{$t('password')}}</b></label>
    <input @keyup.enter="login" :disabled="!enb" v-model="password" type="password" :placeholder="$t('enter-Password')" name="psw" required>
        </div>
    <button :disabled="!enb" @keyup.enter="login" @click="login" type="submit">{{$t('login')}}</button>
    <label>
      <input  type="checkbox" checked name="remember"> {{$t('remember-me')}}
    </label>
  </div>




</template>
<script>
import * as auth   from '.././api/auth.js'

export default {
  props: ['personName'],
 data: function() {
  return {
    message: '',
    email : "",
    password:"",
    enb : true,
    dialog: false,
    mesgbox:""
  };
},
  methods:{
          showMsgBoxTwo() {
              $.alert({
	    title: this.$t("error"),
	    content: this.$t("error_password_or_username"),


	    typeAnimated: true,
	    buttons: {
	        tryAgain: {
	            rtl: true,
	            text: this.$t("try_agein"),
	            btnClass: 'btn',
	            action: function(){
	            }
	        }

	    }
    });


      },
    showmessge()
    {
         this.showMsgBoxTwo();

    },
    login() {


        this.enb = false;
    axios
      .post('/api/login' ,{email:this.email
        ,password:this.password
         })
      .then(response => {
          auth.setToken(response.data.success.token);
        this.$router.push({name:"dashboard"})
     //   this.enb= true
        })
      .catch(e => {
        this.enb= true
         this.showmessge();
                    console.log(e)

            });

    }
  },
    mounted () {
     this.enb= false
    if ( auth.getToken())
    axios
      .post('/api/details' ,{},{headers: {
    'Authorization': `Bearer ${auth.getToken()}`
        }
         })
      .then(response => (   this.$router.push({name:"dashboard"})  ) ) .catch( );

     this.enb= true
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
