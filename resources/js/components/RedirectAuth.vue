<template>

</template>

<script>

    export default {

        data:function () {
                return {
                       

                }
        },
        methods: {
            check: async function ()
            {
              await  this.$user.initUserData().then()
                 if (this.$user.getUser().hasOwnProperty("name")){
                          this.$router.push({name:"dashboard"});
                    }else{
                        this.$router.push({name:"login"});
                    }
            }
        },
        mounted() {
   this.check();
           
         
        }
    }
</script>
