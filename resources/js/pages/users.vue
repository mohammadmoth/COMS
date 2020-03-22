<template>
  <div>
    <div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$t("UsersTable")}}</h3>
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
                <th>{{$t("email")}}</th>
                <th>{{$t("rules")}}</th>
                <th>{{$t("lastlogin")}}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(user ,index) in dataTable" :key="index">
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
                            @click="remove(user.id, index)"
                            href="#"
                          >{{$t("remove")}}</a>
                          <div class="dropdown-divider"></div>
                          <a
                            class="dropdown-item"
                            @click="ShowMesBoxConfingResetPassword(user.id)"
                            href="#"
                          >{{$t("ResetPassword")}}</a>
                        </div>
                      </button>
                    </div>
                  </div>
                </td>

                <td>
                  <input
                    :key="index"
                    type="text"
                    v-model="user.name"
                    @change="updating(index)"
                    style="border: 0px none; background-color: transparent;width: 100%;
    min-width: 240px;"
                  />
                </td>
                <td>
                  <input
                    :key="index"
                    type="text"
                    @change="updating(index)"
                    v-model="user.email"
                    style="border: 0px none; background-color: transparent;width: 100%;
    min-width: 240px;"
                  />
                </td>

                <td>
                  <select
                    :key="index"
                    v-model="user.rules"
                    style="min-width: 100px;"
                    class="form-control select2bs4"
                    @change="updating(index)"
                  >
                    <option value="admin">{{$t("admin")}}</option>
                    <option value="editor">{{$t("editor")}}</option>
                    <option value="monitor">{{$t("monitor")}}</option>
                  </select>
                </td>
                <td>{{user.lastlogin | moment()}}</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th>{{$t("event")}}</th>
                <th>{{$t("name")}}</th>
                <th>{{$t("email")}}</th>
                <th>{{$t("rules")}}</th>
                <th>{{$t("lastlogin")}}</th>
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
          <h3 class="card-title">{{$t("AddUsers")}}</h3>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form @submit="checkForm" action="#" role="form">
          <div class="card-body">
            <!--Name Input-->
            <div class="form-group">
              <label for>{{$t("Name")}}</label>
              <input
                type="text"
                name="Name"
                class="form-control"
                id="Name"
                :placeholder="$t('Name')"
                v-model="name"
              />
            </div>

            <!---->
            <div class="form-group">
              <label for="email">{{$t("email")}}</label>
              <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                :placeholder="$t('Enteremail')"
                v-model="email"
              />
            </div>

            <!---->
            <div class="form-group">
              <label for="password">{{$t("password")}}</label>
              <input
                v-model="password"
                type="password"
                name="passowrd"
                class="form-control"
                :placeholder="$t('Enterpassword')"
              />
            </div>
            <div class="form-group" style="min-width: 100px;">
              <label for="rules">{{$t("rules")}}</label>
              <select id="rules" v-model="rules" class="form-control select2bs4">
                <option value="admin">{{$t("admin")}}</option>
                <option value="editor">{{$t("editor")}}</option>
                <option value="monitor">{{$t("monitor")}}</option>
              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button :disabled="!sendbutton" type="submit" class="btn btn-info">{{ $t("Add") }}</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      users: [],
      name: "",
      email: "",
      rules: "editor",
      password: "",
      sendbutton: true,
      passwordReset: "",
      //tablestart
      pagetable: 0,
      pagetablecurrct: 1,
      countporpage: 2
      //tableend
    };
  },
  computed: {
    //tablestart
    dataTable: function() {
      this.pagetable = Math.ceil(this.users.length / this.countporpage);
      if (this.users.length >= this.countporpage) {
        let data = [];
        if (this.pagetable < this.pagetablecurrct)
          this.pagetablecurrct = this.pagetable;
        let maxindex = this.countporpage * this.pagetablecurrct;
        if (maxindex > this.users.length) maxindex = this.users.length;
        for (
          let index = this.countporpage * (this.pagetablecurrct - 1);
          index < maxindex;
          index++
        ) {
          data.push(this.users[index]);
        }
        return data;
      } else return this.users;
    }
    //tableend
  },
  methods: {
    //tablestart
    pagetablecurrctset(number) {
      this.pagetablecurrct = number;
    },
    //tableend
    updating(index) {
      this.$user
        .update(this.users[index])
        .then()
        .catch(function(error) {
          console.log(error);
          this.ShowMesBox("error_send_data_not_saved", "error", "try_agein");
        });
    },
    remove(id, index) {
      this.users.splice(index, 1);
      this.$user
        .destroy(id)
        .then(res => {
          this.fetch();
        })
        .catch(function(error) {
          console.log(error);
          this.ShowMesBox("error_send_data_not_saved", "error", "try_agein");
        });
    },

    ResetPassword(id, password) {
    this.$user.update({id:id , password:password}).then().catch(function(error) {
          console.log(error);
          this.ShowMesBox("error_send_data_not_saved", "error", "try_agein");
        });
    },
    ShowMesBoxConfingResetPassword(id) {
      var vm = this;
      $.confirm({
        title: this.$t("ConformPasswordResetTitle"),
        content:
         
          '<div class="form-group">' +
          "<label></label>" +
          '<input type="passowrd" name"passwordReset" placeholder="' +
          this.$t("EnterPassword") +'"   class="name form-control" required />' +
          "</div>" ,
        buttons: {
          formSubmit: {
            text: this.$t("ConformPasswordReset"),
            btnClass: "btn-red",
            action: function() {
               if ( this.$content.find(".name").val() == "")
              return false;

              vm.ResetPassword(id, this.$content.find(".name").val());
             
            }
          },
          cancel: function() {
            //close
          }
        }
      });
    },
    ShowMesBox(messg, title, btnname) {
      $.alert({
        title: this.$t(title),
        content: this.$t(messg),

        typeAnimated: true,
        buttons: {
          tryAgain: {
            rtl: true,
            text: this.$t(btnname),
            btnClass: "btn",
            action: function() {}
          }
        }
      });
    },
    show: function(mess) {},
    checkForm: function(e) {
      e.preventDefault();
      console.log("start");
      this.sendbutton = false;
      if (this.name == "" || this.password == "" || this.email == "") {
        this.ShowMesBox(
          "passowrd_or_name_or_email_is_empty",
          "error",
          "try_agein"
        );
        this.sendbutton = true;
        return;
      }
      this.users.push({
        name: this.name,
        password: this.password,
        email: this.email,
        rules: this.rules
      });
      this.$user
        .store({
          name: this.name,
          password: this.password,
          c_password: this.password,
          email: this.email,
          rules: this.rules
        })
        .then(res => {
          this.fetch();
          this.sendbutton = true;
        })
        .catch(function(error) {
          console.log(error);
          this.ShowMesBox("error_send_data_not_saved", "error", "try_agein");

          this.sendbutton = true;
        });
      this.name = "";
      this.password = "";
      this.email = "";
      this.rules = "editor";
    },
    fetch: function() {
      this.$user
        .index()
        .then(res => {
          this.users = res.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  },
  mounted() {
    this.fetch();
  }
};
</script>

<style>
</style>
