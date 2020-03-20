<template>
<div class="row">
 <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{$t("SponsorForm")}}</h3>
                </div>
                <!-- /.card-header -->
                
                <!-- form start -->
                <form role="form">
                        <div class="card-body">
                        <!--Firstname Input-->
                        <div class="form-group">
                            <label for="SponosorFirstname">Sponsor First Name</label>
                            <input type="text" name="firstname" class="form-control"  >
                        </div>
                        
                        <!---->
                        <div class="form-group">
                            <label for="SponsorLastName">Sponsor Last Name</label>
                            <input type="text" name="lastname" class="form-control"  >
                        </div>
                        
                        <!---->
                        <div class="form-group">
                            <label for="SponosrMobilePhone"> Sponosr Mobile Phone</label>
                            <input type="text" name="mobilephone" class="form-control"  >
                        </div>
                        
                        <!---->
                        <div class="form-group">
                            <label for="PhoneNumber">Sponsor Phone Number</label>
                            <input type="text" name="phone" class="form-control"  >
                        </div>
                        
                        <!---->
                        <div class="form-group">
                            <label for="SponsorAdditionalInfo">Additional Sponospr Info</label>
                            <input type="text" name="infoSponser" class="form-control"  placeholder="">
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
    
</div>
          
</template>

<script>
export default {

}
</script>

<style>

</style>