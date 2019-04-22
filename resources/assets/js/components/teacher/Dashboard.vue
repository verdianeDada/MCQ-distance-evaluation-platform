<template>
  <div class="row">
    <sidebar
      class="col-md-3 sidebar"
      :courses = "courses"
    ></sidebar>
    <div class="col-md-9" style="padding:35px">
      <div class="row" style="margin-top: -30px;  margin-bottom: 20px;">
        <div class="nav right">
          <a href="#" class="bold">Home /</a>
          <a href="/testreport" class="bold">&nbsp;test reports</a>
        </div>
      </div>
      <div class="row">
        <button 
          class="btn btn-primary"
          data-toggle = "modal"
          data-target = "#testpapermodal"
        >
          Create a Test
        </button>
      </div>
      <div class="row" style="margin-top: 20px;">
        <testpapers 
          class="test-paper"
          :mytestpapers = "mytestpapers"
        ></testpapers>
      </div>
    </div>

    <!-- modal to create a new test paper -->
    <div class="modal fade" 
      id="testpapermodal"
      ref="testpapermodal"
      role="dialog"
    >
      <testpapermodal
        :courses = "courses"
        :mytestpapers="mytestpapers"
      ></testpapermodal>
    </div>
  </div>
</template>

<script>
import sidebar from "./Sidebar.vue";
import testpapers from "./Testpapers.vue";
import testpapermodal from "../modals/TestPaper.vue";

export default {
  mounted() {
    this.loadpage();
  },
  data: function() {
    return {
      courses: [],
      mytestpapers: []
    };
  },
  methods: {
    loadpage: function() {
      axios
        .get("api/teacherdashboard/")
        .then(res => {
          this.courses = res.data.courses;
          this.mytestpapers = res.data.testpapers;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  components: {
    sidebar,
    testpapers,
    testpapermodal
  },

  props: ["userid", "username", "usersex"]
};
</script>
