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

  }

}
</script>
<style scoped>
</style>
