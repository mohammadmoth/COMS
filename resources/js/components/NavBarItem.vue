<template>
<li class="nav-item">
    <router-link   :to="{ name: routeName}">
  <a class="nav-link" :class="activeItem|setActive">
    <i class="nav-icon" :class="iconName|setIcon"></i>
    <p>
      {{$t(name)}}
    <!--  <span class="right badge badge-danger">New</span>--> 
  </p>
  </a></router-link>
</li>

</template>

<script>

    export default {
      name:"NavBarItem",
              props: {'activeItem':Boolean , 'iconName':String,'routeName':String ,'name':String  } ,
        data() {
                return {
                 
                }
        },filters: {
            setActive: function (value) {
         if (value )
         return "active"
         else
         return ""
            },setIcon: function (value) {
      
         return "fas fa-" + value;
       
            },
          },
        methods: {
         
        }, created () {

        
        },
        mounted() {
  
           
         
        }
    }
</script>
