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
                })  .then(response => {   })
                .catch(e => {
                    this.$router.push("login");
                  //  console.log(e);
                
            })
    }else{
        this.$router.push("login");
    }

           
         
        }
    }
</script>
