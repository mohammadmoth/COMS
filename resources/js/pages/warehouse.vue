<template>
  <div>
    <div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$t("table")}} {{$t("warehouse")}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <!--  <li class="page-item">
                <a class="page-link" href="#">Previous</a>
              </li>-->

              <li
                :key="i"
                v-for=" i in pagetable"
                class="page-item"
                :class="{active:i == pagetablecurrct }"
              >
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
                <th>{{$t("countofwares")}}</th>
                <th>{{$t("inputoutput")}}</th>
                <th>{{$t("date")}}</th>
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
                  <div>{{gettags( data.tags_id )}}</div>
                </td>
                <td>
                  <div>{{data.countofwares}}</div>
                </td>
                <td>
                  <div>{{$t(data.inputoutput) }}</div>
                </td>
                <td>{{data.date | moment("DD/MM/YYYY" )}}</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>{{$t("event")}}</th>
                <th>{{$t("name")}}</th>
                <th>{{$t("countofwares")}}</th>
                <th>{{$t("inputoutput")}}</th>
                <th>{{$t("date")}}</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$t("inventorycount")}} {{$t("warehouse")}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <!--  <li class="page-item">
                <a class="page-link" href="#">Previous</a>
              </li>-->

              <li
                :key="i"
                v-for=" i in pagetable"
                class="page-item"
                :class="{active:i == pagetablecurrct2 }"
              >
                <button class="page-link" @click="pagetablecurrctset2(i)">{{i}}</button>
              </li>

              <!-- <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>-->
            </ul>
          </nav>

          <table id="usersData" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>{{$t("name")}}</th>
                <th>{{$t("countonwarehouse")}}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(data ,index) in dataTable2" :key="index">
                <td>
                  <div>{{gettags( data.id )}}</div>
                </td>
                <td>
                  <div>{{data.count}}</div>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>{{$t("name")}}</th>
                <th>{{$t("countonwarehouse")}}</th>
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
          <h3 class="card-title">{{$t(editmodeString)}} {{$t("ware")}}</h3>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form @submit="checkForm" action="#" role="form">
          <div class="card-body">
            <div class="form-group">
              <label for="nameware">{{$t("nameware")}}</label>
              <input
                type="text"
                name="nameware"
                class="form-control"
                id="nameware"
                :placeholder="$t('enter') + $t('nameware')"
                v-model="ware.nameware"
                list="TagsTypeL"
                autocomplete="off"
              />
              <datalist id="TagsTypeL">
                <option
                  v-for="(Type ,index) in tags "
                  :key="index"
                  :value="Type.name"
                  v-if="Type.type =='warehouse'"
                />
              </datalist>
            </div>
            <!---->

            <div class="form-group">
              <label for="countofwares">{{$t("countofwares")}}</label>
              <input
                required
                type="text"
                name="countofwares"
                class="form-control"
                id="countofwares"
                :placeholder="$t('enter')+$t('countofwares')"
                v-model="ware.countofwares"
              />
            </div>
            <!---->
            <div class="form-group">
              <label for="inputoutput">{{$t("inputoutput")}}</label>
              <model-select
                :options="inputoutput"
                v-model="ware.inputoutput"
                :placeholder="$t('search')"
              ></model-select>
            </div>
            <!---->
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
                  v-model="ware.date"
                />
              </div>
            </div>
            <!---->
          </div>
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
      warehouses: [],
      tags: [],

      inputoutput: [
        { value: "input", text: this.$t("input") },
        { value: "output", text: this.$t("output") }
      ],
      editmode: false,

      ware: {
        id: 0,
        tags_id: 0,
        countofwares: 0,
        inputoutput: "input",
        date: this.$moment(new Date()).format("YYYY-MM-DD"),
        numberwarehouse: 0,

        nameware: ""
      },
      sendbutton: true,
      //tablestart
      pagetable: 0,
      pagetablecurrct: 1,
      pagetablecurrct2: 1,
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
    warehousesinventorycount: function() {
      var datasorting = this.warehouses;
      var data = [];

      for (let index = 0; index < datasorting.length; index++) {

        var find = false;
        for (let index2 = 0; index2 < data.length; index2++) {
          if (datasorting[index].tags_id == data[index2].id) {
            if (datasorting[index].inputoutput == "input")
              data[index2].count += datasorting[index].countofwares;
            else data[index2].count -= datasorting[index].countofwares;

            find = true;
            break;
          }
        }
        if (!find) {
          var count = 0;
          if (datasorting[index].inputoutput == "input")
            count += datasorting[index].countofwares;
          else count -= datasorting[index].countofwares;

          data.push({
            id: datasorting[index].tags_id,
            count: count,
          });
        }
      }

      return data;
    },
    //tablestart
    dataTable: function() {
      this.pagetable = Math.ceil(this.warehouses.length / this.countporpage);
      if (this.warehouses.length >= this.countporpage) {
        let data = [];
        if (this.pagetable < this.pagetablecurrct)
          this.pagetablecurrct = this.pagetable;
        let maxindex = this.countporpage * this.pagetablecurrct;
        if (maxindex > this.warehouses.length)
          maxindex = this.warehouses.length;
        for (
          let index = this.countporpage * (this.pagetablecurrct - 1);
          index < maxindex;
          index++
        ) {
          data.push(this.warehouses[index]);
        }
        return data;
      } else return this.warehouses;
    },
    //tableend
    //tablestart
    dataTable2: function() {

      this.pagetable = Math.ceil(
        this.warehousesinventorycount.length / this.countporpage
      );
      if (this.warehousesinventorycount.length >= this.countporpage) {
        let data = [];
        if (this.pagetable < this.pagetablecurrct2)
          this.pagetablecurrct2 = this.pagetable;
        let maxindex = this.countporpage * this.pagetablecurrct2;
        if (maxindex > this.warehousesinventorycount.length)
          maxindex = this.warehousesinventorycount.length;
        for (
          let index = this.countporpage * (this.pagetablecurrct2 - 1);
          index < maxindex;
          index++
        ) {
          data.push(this.warehousesinventorycount[index]);
        }
        return data;
      } else return this.warehousesinventorycount;
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
              vm.$api.warehouses.destroy(id);
              for (let index = 0; index < vm.warehouses.length; index++) {
                if (vm.warehouses[index].id == id) {
                  vm.warehouses.splice(index, 1);
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
      let ware = {};

      for (let index = 0; index < this.warehouses.length; index++) {
        if (this.warehouses[index].id == id) {
          ware = this.warehouses[index];
          break;
        }
      }

      ware.nameware = this.gettags(ware.tags_id);
      this.ware = Object.assign({}, ware);
      this.editmode = true;

      this.$forceUpdate();
    },
    cancelModeEdit() {
      this.cleaninput();
      this.editmode = false;
    },
    gettags(id) {
      for (let index = 0; index < this.tags.length; index++) {
        if (this.tags[index].id == id) return this.tags[index].name;
      }

      return this.$t("TagsNotFound");
    },
    //tablestart
    pagetablecurrctset(number) {
      this.pagetablecurrct = number;
    },
    //tablestart
    pagetablecurrctset2(number) {
      this.pagetablecurrct2 = number;
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
      this.ware = {};
      this.ware = {
        id: 0,
        tags_id: 0,
        countofwares: 0,
        inputoutput: "input",
        date: this.$moment(new Date()).format("YYYY-MM-DD"),
        numberwarehouse: 0,

        nameware: ""
      };
    },
    checkForm: async function(e) {
      e.preventDefault();

      this.sendbutton = false;
      var error = [];
      if (!this.checkinput(this.ware.nameware, "nameware")) return false;

      this.ware.tags_id = 0;

      for (let index = 0; index < this.tags.length; index++) {
        if (this.tags[index].name == this.ware.nameware)
          this.ware.tags_id = this.tags[index].id;
      }
      if (this.ware.tags_id == null || this.ware.tags_id == 0) {
        var typeoftag = "warehouse";

        await this.$api.tags
          .store({
            name: this.ware.nameware,
            type: typeoftag
          })
          .then(res => {
            this.ware.tags_id = res.data.data.id;
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
        !this.checkinput(this.ware.inputoutput, "inputoutput") ||
        !this.checkinput(this.ware.date, "date")
      ) {
        this.sendbutton = true;
        return false;
      }
      if (!Number.isInteger(Number.parseInt(this.ware.countofwares))) {
        this.ware.count = 0;
        this.checkinput(this.ware.countofwares, "countofwares");
        this.sendbutton = true;
        return false;
      }

      if (this.editmode) {
        await this.$api.warehouses
          .update(this.ware)
          .then(res => {})
          .catch(err => {
            console.log(err);
            error.push({
              msg: this.$t("Icantupdatewarehouses")
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
        await this.$api.warehouses
          .store(this.ware)
          .then(res => {})
          .catch(err => {
            console.log(err);
            error.push({
              msg: this.$t("IcantAddwarehouses")
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
      this.$api.tags
        .index()
        .then(res => {
          this.tags = res.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
      this.$api.warehouses
        .index()
        .then(res => {
          this.warehouses = res.data.data;
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
