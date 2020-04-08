<template>
  <div>
    <div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$t("table")}} {{$t("families")}}</h3>
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
                <th>{{$t("AddressInfo")}}</th>
                <th>{{$t("Count")}}</th>
                <th>{{$t("Docs")}}</th>
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
                  <div v-show="data.husband!=''">{{$t("husband")}}: {{data.husband}}</div>
                  <div v-show="data.wife!=''">{{$t("wife")}}: {{data.wife}}</div>
                </td>
                <td>
                  <div>{{$t("mobilephone")}}: {{data.mobile}}</div>
                </td>
                <td>
                  <div
                    v-show="data.previous_resident_address!=null"
                  >{{$t("previous_resident_address")}}: {{data.previous_resident_address}}</div>
                  <div>{{$t("current_resident_address")}}: {{data.current_resident_address }}</div>
                </td>
                <td>
                  <div>{{data.count}}</div>
                </td>
                <td>
                  <div>{{$t("idnumber")}}: {{data.national_id }}</div>
                  <div>{{$t("family_card_id")}}: {{data.family_card_id }}</div>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>{{$t("event")}}</th>
                <th>{{$t("name")}}</th>
                <th>{{$t("ContactInfo")}}</th>
                <th>{{$t("AddressInfo")}}</th>
                <th>{{$t("Count")}}</th>
                <th>{{$t("Docs")}}</th>
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
          <h3 class="card-title">{{$t(editmodeString)}} {{$t("family")}}</h3>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form @submit="checkForm" action="#" role="form">
          <div class="card-body">
            <div class="form-group">
              <label for="husband">{{$t("husband")}}</label>
              <input
                type="text"
                name="husband"
                class="form-control"
                id="husband"
                :placeholder="$t('enterhusband')"
                v-model="family.husband"
              />
            </div>
            <div class="form-group">
              <label for="wife">{{$t("wife")}}</label>
              <input
                type="text"
                name="wife"
                class="form-control"
                id="wife"
                :placeholder="$t('enterwife')"
                v-model="family.wife"
              />
            </div>
            <!---->
            <div class="form-group">
              <label for="idnumber">{{$t("idnumber")}}</label>
              <input
                required
                type="text"
                name="idnumber"
                class="form-control"
                id="idnumber"
                :placeholder="$t('enteridnumber')"
                v-model="family.national_id"
              />
            </div>
            <!---->
            <div class="form-group">
              <label for="family_card_id">{{$t("family_card_id")}}</label>
              <input
                required
                type="text"
                name="family_card_id"
                class="form-control"
                id="family_card_id"
                :placeholder="$t('enterfamily_card_id')"
                v-model="family.family_card_id"
              />
            </div>
            <!---->

            <div class="form-group">
              <label for="count">{{$t("count")}}</label>
              <input
                required
                type="text"
                name="count"
                class="form-control"
                id="count"
                :placeholder="$t('entercount')"
                v-model="family.count"
              />
            </div>
            <!---->

            <div class="form-group">
              <div class="icheck-danger d-inline">
                <input
                  type="checkbox"
                  v-model="family.have_previous_resident_address"
                  id="have_previous_resident_address"
                />
                <label
                  for="have_previous_resident_address"
                >{{ $t("have_previous_resident_address") }}</label>
              </div>
              <span v-show="family.have_previous_resident_address">
                <div class="form-group">
                  <input
                    type="text"
                    name="previous_resident_address"
                    class="form-control"
                    id="previous_resident_address"
                    :placeholder="$t('enterprevious_resident_address')"
                    v-model="family.previous_resident_address"
                  />
                </div>
              </span>
            </div>
            <!---->

            <div class="form-group">
              <label for="current_resident_address">{{$t("current_resident_address")}}</label>
              <input
                required
                type="text"
                name="current_resident_address"
                class="form-control"
                id="current_resident_address"
                :placeholder="$t('entercurrent_resident_address')"
                v-model="family.current_resident_address"
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
                  v-model="family.mobile"
                />
              </div>
            </div>
            <!---->
            <div class="form-group">
              <label for="economic_status">{{$t("economic_status")}}</label>
              <model-select
                :options="economic_status_type"
                v-model="family.economic_status"
                :placeholder="$t('search')"
              ></model-select>
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
      families: [],

      economic_status_type: [
        { value: "bad", text: this.$t("bad") },
        { value: "middle", text: this.$t("middle") },
        { value: "good", text: this.$t("good") }
      ],
      editmode: false,

      family: {
        id: 0,
        husband: "",
        wife: "",
        mobile: "",
        economic_status: "middle",
        have_previous_resident_address: false,
        previous_resident_address: null,
        current_resident_address: "",
        count: 0,
        national_id: "",
        family_card_id: ""
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

    //tablestart
    dataTable: function() {
      this.pagetable = Math.ceil(this.families.length / this.countporpage);
      if (this.families.length >= this.countporpage) {
        let data = [];
        if (this.pagetable < this.pagetablecurrct)
          this.pagetablecurrct = this.pagetable;
        let maxindex = this.countporpage * this.pagetablecurrct;
        if (maxindex > this.families.length) maxindex = this.families.length;
        for (
          let index = this.countporpage * (this.pagetablecurrct - 1);
          index < maxindex;
          index++
        ) {
          data.push(this.families[index]);
        }
        return data;
      } else return this.families;
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
              vm.$api.families.destroy(id);
              for (let index = 0; index < vm.families.length; index++) {
                if (vm.families[index].id == id) {
                  vm.families.splice(index, 1);
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
      let family = {};

      for (let index = 0; index < this.families.length; index++) {
        if (this.families[index].id == id) {
          family = this.families[index];
          break;
        }
      }

      if (family.previous_resident_address != null)
        family.have_previous_resident_address = true;
      else family.have_previous_resident_address = false;

      this.family = Object.assign({}, family);
      this.editmode = true;

      this.$forceUpdate();
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
    showAllMsg(error) {
      let msg = "";

      for (let index = 0; index < error.length; index++) {
        msg += `<div>${index + 1}. ${error[index].msg}</div> `;
      }

      this.ShowMesBox(msg, this.$t("error"), this.$t("ok"));
      this.sendbutton = true;
    },
    cleaninput: function() {
      this.family = {};
      this.family = {
        id: 0,
        husband: "",
        wife: "",
        mobile: "",
        economic_status: "middle",
        have_previous_resident_address: false,
        previous_resident_address: null,
        current_resident_address: "",
        count: 0,
        national_id: "",
        family_card_id: ""
      };
    },
    checkForm: async function(e) {
      e.preventDefault();
      if (!this.family.have_previous_resident_address)
        this.family.previous_resident_address = null;

      this.sendbutton = false;
      var error = [];
      if (this.family.have_previous_resident_address)
        if (
          !this.checkinput(
            this.family.previous_resident_address,
            "previous_resident_address"
          )
        ) {
          this.sendbutton = true;
          return false;
        }
      if (this.family.husband == "" && this.family.wife == "") {
        this.checkinput(this.family.husband, "husband");

        this.sendbutton = true;
        return false;
      }

      if (
        !this.checkinput(this.family.mobile, "mobile") ||
        !this.checkinput(this.family.economic_status, "economic_status") ||
        !this.checkinput(
          this.family.current_resident_address,
          "current_resident_address"
        ) ||
        !this.checkinput(this.family.national_id, "national_id") ||
        !this.checkinput(this.family.family_card_id, "family_card_id")
      ) {
        this.sendbutton = true;
        return false;
      }
      if (!Number.isInteger(this.family.count)) {
        this.family.count = 0;
        this.checkinput(this.family.count, "count");
        this.sendbutton = true;
        return false;
      }

      if (this.editmode) {
        await this.$api.families
          .update(this.family)
          .then(res => {})
          .catch(err => {
            console.log(err);
            error.push({
              msg: this.$t("IcantAddfamilies")
            });
          });
        if (error.length > 0) {
          this.showAllMsg(error);
          return;
        }

        this.ShowMesBox(
          this.$t("updateComplete"),
          this.$t("updateComplete"),
          this.$t("ok")
        );
      } else {
        await this.$api.families
          .store(this.family)
          .then(res => {})
          .catch(err => {
            console.log(err);
            error.push({
              msg: this.$t("IcantAddfamilies")
            });
          });
        if (error.length > 0) {
          this.showAllMsg(error);
          return;
        }

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
      this.$api.families
        .index()
        .then(res => {
          this.families = res.data.data;
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
