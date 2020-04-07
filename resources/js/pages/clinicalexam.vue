<template>
  <div>
    <div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$t("table")}} {{$t("clinicalexam")}}</h3>
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
                <th>{{$t("child")}} {{$t("name")}}</th>
                <th>{{$t("Doctor")}}</th>
                <th>{{$t("dateofexam")}}</th>
                <th>{{$t("case")}}</th>
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
                  <div>{{getchildren(data.children_id).firstname}} {{getchildren(data.children_id).lastname}}</div>
                </td>
                <td>
                  <div>{{getDoctorName(data.doctor_id)}}</div>
                </td>
                <td>{{data.date | moment("DD/MM/YYYY" )}}</td>
                <td>{{data.case}}</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>{{$t("event")}}</th>
                <th>{{$t("child")}} {{$t("name")}}</th>
                <th>{{$t("Doctor")}}</th>
                <th>{{$t("dateofexam")}}</th>
                <th>{{$t("case")}}</th>
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
          <h3 class="card-title">{{$t(editmodeString)}} {{$t("clinicalexam")}}</h3>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form @submit="checkForm" action="#" role="form">
          <div class="card-body">
            <div class="form-group">
              <label for="doctor">{{$t("doctorname")}}</label>
              <input
                required
                type="text"
                name="doctorname"
                class="form-control"
                id="doctorname"
                :placeholder="$t('enterdoctorname')"
                v-model="clinicalexam.doctorname"
                list="doctornameL"
              />
              <datalist id="doctornameL">
                <option
                  v-for="(Type ,index) in tags "
                  :key="index"
                  :value="Type.name"
                  v-if="Type.type =='doctors'"
                />
              </datalist>
            </div>
            <!---->
            <div class="form-group">
              <label>{{$t("child")}}</label>
              <model-select
                :options="childrenobject"
                v-model="clinicalexam.children_id"
                :placeholder="$t('search')"
              ></model-select>
            </div>
            <!---->
            <div class="form-group">
              <label for="case">{{$t("case")}}</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-question-circle"></i>
                  </span>
                </div>
                <input
                  type="text"
                  id="case"
                  name="case"
                  class="form-control"
                  :placeholder="$t('Entercase')"
                  v-model="clinicalexam.case"
                />
              </div>
            </div>
            <!---->
            <div class="form-group">
              <label>{{$t("date")}}</label>

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
                  v-model="clinicalexam.date"
                />
              </div>
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
      tags: [],
      children: [],
      clinicalexams: [],
      editmode: false,

      clinicalexam: {
        id: 0,
        children_id: 0,
        doctor_id: 0,
        child: {},
        date: "",
        case: "",
        doctorname: ""
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
    editmodeString: function(data) {
      if (this.editmode) {
        return "edit";
      } else {
        return "add";
      }
    },

    childrenobject: function() {
      let array = [];
      for (let index = 0; index < this.children.length; index++) {
        array.push({
          value: this.children[index].id,
          text:
            this.children[index].firstname + " " + this.children[index].lastname
        });
      }
      return array;
    },
    //tablestart
    dataTable: function() {
      this.pagetable = Math.ceil(this.clinicalexams.length / this.countporpage);
      if (this.clinicalexams.length >= this.countporpage) {
        let data = [];
        if (this.pagetable < this.pagetablecurrct)
          this.pagetablecurrct = this.pagetable;
        let maxindex = this.countporpage * this.pagetablecurrct;
        if (maxindex > this.clinicalexams.length)
          maxindex = this.clinicalexams.length;
        for (
          let index = this.countporpage * (this.pagetablecurrct - 1);
          index < maxindex;
          index++
        ) {
          data.push(this.clinicalexams[index]);
        }
        return data;
      } else return this.clinicalexams;
    }
    //tableend
  },
  watch: {
    /*  firstname: function(val) {
      this.fullname = val + " " + this.lastname;
    }*/
  },

  filters: {
    numbers: function(number) {
      if (this.isNumeric(number)) {
        console.log(number);
        return number;
      } else {
        console.log(number);
        return "";
      }
    }
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
              vm.$api.clinicalexam.destroy(id);
              for (let index = 0; index < vm.clinicalexams.length; index++) {
                if (vm.clinicalexams[index].id == id) {
                  vm.clinicalexams.splice(index, 1);
                  break;
                }
              }
            }
          },
          cancel: {
            text: this.$t("cancel"),
            btnClass: "btn-info",
            action: function() {

            }
          }
        }
      });
    },
    getchildren(children_id) {
      for (let je = 0; je < this.children.length; je++) {
        if (this.children[je].id == children_id) {
          return this.children[je];
        }
      }
      return {};
    },
    enb_edit(id) {
      for (let index = 0; index < this.clinicalexams.length; index++) {
        if (this.clinicalexams[index].id == id) {
          this.clinicalexam = this.clinicalexams[index];
          break;
        }
      }
      if (this.clinicalexam.id != 0) {
        this.clinicalexam.child = this.getchildren(
          this.clinicalexam.children_id
        );
      }

      if (this.clinicalexam.doctor_id > 0) {
        var type = {};
        for (let index = 0; index < this.tags.length; index++) {
          if (this.tags[index].id == this.clinicalexam.doctor_id) {
            type = this.tags[index];
          }
        }

        if ("id" in type) {
          this.clinicalexam.doctorname = type.name;
        }
      }

      this.editmode = true;
    },
    cancelModeEdit() {
      this.cleaninput();
      this.editmode = false;
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
    checkinput: function(
      data,
      name,
      mes = "",
      title = "",
      button = "",
      rex = ""
    ) {
      if (button == "") button = this.$t("ok");

      if (title == "") title = this.$t("Errorinput");

      if (mes == "") mes = this.$t("pleaseenter") + this.$t(name);

      if (rex == "") {
        if (data == "") {
          this.ShowMesBox(mes, title, button);
          return false;
        }
      } else {
        if (rex.test(data)) {
          this.ShowMesBox(mes, title, button);
          return true;
        } else {
          return false;
        }
      }

      return true;
    },
    getDoctorName: function(doctor_id) {
      for (let index = 0; index < this.tags.length; index++) {
        if (this.tags[index].id == doctor_id) {
          return this.tags[index].name;
        }
      }
      return this.$t("TagsNotFound");
    },
    cleaninput: function() {
      this.clinicalexam = {};
      this.clinicalexam = {
        id: 0,
        children_id: 0,
        doctor_id: 0,
        child: {},
        date: "",
        case: "",
        doctorname: ""
      };
    },
    showAllMsg(error) {
      let msg = "";

      for (let index = 0; index < error.length; index++) {
        msg += `<div>${index + 1}. ${error[index].msg}</div> `;
      }

      this.ShowMesBox(msg, this.$t("error"), this.$t("ok"));
      this.sendbutton = true;
    },
    checkForm: async function(e) {
      e.preventDefault();

      this.sendbutton = false;
      var error = [];
      this.clinicalexam.doctor_id = 0;

      if (!this.checkinput(this.clinicalexam.doctorname, "doctorname")) {
        this.sendbutton = true;
        return false;
      }
      if (this.clinicalexam.children_id == 0) {
        this.clinicalexam.children_id = "";

        this.checkinput(this.clinicalexam.children_id, "child");
        this.clinicalexam.children_id = 0;
        this.sendbutton = true;
        return false;
      }

      for (let index = 0; index < this.tags.length; index++) {
        if (this.tags[index].name == this.clinicalexam.doctorname) {
          this.clinicalexam.doctor_id = this.tags[index].id;
          break;
        }
      }

      if (
        this.clinicalexam.doctor_id == null ||
        this.clinicalexam.doctor_id == 0
      ) {
        var typeoftag = "doctors";

        await this.$api.tags
          .store({
            name: this.clinicalexam.doctorname,
            type: typeoftag
          })
          .then(res => {
            this.clinicalexam.doctor_id = res.data.data.id;
          })
          .catch(err => {
            console.log(err);
            error.push({
              msg: this.$t("IcantAddTags")
            });
          });
      }
      if (error.length > 0) {
        this.showAllMsg(error);
        return;
      }

      if (
        this.clinicalexam.doctor_id == 0 ||
        this.clinicalexam.doctor_id == null
      )
        error.push({
          msg: this.$t("IcantAddTags") + " #1"
        });

      if (error.length > 0) {
        this.showAllMsg(error);
        return;
      }

      if (
        !this.checkinput(this.clinicalexam.doctorname, "doctorname") ||
        !this.checkinput(this.clinicalexam.case, "case")
      ) {
        this.sendbutton = true;
        return false;
      }

      // $('#reservation').data('daterangepicker').startDate.format();

      if (this.editmode) {
        await this.$api.clinicalexam
          .update(this.clinicalexam)
          .then(res => {})
          .catch(err => {
            error.push({ msg: this.$t("icantaddclinicalexam") });
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
        /* **Adding sponsor first

          */
        await this.$api.clinicalexam
          .store(this.clinicalexam)
          .then(res => {
            this.clinicalexam.id = res.data.data.id;
          })
          .catch(err => {
            error.push({ msg: this.$t("icantaddclinicalexam") });
          });
        /* **if have error

          */
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
      this.fetch();
      this.cleaninput();
      this.editmode = false;
      this.sendbutton = true;
    },
    fetch: function() {
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
      this.$api.clinicalexam
        .index()
        .then(res => {
          this.clinicalexams = res.data.data;
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
