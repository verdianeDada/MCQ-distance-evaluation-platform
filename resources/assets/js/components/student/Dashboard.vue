<template>
  <div class="row">
    <sidebar
      class="col-md-3 sidebar"
      :courses = "courses"
      :repeatingCourses = "repeatingCourses"
    ></sidebar>
    <div class="col-md-9" style="padding:35px">
      <div class="row" style="margin-top: 20px;">
        <!-- exam -->
        <div v-if="testNow && actualTest!={} && !actualTest.done" style="margin-bottom: 20px; background-color: rgba(255, 0, 0, 0.16);">
          <a class="btn btn-primary"  href="/write_test">Start test</a>
          &nbsp;&nbsp;...
          <span class="bold capitalize" style="font-size: 15px">{{actualTest.title}} </span>
          <span>&nbsp;&nbsp; Start-time: &nbsp;</span><span class="bold capitalize" style="font-size: 15px">{{actualTest.start_time}}</span>
          <span>&nbsp;&nbsp; End-time: &nbsp;</span><span class="bold capitalize" style="font-size: 15px">{{actualTest.end_time}}</span>
        </div>
        <testpapers 
          class="test-paper"
          :testpapers ="testpapers"
          :repeatingTestpapers="repeatingTestpapers"
          :todayTestpapers="todayTestpapers"
          :download_r="download_r"
        ></testpapers>
      </div>
    </div>

 
    </div>
</template>

<script>
import sidebar from "./Sidebar.vue";
import testpapers from "./Testpapers.vue";

export default {
  mounted() {
    this.loadpage();
  },
  data: function() {
    return {
      courses: [],
      repeatingCourses: [],
      testpapers: [],
      repeatingTestpapers: [],
      todayTestpapers: [],
      examPeriod: "",
      actualTest: {},
      testNow: false
    };
  },
  methods: {
    loadpage: function() {
      axios
        .get("api/studentdashboard/")
        .then(res => {
          console.log(res);
          if (res.data.courses) this.courses = res.data.courses;
          if (res.data.testpapers) this.testpapers = res.data.testpapers;
          if (res.data.repeatingCourses)
            this.repeatingCourses = res.data.repeatingCourses;
          if (res.data.repeatingTestpapers) {
            this.repeatingTestpapers = res.data.repeatingTestpapers;

            this.repeatingTestpapers.sort(function compare(a, b) {
              var dateA = new Date(a.date);
              var dateB = new Date(b.date);
              return new Date(b.updated_at) - new Date(a.updated_at);
            });
          }

          if (res.data.todayTestpapers) {
            this.todayTestpapers = res.data.todayTestpapers;
            this.todayTestpapers.sort(function compare(a, b) {
              var time1 = parseFloat(
                a.start_time.replace(":", ".").replace(/[^\d.-]/g, "")
              );
              var time2 = parseFloat(
                b.start_time.replace(":", ".").replace(/[^\d.-]/g, "")
              );
              if (time1 < time2) return -1;
              if (time1 > time2) return 1;
              return 0;
            });
            this.checkActualTest();
            this.examPeriod = setInterval(() => {
              this.checkActualTest();
            }, 30000);
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    checkActualTest: function() {
      var now = new Date();
      now = new Date(+now - now.getTimezoneOffset() + 3600000)
        .toISOString()
        .split(".")[0];

      now = now.split("T");
      var todayDate = now[0];

      now = now[1].split(":");
      now = now[0] + ":" + now[1] + ":" + "00";
      console.log(this.testNow);
      if (!this.testNow) {
        // console.log("is ts false");
        this.todayTestpapers.forEach(test => {
          if (
            now >= test.start_time &&
            now < test.end_time &&
            test.date == todayDate &&
            !test.done
          ) {
            this.actualTest = test;
            this.testNow = true;
            console.log("ther is new test");
          }
        });
      } else {
        if (now >= this.actualTest.end_time) {
          this.testNow = false;
          this.actualTest = {};
          console.log("test ended");
        } else console.log("RAS");
      }
    },
    download_r: function(testid) {
      // download correction
      location.href = "/download_r/" + testid;
    }
  },

  components: {
    sidebar,
    testpapers
  },

  props: ["userid", "username", "usersex"]
};
</script>
