<template>
     <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
            <!-- /.card -->
      </div>
          
</template>

<script>
export default {
    data:function(){
            return {



            }
    },
    methods:{
        
        checkForm: function (e) { 
       
           
            e.preventDefault();
        }
    }
}
</script>

<style>

</style>