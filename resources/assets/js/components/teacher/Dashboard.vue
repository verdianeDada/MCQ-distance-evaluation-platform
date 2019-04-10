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
        :createTestPaper = "createTestPaper"
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
    createTestPaper: function(testpaper) {
      console.log(this.testpaper.duration);
      //   $("#testpapermodal").modal("hide");
    },
    loadpage: function() {
      axios
        .get("api/teacherdashboard/")
        .then(res => {
          this.courses = res.data.courses;
          var mytestpapers = res.data.testpapers;

          mytestpapers.forEach(testpaper => {
            if (!testpaper.course) {
              var index = mytestpapers
                .map(function(testpaper) {
                  return testpaper.id;
                })
                .indexOf(testpaper.id);
              mytestpapers.splice(index, 1);
            }
          });
          this.mytestpapers = mytestpapers;
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
