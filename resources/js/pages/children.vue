<template>
  <div>
    <div class="row">

      <div class="col">
      
        <div class="card card-primary">
      
          <div class="card-header">
            <h3 class="card-title">{{$t("ChildrenTable")}}</h3>
          </div>
          <!-- Card Body For table-->
          <div class="card-body">
            <table
              id="example1"
              class="table table-bordered table-striped dataTable"
              role="grid"
              aria-describedby="example1_info"
            >
              <tr role="row" class="odd">
                <td>:{{$t("PersonalInformation")}}</td>
                <td>:{{$t("ContactInfo")}}</td>
                <td>:{{$t("BirthInfo")}}</td>
                <td>:{{$t("isSponsored")}}</td>
                <td>:{{$t("needSurgery")}}</td>
                <td>:{{$t("ExtraInformation")}}</td>
                <td>:{{$t("editButton")}}</td>
              </tr>
              <tr role="row" class="even">
                <td>
                  <b>:{{$t("firstName")}} :</b>
                  <br />
                  <b>:{{$t("lastName")}} :</b>
                  <br />
                  <b>:{{$t("fatherName")}}:</b>
                  <br />
                  <b>:{{$t("motherName")}}:</b>
                  <br />
                  <b>:{{$t("MobilePhone")}}</b>
                </td>

                <td>
                  <b>:{{$t("MobilePhone:")}} </b>
                  <br />
                  <b>:{{$t("Phone:")}} </b>
                  <br />
                </td>
                <td>
                  <b>:{{$t("Age:")}} </b>
                  <br />
                  <b>:{{$t("BirthDate:")}} </b>
                  <br />
                  <b>:{{$t("BirhPlace:")}} </b>
                  <br />
                </td>
                <td>
                  <b>:{{$t("SponsorName")}} :</b>
                  <br />
                  <b>:{{$t("SponsorStart")}} :</b>
                  <br />
                  <b>:{{$t("SponsorEnd")}} :</b>
                  <br />
                </td>
                <td>:{{$t("TypeOfSurgery:")}} </td>
                <td>
                  <br />
                  <br />
                  :{{$t("ExtraInformation")}}
                  <br />
                  <br />
                </td>
                <td>
                  <div class="btn-group show">
                    <button type="button" class="btn btn-info btn-flat">Action</button>
                    <button
                      type="button"
                      class="btn btn-info btn-flat dropdown-toggle dropdown-icon"
                      data-toggle="dropdown"
                      aria-expanded="true"
                    >
                      <span class="sr-only">Toggle Dropdown</span>
                      <div
                        class="dropdown-menu show"
                        role="menu"
                        x-placement="top-start"
                        style="position: absolute; transform: translate3d(-1px, -206px, 0px); top: 0px; left: 0px; will-change: transform;"
                      >
                        <a class="dropdown-item" href="#">Delete</a>
                        <a class="dropdown-item" href="#">Edit</a>
                      </div>
                    </button>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">{{$t("Child Input")}}</h3>
          </div>
          <form role="form">
            <div class="card-body">
              <!-- Child First Name Input-->
              <div class="form-group">
                <label for="firstname">{{$t("Child First Name")}}</label>
                <input
                  type="text"
                  class="form-control"
                  id="firstname"
                  name="firstname"
                  :placeholder="$t( 'EnterChildFirstName')"
                />
              </div>
              <!-- Child Last Name Input-->
              <div class="form-group">
                <label for="lastname">{{$t("Child Last Name")}}</label>
                <input
                  type="text"
                  class="form-control form-control-sm"
                  id="lastname"
                  name="lastname"
                  :placeholder="$t('EnterChildLastName')"
                />
              </div>
              <!-- Child Father Name Input-->
              <div class="form-group">
                <label for="father">{{$t("Child Father Name")}}</label>
                <input
                  type="text"
                  class="form-control form-control-sm"
                  id="father"
                  name="father"
                  :placeholder="$t('EnterChildFatherName')"
                />
              </div>
              <!-- Child Mother Name Input-->
              <div class="form-group">
                <label for="mothername">{{$t("Child Mother Name")}}</label>
                <input
                  type="text"
                  class="form-control form-control-sm"
                  id="mothername"
                  name="mothername"
                  :placeholder="$t('EnterChildMotherFirstAndName')"
                />
              </div>
              <!-- Child Phone Number Input-->
              <div class="form-group">
                <label for="phone_number">{{$t("Child Phone Number")}}</label>
                <input
                  type="text"
                  class="form-control form-control-sm"
                  id="phone"
                  name="phone"
                  :placeholder="$t('EnterChildPhoneNumber')"
                />
              </div>
              <!-- Child MobliePhone Number Input-->
              <div class="form-group">
                <label for="phone_number">{{$t("ChildMobliePhoneNumber")}}</label>
                <input
                  type="text"
                  class="form-control form-control-sm"
                  id="mobilephone"
                  name="mobilephone"
                  :placeholder="$t('EnterChildMobliePhoneNumber')"
                />
              </div>
              <!-- Child Birth Place Input-->
              <div class="form-group">
                <label for="BirthPlace">{{$t("ChildBirthPlace")}}</label>
                <input
                  type="text"
                  class="form-control form-control-sm"
                  id="birthplace"
                  name="birthplace"
                  :placeholder="$t('EnterBirthPlaceNumber')"
                />
              </div>
              <!-- Child Birth Date Input-->
              <div class="form-group">
                <label for="BirthDate">{{$t("ChildBirthDate")}}</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input
                    type="date"
                    name="birthday"
                    id="birthday"
                    class="form-control"
                    data-inputmask-alias="datetime"
                    data-inputmask-inputformat="dd/mm/yyyy"
                    data-mask
                    im-insert="false"
                  />
                </div>
              </div>
              <!--CheckBox For Sponsors-->
              <div class="form-check">
                <span>
                  <input
                    type="checkbox"
                    v-on:click="hide_unhide_surgeryNeed"
                    name="Need_A_Surgery"
                    :placeholder="$t('DoesTheChildNeedAsurgery')"
                  />
                  <label for="SurgerQuestion">Does the child need a surgery?</label>
                </span>
                <b></b>

                <span>
                  <input
                    v-on:click="hide_unhide_sponsor"
                    type="checkbox"
                    name="IsTheChildSponsored"
                   
                    id="exampleCheck1"
                  />
                  <label for="sponsorQuestion">{{$t("IsTheChildSponsored")}} &nbsp</label>
                </span>
              </div>
              <!--Input If there is a sponsor-->
              <div v-bind:class="{ hide:sponsorVar  }" class="form-group">
                <label for="SponsorAnswer">Sponsore Name</label>
                <input
                  type="text"
                  id="sponsor"
                  name="sponosr"
                  placeholder="$t('EnterSponsorName')"
                />
              </div>
              <!--Sponosr Start and End Date -->
              <div v-bind:class="{ hide:sponsorVar  }" class="form-group">
                <label>Date and time range:</label>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-clock"></i>
                    </span>
                  </div>
                  <input type="date" name="startSponsor" class="form-control float-right" />
                </div>
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-clock"></i>
                  </span>
                </div>
                <input type="date" name="endSponosr" class="form-control float-right" />
              </div>
              <!-- Need Surgery-->
              <div class="form-group">
                <!-- Surgery Type-->
                <div class="form-group" v-bind:class="{ hide: surgeryVar }">
                  <label for="SurgerAnswer">SrugeryType</label>
                  <input
                    type="text"
                    class="form-control form-control-sm"
                    name="surgeryType"
                    :placeholder="$t('EnterSurgeryType')"
                  />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
  <script lang="ts">
import axios from "axios";
export default {
  data() {
    return {
      sponsorVar: true,
      surgeryVar: true,
      children: []
    };
  },
  methods: {
    hide_unhide_sponsor: function() {
      this.sponsorVar = !this.sponsorVar;
    },
    hide_unhide_surgeryNeed: function() {
      this.surgeryVar = !this.surgeryVar;
    },
    created() {
      axios
        .get("https://jsonplaceholder.typicode.com/todos")
        .then(res => (this.children = res.data))
        .catch(err => console.log(err));
    }
  }
};
</script>
<style  scoped>
.hide {
  visibility: hidden;
}
</style>