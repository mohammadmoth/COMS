<template>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box" :class="typenamber | settype">
      <div class="inner">
        <h3>{{count}}</h3>

        <p>{{title}}</p>
      </div>
      <div class="icon">
        <i :class="icon | setIcon"></i>
      </div>
      <router-link class="small-box-footer" :to="{ name: routName}">
        <a>{{$t("see_more")}}</a>
        <i class="fas fa-arrow-circle-right"></i>
      </router-link>
    </div>
  </div>
</template>

<script>
const typeCard = ["bg-info", "bg-success", "bg-warning", " bg-danger"];
export default {
  name: "CardSammare",
  props: {
    title: String,
    count: Number,
    routName: String,
    typenamber: Number,
    icon: String
  },
  data() {
    return {};
  },
  filters: {
    settype: function(value) {
      return typeCard[value];
    },
    setIcon: function(value) {
      return "fas fa-" + value;
    }
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>
