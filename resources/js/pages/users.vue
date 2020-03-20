<template>
<div>
  <div >
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{$t("user")}}</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="usersData" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>{{$t("name")}}</th>
              <th>{{$t("email")}}</th>
              <th>{{$t("rules")}}</th>
              <th>{{$t("lastlogin")}}</th>
              <th>{{$t("event")}}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user ,index) in users" :key="index" >
              <td><input :key="index" type = "text" @click="show(user.name)" v-model="user.name" style="border: 0px none;" class = "txt_input"> </td>
              <td>
             {{user.email}}
              </td>
              <td>     {{user.rules}}</td>
              <td> {{user.lastlogin}}</td>
              <td>X</td>
            </tr>
          
          </tbody>
          <tfoot>
            <tr>
              <th>{{$t("name")}}</th>
              <th>{{$t("email")}}</th>
              <th>{{$t("rules")}}</th>
              <th>{{$t("lastlogin")}}</th>
              <th>{{$t("event")}}</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
  <!-- /.col -->
   <div class="col">
            <!-- general form elements -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{$t("SponsorForm")}}</h3>
                </div>
                <!-- /.card-header -->
                
                <!-- form start -->
                <form @submit="checkForm" role="form">
                        <div class="card-body">
                        <!--Firstname Input-->
                        <div class="form-group">
                            <label for="SponosorFirstname">{{$t("FirstName")}}</label>
                            <input type="text" name="firstname" class="form-control"  :placeholder="$t('EnterFirstName')">
                        </div>
                        
                        <!---->
                        <div class="form-group">
                            <label for="SponsorLastName">{{$t("LastName")}}Last Name</label>
                            <input type="text" name="lastname" class="form-control"  :placeholder="$t('EnterLastName')">
                        </div>
                        
                        <!---->
                        <div class="form-group">
                            <label for="SponosrMobilePhone"> {{$t("MobileNumber")}}</label>
                            <input type="text" name="mobilephone" class="form-control"  :placeholder="$t('EnterMobileNumber')">
                        </div>
                        
                        <!---->
                        <div class="form-group">
                            <label for="PhoneNumber">{{$t('PhoneNumber')}}</label>
                            <input type="text" name="phone" class="form-control"  :placeholder="$t('EnterPhoneNumber')">
                        </div>
                        
                        <!---->
                        <div class="form-group">
                            <label for="SponsorAdditionalInfo">{{$t('EnterSponsorAdditionalInformation')}}</label>
                            <input type="text" name="infoSponser" class="form-control"  :placeholder="$t('EnterSponsorAdditionalInformation')">
                        </div>
                        
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                </form>
            </div>
            <!-- /.card -->
      </div>

  </div>
</template>

<script>
export default {
  data: function() {
    return {
      
      users:[{id:1,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:2,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:3,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:4,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:5,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:6,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:7,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:8,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:9,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:10,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },   
       {id:11,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:12,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:13,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:14,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:15,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:16,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:17,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:18,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },
      {id:19,name: "mohammad" , rules:"admin"  ,email:"mgreog" , lastlogin:"2020/25/25 51" },],
    
    
    };
  },
  methods: {show:function(mess)
  {

    console.log(mess);
  },
    checkForm: function(e) {
      e.preventDefault();
    }
  }
};
</script>

<style>
</style>