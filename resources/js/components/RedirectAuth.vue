<template>

</template>

<script>
import * as auth   from '.././api/auth.js'
    export default {

        data:function () {
                return {
                       

                }
        },
        mounted() {
    if ( auth.getToken()){
            axios
                .post('/api/details' , {},{
                    headers: {
            'Authorization': `Bearer ${auth.getToken()}`
                } ,
                })  .then(response => {  this.$router.push({name:"dashboard"})  })
                .catch(e => {
                    this.$router.push("login");
            })
    }else{
        this.$router.push("login");
    }

           
         
        }
    }
</script>
