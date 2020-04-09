<template>
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <CardSammare
      v-for="(data,index) in dataall"
      :key="index"
      :title="$t(data.title)"
      :count="data.count"
      :routName="data.routName"
      :typenamber="data.typenamber"
      :icon="data.icon"
    ></CardSammare>

    <!-- ./col -->
  </div>
  <!-- /.row -->
  <!-- Main row -->

  <!-- /.row (main row) -->
</template>

<script>
import CardSammare from ".././components/CardSammare.vue";
import NavBarItem from ".././components/NavBarItem.vue";
export default {
  components: {
    CardSammare,
    NavBarItem
  },
  data: function() {
    return {
      sponsors: [],
      tags: [],
      hasfromsponsors: [],
      children: [],
      families: []
    };
  },
  computed: {
    dataall: function() {
      var data = [];

      if ("title" in this.childrenRes) data.push(this.childrenRes);
      if ("title" in this.hasfromsponsorsRes)
        data.push(this.hasfromsponsorsRes);
      if ("title" in this.familiesRes) data.push(this.familiesRes);
      if ("title" in this.sponsorsRes) data.push(this.sponsorsRes);
      return data;
    },
    childrenRes: function() {
      var data = {};

      if (this.children.length == 0) {
        return data;
      }
      var res = this.children;

      data = {
        title: "children",
        count: this.children.length,
        routName: "children",
        typenamber: Math.floor(Math.random() * 3),
        icon: "child"
      };
      return data;
    },
    hasfromsponsorsRes: function() {
      var data = {};

      if (this.hasfromsponsors.length == 0) {
        return data;
      }

      data = {
        title: "hasfromsponsors",
        count: this.hasfromsponsors.length,
        routName: "sponsors",
        typenamber: Math.floor(Math.random() * 3),
        icon: "list-alt"
      };
      return data;
    },
    familiesRes: function() {
      var data = {};

      if (this.families.length == 0) {
        return data;
      }

      data = {
        title: "families",
        count: this.families.length,
        routName: "families",
        typenamber: Math.floor(Math.random() * 3),
        icon: "users"
      };
      return data;
    },
    sponsorsRes: function() {
      var data = {};

      if (this.sponsors.length == 0) {
        return data;
      }

      data = {
        title: "sponsors",
        count: this.sponsors.length,
        routName: "sponsors",
        typenamber: Math.floor(Math.random() * 3),
        icon: "user-shield"
      };
      return data;
    }
  },
  watch: {
    /*  firstname: function(val) {
      this.fullname = val + " " + this.lastname;
    }*/
  },

  filters: {},
  methods: {
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
  }
};
</script>

<style>
</style>
