<template>
  <div class="row">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">DataTable with default features</h3>
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
            <tr>
              <td>Trident</td>
              <td>
                Internet
                Explorer 4.0
              </td>
              <td>Win 95+</td>
              <td>4</td>
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
  <!-- /.col -->
</template>

<script>
export default {
  data: function() {
    return {};
  },
  methods: {
    checkForm: function(e) {
      e.preventDefault();
    }
  }
};
</script>

<style>
</style>