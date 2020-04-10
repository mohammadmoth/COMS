<template>
  <div>
    <div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$t("SponsorsTable")}}</h3>
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
                <th>{{$t("idnumber")}}</th>
                <th>{{$t("childrenInfo")}}</th>
                <th>{{$t("sponsorInfo")}}</th>
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
                </td>
                <td>
                  <div>{{$t("mobilephone")}}: {{data.mobilephone}}</div>
                  <div>{{$t("phone")}}: {{data.phone}}</div>
                </td>

                <td>
                  <div>{{$t("birthday")}}: {{data.birthday | moment("DD/MM/YYYY" )}}</div>
                </td>
                <td>
                  <div>{{data.idnumber}}</div>
                </td>
                <td>
                  <span v-show="getchildren(data.id).length!=0">
                    <div
                      v-for="( child , index) in getchildren(data.id)"
                      :key="index"
                    >{{index+1}}. {{child.firstname}} {{child.lastname}}</div>
                  </span>
                  <span v-show="getchildren(data.id).length==0">
                    <div>{{$t("IshaveNotChildren")}}</div>
                  </span>
                </td>
                <td>
                  <div v-if="data.typesponsor=='money'">{{$t(data.typesponsor)}}</div>
                  <div v-else>
                    {{$t(data.typesponsor)}}
                    <div></div>
                  </div>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>{{$t("event")}}</th>
                <th>{{$t("name")}}</th>
                <th>{{$t("ContactInfo")}}</th>
                <th>{{$t("BirthInfo")}}</th>
                <th>{{$t("idnumber")}}</th>
                <th>{{$t("childrenInfo")}}</th>
                <th>{{$t("sponsorInfo")}}</th>
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
          <h3 class="card-title">{{$t(editmodeString)}} {{$t("Sponsor")}}</h3>
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
                v-model="sponsor.firstname"
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
                v-model="sponsor.lastname"
              />
            </div>
            <div class="form-group">
              <label for="idnumber">{{$t("idnumber")}}</label>
              <input
                required
                type="text"
                name="idnumber"
                class="form-control"
                id="idnumber"
                :placeholder="$t('enteridnumber')"
                v-model="sponsor.idnumber"
              />
            </div>
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
                  v-model="sponsor.birthday"
                />
              </div>
            </div>
            <!---->
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
                  v-model="sponsor.mobilephone"
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
                  v-model="sponsor.phone"
                />
              </div>
            </div>

            <!---->
            <div class="form-group">
              <span>
                <div class="form-group">
                  <label>{{$t("typesponsor")}}</label>
                  <model-select
                    :options="typesponsorstring"
                    v-model="sponsor.typesponsor"
                    :placeholder="$t('search')"
                  ></model-select>
                </div>

                <!-- /.form group -->
              </span>
            </div>

            <!---->
            <div class="form-group">
              <span v-show="sponsor.typesponsor=='medical'">
                <div class="form-group">
                  <label>{{$t("typesponsor")}}</label>
                  <model-select
                    :options="tagsifmedica"
                    v-model="tagsifmedicaSelected"
                    :placeholder="$t('search')"
                  ></model-select>
                </div>
                <div class="form-group">
                  <label for="TagsType">{{$t(stringOfTypeSelected)}}</label>
                  <input
                    type="text"
                    id="TagsType"
                    name="TagsType"
                    class="form-control"
                    :placeholder="$t('Enter')+' '+$t(stringOfTypeSelected)"
                    v-model="tagsifmedicastring"
                    list="TagsTypeL"
                    autocomplete="off"
                  />
                  <datalist id="TagsTypeL">
                    <option
                      v-for="(Type ,index) in tags "
                      :key="index"
                      :value="Type.name"
                      v-if="Type.type ==tagsifmedicaSelected"
                    />
                  </datalist>
                </div>
              </span>
            </div>
            <!---->
            <div class="form-group">
              <div class="form-group">
                <label>{{$t("children")}}</label>
                <model-select
                  :options="childrenobject"
                  v-model="selectchildrenobjectid"
                  :placeholder="$t('search')"
                ></model-select>
                <button
                  @click="addingNewChild(selectchildrenobjectid)"
                  type="button"
                  class="btn btn-info"
                >
                  <i class="fas fa-plus"></i>
                </button>
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
              <div class="form-group">
                <label>{{$t("children")}}</label>

                <div
                  v-for="(child , index) in sponsor.childrenaddingtable"
                  :key="index"
                  class="form-group"
                >
                  {{index+1}}. {{child.firstname}} {{child.lastname}} {{child.startsopnser || moment("DD/MM/YYYY" )}} - {{child.endsponosor || moment("DD/MM/YYYY" )}}
                  <button
                    @click="removeitemchlid(index)"
                    type="button"
                    class="btn btn-info"
                  >
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
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
      sponsors: [],
      tags: [],
      hasfromsponsors: [],
      children: [],
      tagsifmedica: [
        {
          value: "sopnsors",
          text: this.$t("surgery")
        },
        {
          value: "medical",
          text: this.$t("medicine")
        }
      ],
      typesponsorstring: [
        {
          value: "money",
          text: this.$t("money")
        },
        {
          value: "medical",
          text: this.$t("medical")
        },
        {
          value: "educational",
          text: this.$t("educational")
        }
      ],
      editmode: false,

      ChildRemoveHas: [],
      tagsifmedicaSelected: "sopnsors",
      tagsifmedicastring: "",
      selectchildrenobjectid: 0,
      sponsor: {
        id: 0,
        firstname: "",
        lastname: "",
        mobilephone: "",
        phone: "",
        idnumber: "",
        birthday: "",
        typesponsor: "money",
        tags_id: null,
        childrenaddingtable: []
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
    stringOfTypeSelected: function() {
      if (this.tagsifmedicaSelected == "sopnsors") {
        return "surgery";
      } else return "medicine";
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
      this.pagetable = Math.ceil(this.sponsors.length / this.countporpage);
      if (this.sponsors.length >= this.countporpage) {
        let data = [];
        if (this.pagetable < this.pagetablecurrct)
          this.pagetablecurrct = this.pagetable;
        let maxindex = this.countporpage * this.pagetablecurrct;
        if (maxindex > this.sponsors.length) maxindex = this.sponsors.length;
        for (
          let index = this.countporpage * (this.pagetablecurrct - 1);
          index < maxindex;
          index++
        ) {
          data.push(this.sponsors[index]);
        }
        return data;
      } else return this.sponsors;
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
              vm.$api.sponsors.destroy(id);
              for (let index = 0; index < vm.sponsors.length; index++) {
                if (vm.sponsors[index].id == id) {
                  vm.sponsors.splice(index, 1);
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
    removeitemchlid(index) {
      if (this.editmode)
        this.ChildRemoveHas.push(this.sponsor.childrenaddingtable[index]);

      this.sponsor.childrenaddingtable.splice(index, 1);
      this.$forceUpdate();
    },
    addingNewChild() {
      ///chackdate

      if (
        this.$moment(
          $("#reservation")
            .data("daterangepicker")
            .startDate.format("YYYY-MM-DD"),
          "YYYY-MM-DD"
        ).isSameOrAfter(
          this.$moment(
            $("#reservation")
              .data("daterangepicker")
              .endDate.format("YYYY-MM-DD"),
            "YYYY-MM-DD"
          )
        )
      ) {
        this.ShowMesBox(
          this.$t("ErrorOnDateMostDataStartFirstEnd"),
          this.$t("Errorinput"),
          this.$t("ok")
        );
        return;
      }

      for (let index = 0; index < this.children.length; index++) {
        let it_added_befor = false;
        if (this.selectchildrenobjectid == this.children[index].id) {
          this.selectchildrenobjectid = 0;

          for (
            let index2 = 0;
            index2 < this.sponsor.childrenaddingtable.length;
            index2++
          ) {
            if (
              this.sponsor.childrenaddingtable[index2].id ==
              this.children[index].id
            ) {
              it_added_befor = true;
              break;
            }
          }
          if (it_added_befor) break;

          this.children[index].startsopnser = $("#reservation")
            .data("daterangepicker")
            .startDate.format("YYYY-MM-DD");

          this.children[index].endsponosor = $("#reservation")
            .data("daterangepicker")
            .endDate.format("YYYY-MM-DD");

          this.sponsor.childrenaddingtable.push(this.children[index]);
          break;
        }
      }
    },
    getchildren(idsponsor) {
      let array = [];
      for (let index = 0; index < this.hasfromsponsors.length; index++) {
        if (this.hasfromsponsors[index].id_sponsor == idsponsor)
          for (let je = 0; je < this.children.length; je++) {
            if (this.children[je].id == this.hasfromsponsors[index].id_child) {
              this.children[je].startsopnser = this.hasfromsponsors[
                index
              ].startsopnser;
              this.children[je].endsponosor = this.hasfromsponsors[
                index
              ].endsponosor;
              this.children[je].hasfromsponsors_id = this.hasfromsponsors[
                index
              ].id;

              array.push(this.children[je]);
              break;
            }
          }
      }

      return array;
    },
    enb_edit(id) {
      for (let index = 0; index < this.sponsors.length; index++) {
        if (this.sponsors[index].id == id) {
          this.sponsor = this.sponsors[index];
          break;
        }
      }
      if (this.sponsor.id != 0) {
        this.sponsor.childrenaddingtable = this.getchildren(this.sponsor.id);
      }

      if (this.sponsor.tags_id > 0) {
        var type = {};
        for (let index = 0; index < this.tags.length; index++) {
          if (this.tags[index].id == this.sponsor.tags_id) {
            type = this.tags[index];
          }
        }

        if ("id" in type) {
          if (type.type == "medici") this.tagsifmedicaSelected = "medical";
          else this.tagsifmedicaSelected = type.type;

          this.tagsifmedicastring = type.name;
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
    getSrugerytype: function(id) {
      for (let index = 0; index < this.tags.length; index++) {
        if (this.tags[index].id == id) {
          return this.tags[index].name;
        }
      }
      return this.$t("TagsNotFound");
    },
    cleaninput: function() {
      this.sponsor = {};

      this.ChildRemoveHas = [];
      this.tagsifmedicaSelected = "sopnsors";
      this.tagsifmedicastring = "";
      this.selectchildrenobjectid = 0;
      this.sponsor = {
        id: 0,
        firstname: "",
        lastname: "",
        mobilephone: "",
        phone: "",
        idnumber: "",
        birthday: "",
        typesponsor: "money",
        tags_id: null,
        childrenaddingtable: []
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

      if (this.sponsor.typesponsor != "money") {
        if (!this.checkinput(this.tagsifmedicastring, "tagsifmedicastring"))
          return false;

        for (let index = 0; index < this.tags.length; index++) {
          if (this.tags[index].name == this.tagsifmedicastring)
            this.sponsor.tags_id = this.tags[index].id;
        }

        if (this.sponsor.tags_id == null || this.sponsor.tags_id == 0) {
          var typeoftag = "sopnsors";
          if (this.tagsifmedicaSelected == "medical") typeoftag = "medici";

          await this.$api.tags
            .store({
              name: this.tagsifmedicastring,
              type: typeoftag
            })
            .then(res => {
              this.sponsor.tags_id = res.data.data.id;
            })
            .catch(err => {
              console.log(err);
              error.push({
                msg: this.$t("IcantAddTags")
              });
            });
        }
      }
      if (this.sponsor.typesponsor != "money") {
        if (this.sponsor.tags_id == 0 || this.sponsor.tags_id == null)
          error.push({
            msg: this.$t("IcantAddTags") + " #1"
          });
      }
      if (error.length > 0) {
        this.showAllMsg(error);
        return;
      }

      if (
        !this.checkinput(this.sponsor.firstname, "firstname") ||
        !this.checkinput(this.sponsor.lastname, "lastname") ||
        !this.checkinput(this.sponsor.mobilephone, "mobilephone") ||
        !this.checkinput(this.sponsor.phone, "phone") ||
        !this.checkinput(this.sponsor.idnumber, "idnumber") ||
        !this.checkinput(this.sponsor.birthplace, "birthplace") ||
        !this.checkinput(this.sponsor.birthday, "birthday")
      ) {
        this.sendbutton = true;
        return false;
      }

      if (
        this.$moment(this.sponsor.birthday, "YYYY-MM-DD").isAfter(
          this.$moment(new Date())
        )
      ) {
        this.ShowMesBox(
          this.$t("ErrorOnDataIsAfterNowBirthday"),
          this.$t("Errorinput"),
          this.$t("ok")
        );
        this.sendbutton = true;
        return;
      }

      // $('#reservation').data('daterangepicker').startDate.format();

      if (this.editmode) {
        /*
        remove maping in data base
        */
        for (let index = 0; index < this.ChildRemoveHas.length; index++) {
          if ("hasfromsponsors_id" in this.ChildRemoveHas[index])
            await this.$api.hasfromsponsors
              .destroy(this.ChildRemoveHas[index].hasfromsponsors_id)
              .then(res => {})
              .catch(err => {
                error.push({ msg: "IcantRemoveItemFromHasChlidrenTable" });
              });
          if (error.length > 0) break;
        }
        this.ChildRemoveHas = []; // reset Chlid for remove array

        if (error.length > 0) {
          this.showAllMsg(error);
          return;
        }

        /*
        add maping
        */
        for (
          let index = 0;
          index < this.sponsor.childrenaddingtable.length;
          index++
        ) {
          if ("hasfromsponsors_id" in this.sponsor.childrenaddingtable[index]) {
            await this.$api.hasfromsponsors
              .update({
                id: this.sponsor.childrenaddingtable[index].hasfromsponsors_id,
                id_child: this.sponsor.childrenaddingtable[index].id,
                id_sponsor: this.sponsor.id,
                startsopnser: this.sponsor.childrenaddingtable[index]
                  .startsopnser,
                endsponosor: this.sponsor.childrenaddingtable[index].endsponosor
              })
              .then(res => {})
              .catch(err => {
                error.push({ msg: "IcantEditMapingChildAndSponsor" });
              });
          } else {
            await this.$api.hasfromsponsors
              .store({
                id_child: this.sponsor.childrenaddingtable[index].id,
                id_sponsor: this.sponsor.id,
                startsopnser: this.sponsor.childrenaddingtable[index]
                  .startsopnser,
                endsponosor: this.sponsor.childrenaddingtable[index].endsponosor
              })
              .then(res => {})
              .catch(err => {
                // if ( error.res.data.data)
                error.push({
                  msg: this.$t("IcantMapingChildAndSponsor")
                });
              });
          }
          if (error.length > 0) break;
        }
        if (error.length > 0) {
          this.showAllMsg(error);
          return;
        }

        await this.$api.sponsors
          .update(this.sponsor)
          .then(res => {})
          .catch(error => {
            error.push({
              msg: this.$t("IcantMapingChildAndSponsor")
            });
          });

        if (error.length > 0) {
          this.showAllMsg(error);
          return;
        } else {
          this.ShowMesBox(
            this.$t("updateComplete"),
            this.$t("updateComplete"),
            this.$t("ok")
          );
        }
      } else {
        /* **Adding sponsor first

          */
        await this.$api.sponsors
          .store(this.sponsor)
          .then(res => {
            this.sponsor.id = res.data.data.id;
          })
          .catch(err => {
            error.push({ msg: this.$t("icantaddsponsor") });
          });
        /* **if have error

          */
        if (error.length > 0) {
          this.showAllMsg(error);
          return;
        }
        for (
          let index = 0;
          index < this.sponsor.childrenaddingtable.length;
          index++
        ) {
          await this.$api.hasfromsponsors
            .store({
              id_child: this.sponsor.childrenaddingtable[index].id,
              id_sponsor: this.sponsor.id,
              startsopnser: this.sponsor.childrenaddingtable[index]
                .startsopnser,

              endsponosor: this.sponsor.childrenaddingtable[index].endsponosor
            })
            .then(res => {})
            .catch(err => {
              // if ( error.res.data.data)
              error.push({
                msg: this.$t("IcantMapingChildAndSponsor")
              });
            });

          if (error.length > 0) {
            this.showAllMsg(error);
            return;
          }
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
      this.$api.hasfromsponsors
        .index()
        .then(res => {
          this.hasfromsponsors = res.data.data;
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
      this.$api.sponsors
        .index()
        .then(res => {
          this.sponsors = res.data.data;
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
