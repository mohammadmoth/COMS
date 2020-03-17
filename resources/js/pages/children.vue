<template>
<div>
          <!-- card-header -->
        <div class="card-header">
          <h3 class="card-title">{{$t("Child Input")}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form">

          <div class="card-body">

            <!-- Child First Name Input-->
            <div class="form-group">
              <label for="firstname">{{$t("Child First Name")}}</label>
              <input type="text" class="form-control" id="firstname" name="firstname"
                :placeholder="$t( 'EnterChildFirstName')">
            </div>
            <!-- Child Last Name Input-->
            <div class="form-group">
              <label for="lastname">{{$t("Child Last Name")}}</label>
              <input type="text" class="form-control form-control-sm" id="lastname" name="lastname"
                :placeholder="$t('EnterChildLastName')">
            </div>
            <!-- Child Father Name Input-->
            <div class="form-group">
              <label for="father">{{$t("Child Father Name")}}</label>
              <input type="text" class="form-control form-control-sm" id="father" name="father"
                :placeholder="$t('EnterChildFatherName')">
            </div>
            <!-- Child Mother Name Input-->
            <div class="form-group">
              <label for="mothername">{{$t("Child Mother Name")}}</label>
              <input type="text" class="form-control form-control-sm" id="mothername" name="mothername"
                :placeholder="$t('EnterChildMotherFirstAndName')">
            </div>
            <!-- Child Phone Number Input-->
            <div class="form-group">
              <label for="phone_number">{{$t("Child Phone Number")}}</label>
              <input type="text" class="form-control form-control-sm" id="phone" name="phone"
                :placeholder="$t('EnterChildPhoneNumber')">
            </div>
            <!-- Child MobliePhone Number Input-->
            <div class="form-group">
              <label for="phone_number">{{$t("ChildMobliePhoneNumber")}}</label>
              <input type="text" class="form-control form-control-sm" id="mobilephone" name="mobilephone"
                :placeholder="$t('EnterChildMobliePhoneNumber')">
            </div>
            <!-- Child Birth Place Input-->
            <div class="form-group">
              <label for="BirthPlace">{{$t("ChildBirthPlace")}}</label>
              <input type="text" class="form-control form-control-sm" id="birthplace" name="birthplace"
                :placeholder="$t('EnterBirthPlaceNumber')">
            </div>
            <!-- Child Birth Date Input-->
            <div class="form-group">
              <label for="BirthDate">{{$t("ChildBirthDate")}}</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="date" name="birthday" id="birthday" class="form-control" data-inputmask-alias="datetime"
                  data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
              </div>
            </div>
            <!--CheckBox For Sponsors-->
            <div class="form-check">
              <label for="sponsorQuestion">{{$t("Is the child sponsored>")}}</label>
              <input v-on:click="hide_unhide_sponsor" type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <!--Input If there is a sponsor-->
            <div class="form-group" v-bind:class="{ hide: hideSponsor }">
              <label for="SponsorAnswer">Sponsore Name</label>
              <input type="text" class="form-control form-control-sm" id="sponsor" name="sponosr"
                :placeholder="$t('EnterSponsorName')">
            </div>
            <!--Sponosr Start and End Date -->
            <div class="form-group" v-bind:class="{ hide: hideSponsor }" >
              <label>Date and time range:</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-clock"></i></span>
                </div>
                <input type="date" name="startSponsor" class="form-control float-right" >
              </div>
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-clock"></i></span>
                </div>
                <input type="date" name="endSponosr" class="form-control float-right" >
            </div>
              <!-- Need Surgery-->
            <div class="form-group" >
                <label for="SurgerQuestion">Does the child need a surgery?</label>
                <input type="checkbox"  v-on:click="hide_unhide_surgery"  class="form-control form-control-sm" name="sponsor"
                  :placeholder="$t('EnterSponsorName')">

              <!-- Surgery Type-->
              <div class="form-group" v-bind:class="{ hide: hideSurgery }">
                <label for="SurgerAnswer">Does the child need a surgery?</label>
                <input type="text" class="form-control form-control-sm" name="sponsorName"
                 :placeholder="$t('Enter Sponsor   Name')">
              </div>
              <!-- /.input group -->
            </div>


          </div>
        </form>



 </div>


</template>
  <script lang="ts">
  import Vue from 'vue'
  export default Vue.extend({

  })
  </script>
