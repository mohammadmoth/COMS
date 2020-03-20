<template>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
         <router-link  class="nav-link" :to="{ name: 'home'}"><a >{{$t("homepage")}} </a></router-link>
      </li>
   
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
  
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
   <router-link  class="brand-link" :to="{ name: 'home'}"><a >
      <img src="/dist/img/c-seeklogo.com.svg" alt="COMS Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">COMS</span>
    </a></router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{$user.getUser().name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <NavBarItem :activeItem="false" iconName="list-alt" routeName="dashboard" name="status"></NavBarItem>
          <NavBarItem :activeItem="false" iconName="child" routeName="children" name="children"></NavBarItem>
          <NavBarItem :activeItem="false" iconName="user-shield" routeName="sponsers" name="sponsers"></NavBarItem>

          
          <NavBarItem :activeItem="false" iconName="child" routeName="children" name="children"></NavBarItem>
          <NavBarItem :activeItem="false" iconName="child" routeName="children" name="children"></NavBarItem>
          <li class="nav-header" v-show="$user.getUser().rules=='admin'" >{{$t("admin_nav")}}</li>
          <li class="nav-item" v-show="$user.getUser().rules=='admin'" >
          <NavBarItem :activeItem="false" iconName="users" routeName="users" name="users" ></NavBarItem>
          </li>
          <li class="nav-header">{{$t("GithubAnyErrorOrSendHere")}}</li>
          <li class="nav-item">
            <a href="https://github.com/MohammadMOTH/COMS" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>{{$t("Documentation")}}</p>
            </a>
          </li>
        
        
     
         

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$t($route.meta.title)}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{$t("Home")}}</a></li>
              <li class="breadcrumb-item active">{{$t($route.meta.title)}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content"> 
      <div class="container-fluid">
      <router-view/>
           </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-{{ new Date() | moment("YYYY") }} COMS <a href="https://github.com/MohammadMOTH/COMS"></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>{{$t('Version')}}</b> {{$Version}}
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

</template>

<script>
import Vue from 'vue'
import NavBarItem from '.././components/NavBarItem.vue'
export default {
  components: {
    NavBarItem,
  },
        data:function () {
                return {
                   

                }
        },
        methods: {
              init: async function () {
               await Vue.user.initUserData().then()
                 }

        },
        mounted() { 
      
            this.init()
  

        }
    }
</script>
