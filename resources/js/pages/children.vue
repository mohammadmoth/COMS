<template>
  <div>
    <div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$t("ChildrenTable")}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <!--  <li class="page-item">
                <a class="page-link" href="#">Previous</a>
              </li>-->

              <li v-for=" i in pagetable" class="page-item" :class="{active:i == pagetablecurrct }">
                <button class="page-link" @click="pagetablecurrctset(i)">{{i}}</button>
              </li>

              <!-- <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>-->
            </ul>
          </nav>

          <table id="usersData" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>{{$t("event")}}</th>
                <th>{{$t("name")}}</th>
                <th>{{$t("ContactInfo")}}</th>
                <th>{{$t("BirthInfo")}}</th>
                <th>{{$t("SponsoredInfo")}}</th>
                <th>{{$t("SurgeryInfo")}}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(data ,index) in dataTable" :key="index">
                <td>
                  <div class="margin">
                    <div class="btn-group">
                      <button
                        type="button"
                        class="btn btn-default dropdown-toggle dropdown-icon"
                        data-toggle="dropdown"
                      >
                        <i class="fas fa-cogs"></i>
                        <span class="sr-only">Toggle Dropdown</span>
                        <div class="dropdown-menu" role="menu">
                          <a
                            class="dropdown-item"
                            @click="enb_edit( data.id)"
                            href="#"
                          >{{$t("edit")}}</a>
                          <div class="dropdown-divider"></div>
                          <a
                            class="dropdown-item"
                            @click="ShowMesBoxConfingRemove(data.id)"
                            href="#"
                          >{{$t("remove")}}</a>
                        </div>
                      </button>
                    </div>
                  </div>
                </td>

                <td>
                  <div>{{data.firstname}} {{data.lastname}}</div>
                  <div>{{$t("mothername")}}: {{data.mothername}}</div>
                  <div>{{$t("father")}}: {{data.father}}</div>
                </td>
                <td>
                  <div>{{$t("mobilephone")}}: {{data.mobilephone}}</div>
                  <div>{{$t("phone")}}: {{data.phone}}</div>
                </td>
                <td>
                  <div>{{$t("birthplace")}}: {{data.birthplace}}</div>
                  <div>{{$t("birthday")}}: {{data.birthday | moment("DD/MM/YYYY" )}}</div>
                </td>
                <td>
                  <span v-show="getsponser(data.id).id!=0">
                    <div>{{$t("name")}}: {{getsponser(data.id).firstname}} {{getsponser(data.id).lastname}}</div>
                  </span>
                  <span v-show="getsponser(data.id).id==0">
                    <div>{{$t("IsNotSponsored")}}</div>
                  </span>
                </td>
                <td>
                  <span v-show="data.srugerytypeid !=null">
                    <div>{{$t("SrugeryType")}}: {{getSrugerytype( data.srugerytypeid)}}</div>
                  </span>
                  <span v-show="data.srugerytypeid ==null">
                    <div>{{$t("NoNeedSurgery")}}</div>
                  </span>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>{{$t("event")}}</th>
                <th>{{$t("name")}}</th>
                <th>{{$t("ContactInfo")}}</th>
                <th>{{$t("BirthInfo")}}</th>
                <th>{{$t("SponsoredInfo")}}</th>
                <th>{{$t("SurgeryInfo")}}</th>
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
          <h3 class="card-title">{{$t(editmodeString)}} {{$t("child")}}</h3>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form @submit="checkForm" action="#" role="form">
          <div class="card-body">
            <div class="form-group">
              <label for="firstname">{{$t("firstname")}}</label>
              <input
                required
                type="text"
                name="firstname"
                class="form-control"
                id="firstname"
                :placeholder="$t('enterfirstname')"
                v-model="child.firstname"
              />
            </div>
            <div class="form-group">
              <label for="lastname">{{$t("lastname")}}</label>
              <input
                required
                type="text"
                name="lastname"
                class="form-control"
                id="lastname"
                :placeholder="$t('enterlastname')"
                v-model="child.lastname"
              />
            </div>
            <div class="form-group">
              <label for="mothername">{{$t("mothername")}}</label>
              <input
                required
                type="text"
                name="mothername"
                class="form-control"
                id="mothername"
                :placeholder="$t('entermothername')"
                v-model="child.mothername"
              />
            </div>
            <!---->
            <div class="form-group">
              <label for="father">{{$t("father")}}</label>
              <input
                required
                type="text"
                id="father"
                name="father"
                class="form-control"
                :placeholder="$t('Enterfather')"
                v-model="child.father"
              />
            </div>
            <!---->
            <div class="form-group">
              <label for="mobilephone">{{$t("mobilephone")}}</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-mobile"></i>
                  </span>
                </div>
                <input
                  type="text"
                  id="mobilephone"
                  name="mobilephone"
                  maxlength="10"
                  class="form-control"
                  :placeholder="$t('Entermobilephone')"
                  v-model="child.mobilephone"
                />
              </div>
            </div>
            <!---->
            <div class="form-group">
              <label for="phone">{{$t("phone")}}</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-phone"></i>
                  </span>
                </div>
                <input
                  required
                  type="text"
                  id="phone"
                  name="phone"
                  maxlength="10"
                  class="form-control"
                  :placeholder="$t('Enterphone')"
                  v-model="child.phone"
                />
              </div>
            </div>

            <!---->
            <div class="form-group">
              <label>{{$t("birthday")}}</label>

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input
                  required
                  type="date"
                  class="form-control"
                  data-inputmask-alias="date"
                  data-inputmask-inputformat="dd/mm/yyyy"
                  data-mask
                  v-model="child.birthday"
                />
              </div>
            </div>
            <!---->
            <div class="form-group">
              <label for="birthplace">{{$t("birthplace")}}</label>
              <input
                required
                type="text"
                id="birthplace"
                name="birthplace"
                class="form-control"
                :placeholder="$t('Enterbirthplace')"
                v-model="child.birthplace"
              />
            </div>

            <!---->
            <div class="form-group">
              <div class="icheck-danger d-inline">
                <input type="checkbox" v-model="needsurgery" id="needsurgery" />
                <label for="needsurgery">{{$t("needsurgery")}}</label>
              </div>
              <span v-show="needsurgery">
                <div class="form-group">
                  <label for="SrugeryType">{{$t("SrugeryType")}}</label>
                  <input
                    type="text"
                    id="SrugeryType"
                    name="SrugeryType"
                    class="form-control"
                    :placeholder="$t('EnterSrugeryType')"
                    v-model="SrugeryType"
                    list="SrugeryTypeL"
                    autocomplete="off"
                  />
                  <datalist id="SrugeryTypeL">
                    <option
                      v-for="(SrugeryType ,index) in tags "
                      :key="index"
                      :value="SrugeryType.name"
                      v-if="SrugeryType.type =='sopnsors'"
                    />
                  </datalist>
                </div>
              </span>
            </div>

            <!---->
            <div class="form-group">
              <div class="icheck-danger d-inline">
                <input type="checkbox" v-model="IsSponsored" id="IsSponsored" />
                <label for="IsSponsored">{{ $t("IsSponsored") }}</label>
              </div>
              <span v-show="IsSponsored">
                <div class="form-group">
                  <label>{{$t("sponsor")}}</label>
                  <model-select
                    :options="sponsoroject"
                    v-model="sponsorid"
                    :placeholder="$t('search')"
                  ></model-select>
                </div>
                <!-- Date range -->
                <div class="form-group">
                  <label>{{$t('DateRangeofsponsor')}}</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input
                      required
                      type="text"
                      data-inputmask-inputformat="dd/mm/yyyy"
                      class="form-control float-right"
                      id="reservation"
                    />
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </span>
            </div>
          </div>
          <!---->

          <div class="card-footer">
            <button
              :disabled="!sendbutton"
              type="submit"
              class="btn btn-info"
            >{{ $t(editmodeString) }}</button>

            <button
              v-show="editmode"
              type="button"
              class="btn btn-info"
              @click="cancelModeEdit()"
            >{{ $t("cancel") }}</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
  </div>
</template>

<script>
import { ModelSelect } from "vue-search-select";
export default {
  components: {
    ModelSelect
  },
  data: function() {
    return {
      sponsors: [],
      children: [],
      tags: [],
      hasfromsponsors: [],
      editmode: false,
      sponsorid: 0,
      IsSponsored: false,
      needsurgery: false,
      SrugeryType: "",
      sponsor: {
        id: 0,
        firstname: "Not",
        lastname: "Found",
        phone: "00000000000",
        startsopnser: "2000-01-01",
        endsponosor: "2000-12-30",
        hasfromsponsors_id: 0
      },

      child: {
        firstname: "",
        lastname: "",
        mothername: "",
        father: "",
        mobilephone: "",
        phone: "",
        birthplace: "",
        birthday: "",
        srugerytypeid: 0
      },
      sendbutton: true,
      //tablestart
      pagetable: 0,
      pagetablecurrct: 1,
      countporpage: 10
      //tableend
    };
  },
  computed: {
    editmodeString: function() {
      if (this.editmode) {
        return "edit";
      } else {
        return "add";
      }
    },
    sponsoroject: function() {
      let array = [];
      for (let index = 0; index < this.sponsors.length; index++) {
        array.push({
          value: this.sponsors[index].id,
          text:
            this.sponsors[index].firstname + " " + this.sponsors[index].lastname
        });
      }
      return array;
    },
    //tablestart
    dataTable: function() {
      this.pagetable = Math.ceil(this.children.length / this.countporpage);
      if (this.children.length >= this.countporpage) {
        let data = [];
        if (this.pagetable < this.pagetablecurrct)
          this.pagetablecurrct = this.pagetable;
        let maxindex = this.countporpage * this.pagetablecurrct;
        if (maxindex > this.children.length) maxindex = this.children.length;
        for (
          let index = this.countporpage * (this.pagetablecurrct - 1);
          index < maxindex;
          index++
        ) {
          data.push(this.children[index]);
        }
        return data;
      } else return this.children;
    }
    //tableend
  },
  methods: {
    ShowMesBoxConfingRemove(id) {
      var vm = this;
      $.confirm({
        title: this.$t("ShowMesBoxConfingRemove"),
        content:
          '<div class="form-group">' +
          "<label>" +
          this.$t("ShowMesBoxConfingRemove") +
          "</label>" +
          "</div>",
        buttons: {
          formSubmit: {
            text: this.$t("ok"),
            btnClass: "btn-red",
            action: function() {
              vm.$api.childrens.destroy(id);
              for (let index = 0; index < vm.children.length; index++) {
                if (vm.children[index].id == id) {
                  vm.children.splice(index, 1);
                  break;
                }
              }
            }
          },
          cancel: {
            text: this.$t("cancel"),
            btnClass: "btn-info",
            action: function() {}
          }
        }
      });
    },
    enb_edit(id) {
      this.editmode = true;
      for (let index = 0; index < this.children.length; index++) {
        if (this.children[index].id == id) {
          this.child = this.children[index];
          break;
        }
      }

      if (this.child.srugerytypeid != null && this.child.srugerytypeid != 0) {
        this.SrugeryType = this.getSrugerytype(this.child.srugerytypeid);
        this.needsurgery = true;
      }

      if (this.getsponser(this.child.id).id != 0) {
        this.sponsor = this.getsponser(this.child.id);
        this.IsSponsored = true;
        this.sponsorid = this.sponsor.id;

        $("#reservation")
          .data("daterangepicker")
          .setStartDate(
            this.$moment(this.sponsor.startsopnser, "YYYY-MM-DD").format(
              "DD/MM/YYYY"
            )
          );
        $("#reservation")
          .data("daterangepicker")
          .setEndDate(
            this.$moment(this.sponsor.endsponosor, "YYYY-MM-DD").format(
              "DD/MM/YYYY"
            )
          );
      }
    },
    cancelModeEdit() {
      this.cleaninput();
      this.editmode = false;
    },
    getsponser(id) {
      for (let index = 0; index < this.hasfromsponsors.length; index++) {
        if (this.hasfromsponsors[index].id_child == id)
          for (let je = 0; je < this.sponsors.length; je++) {
            if (
              this.sponsors[je].id == this.hasfromsponsors[index].id_sponsor
            ) {
              this.sponsors[je].startsopnser = this.hasfromsponsors[
                index
              ].startsopnser;
              this.sponsors[je].endsponosor = this.hasfromsponsors[
                index
              ].endsponosor;
              this.sponsors[je].hasfromsponsors_id = this.hasfromsponsors[
                index
              ].id;
              return this.sponsors[je];
            }
          }
      }

      return this.sponsor;
    },
    //tablestart
    pagetablecurrctset(number) {
      this.pagetablecurrct = number;
    },
    ShowMesBox(messg, title, btnname) {
      $.alert({
        title: title,
        content: messg,

        typeAnimated: true,
        buttons: {
          tryAgain: {
            rtl: true,
            text: btnname,
            btnClass: "btn",
            action: function() {}
          }
        }
      });
    },
    show: function(mess) {},
    checkinput: function(data, name) {
      if (data == "") {
        this.ShowMesBox(
          this.$t("pleaseenter") + this.$t(name),
          this.$t("Errorinput"),
          this.$t("ok")
        );
        return false;
      }

      return true;
    },
    getSrugerytype: function(id) {
      for (let index = 0; index < this.tags.length; index++) {
        if (this.tags[index].id == id) {
          return this.tags[index].name;
        }
      }
      return this.$t("TagsNotFound");
    },
    cleaninput: function() {
      this.child = {};
      this.child.firstname = "";
      this.child.lastname = "";
      this.child.mothername = "";
      this.child.father = "";
      this.child.mobilephone = "";
      this.child.phone = "";
      this.child.birthplace = "";
      this.child.birthday = "";
      this.child.srugerytypeid = 0;

      this.IsSponsored = false;
      this.needsurgery = false;
      this.sponsor = {};
      this.sponsor.id = 0;
      this.sponsor.firstname = "Not";
      this.sponsor.lastname = "Found";
      this.sponsor.phone = "00000000000";
      this.sponsor.startsopnser = "2000-01-01";
      this.sponsor.endsponosor = "2000-12-30";
      this.sponsor.hasfromsponsors_id = 0;

      this.SrugeryType = "";
      this.sponsorid = 0;
    },
    checkForm: async function(e) {
      e.preventDefault();

      if (this.needsurgery)
        if (!this.checkinput(this.SrugeryType, "SrugeryType")) return false;

      if (this.needsurgery) {
        for (let index = 0; index < this.tags.length; index++) {
          if (this.tags[index].name == this.SrugeryType)
            this.child.srugerytypeid = this.tags[index].id;
        }
      }

      if (this.needsurgery) {
        if (
          (this.child.srugerytypeid == 0 || this.child.srugerytypeid == null) &&
          SrugeryType != ""
        ) {
          await this.$api.tags
            .store({
              name: this.SrugeryType,
              type: "sopnsors"
            })
            .then(res => {
              this.child.srugerytypeid = res.data.data.id;
            })
            .catch(err => {});
        }
      } else {
        this.child.srugerytypeid = null;
      }

      this.sendbutton = false;
      if (
        !this.checkinput(this.child.firstname, "firstname") ||
        !this.checkinput(this.child.lastname, "lastname") ||
        !this.checkinput(this.child.mothername, "mothername") ||
        !this.checkinput(this.child.father, "father") ||
        !this.checkinput(this.child.mobilephone, "mobilephone") ||
        !this.checkinput(this.child.phone, "phone") ||
        !this.checkinput(this.child.birthplace, "birthplace") ||
        !this.checkinput(this.child.birthday, "birthday")
      )
        return false;
      // $('#reservation').data('daterangepicker').startDate.format();
      if (
        this.$moment(this.child.birthday, "YYYY-MM-DD").isAfter(
          this.$moment(new Date())
        )
      ) {
        this.ShowMesBox(
          this.$t("ErrorOnDataIsAfterNowBirthday"),
          this.$t("Errorinput"),
          this.$t("ok")
        );

        this.sendbutton = true;
        return false;
      }

      var error = false;
      if (this.editmode) {
        await this.$api.childrens
          .update(this.child)
          .then(res => {})
          .catch(error => {
            error = true;
            console.log(error);
          });

        if (this.sponsor.id == 0 && this.sponsorid != 0)
          await this.$api.hasfromsponsors
            .store({
              id_child: this.child.id,
              id_sponsor: this.sponsorid,
              startsopnser: $("#reservation")
                .data("daterangepicker")
                .startDate.format("YYYY-MM-DD"),

              endsponosor: $("#reservation")
                .data("daterangepicker")
                .endDate.format("YYYY-MM-DD")
            })
            .then(res => {})
            .catch(error => {
              error = true;
              console.log(error);
            });
        else if (
          this.sponsor.id != 0 &&
          (this.sponsorid == 0 || !this.IsSponsored)
        )
          await this.$api.hasfromsponsors
            .destroy(this.sponsor.hasfromsponsors_id)
            .then(res => {})
            .catch(error => {
              error = true;
              console.log(error);
            });
        else if (this.sponsor.id != 0 && this.sponsorid != 0)
          await this.$api.hasfromsponsors
            .update({
              id: this.sponsor.hasfromsponsors_id,
              id_child: this.child.id,
              id_sponsor: this.sponsorid,
              startsopnser: $("#reservation")
                .data("daterangepicker")
                .startDate.format("YYYY-MM-DD"),

              endsponosor: $("#reservation")
                .data("daterangepicker")
                .endDate.format("YYYY-MM-DD")
            })
            .then(res => {})
            .catch(error => {
              error = true;
              console.log(error);
            });
      } else {
        await this.$api.childrens
          .store(this.child)
          .then(res => {
            this.child = res.data.data;
          })
          .catch(error => {
            error = true;
            console.log(error);
          });
        if (this.IsSponsored && this.sponsorid != 0 && !error)
          await this.$api.hasfromsponsors
            .store({
              id_child: this.child.id,
              id_sponsor: this.sponsorid,
              startsopnser: $("#reservation")
                .data("daterangepicker")
                .startDate.format("YYYY-MM-DD"),

              endsponosor: $("#reservation")
                .data("daterangepicker")
                .endDate.format("YYYY-MM-DD")
            })
            .then(res => {})
            .catch(error => {
              error = true;
              console.log(error);
            });
        this.ShowMesBox(
          this.$t("AddingComplete"),
          this.$t("AddingComplete"),
          this.$t("ok")
        );
      }

      this.cleaninput();

      this.fetch();
      this.sendbutton = true;
    },
    fetch: function() {
      this.$api.hasfromsponsors
        .index()
        .then(res => {
          this.hasfromsponsors = res.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });

      this.$api.sponsors
        .index()
        .then(res => {
          this.sponsors = res.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });

      this.$api.tags
        .index()
        .then(res => {
          this.tags = res.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });

      this.$api.childrens
        .index()
        .then(res => {
          this.children = res.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  },
  mounted() {
    this.fetch();

    $("#reservation").daterangepicker({
      locale: {
        format: "DD/MM/YYYY",
        separator: " - ",
        applyLabel: this.$t("ok"),
        cancelLabel: this.$t("cancel"),
        fromLabel: this.$t("from"),
        toLabel: this.$t("to"),
        customRangeLabel: "Custom",

        daysOfWeek: [
          this.$t("Su"),
          this.$t("Mo"),
          this.$t("Tu"),
          this.$t("We"),
          this.$t("Th"),
          this.$t("Fr"),
          this.$t("Sa")
        ],
        monthNames: [
          this.$t("January"),
          this.$t("February"),
          this.$t("March"),
          this.$t("April"),
          this.$t("May"),
          this.$t("June"),
          this.$t("July"),
          this.$t("August"),
          this.$t("September"),
          this.$t("October"),
          this.$t("November"),
          this.$t("December")
        ],
        firstDay: this.$t("firstDay")
      }
    });
    $(function() {
      $(".select2").select2();
    });
  }
};
</script>

<style>
</style>
