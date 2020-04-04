<template>




</template>
<script>
import * as auth   from '.././api/auth.js'

export default {
  
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
        auth.removeToken();
         this.$router.push({name:"home"})

  }

}
</script>
<style scoped>
</style>
