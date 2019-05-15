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
        <div v-if="testNow && actualTest!={}">
          <a class="btn btn-primary" target="_blank" href="/write_test">Start test</a>
          <span class="bold capitalize" style="font-size: 15px">{{actualTest.title}}: </span>
        </div>
        <legend></legend>
        <testpapers 
          class="test-paper"
          :testpapers ="testpapers"
          :repeatingTestpapers="repeatingTestpapers"
          :todayTestpapers="todayTestpapers"
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
      testNow: true
    };
  },
  methods: {
    loadpage: function() {
      axios
        .get("api/studentdashboard/")
        .then(res => {
          this.courses = res.data.courses;
          this.repeatingCourses = res.data.repeatingCourses;
          this.testpapers = res.data.testpapers;
          this.repeatingTestpapers = res.data.repeatingTestpapers;
          this.todayTestpapers = res.data.todayTestpapers;

          this.repeatingTestpapers.sort(function compare(a, b) {
            var dateA = new Date(a.date);
            var dateB = new Date(b.date);
            return new Date(b.updated_at) - new Date(a.updated_at);
          });

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

          this.actualTest = this.todayTestpapers[0];
          // this.examPeriod = setInterval(() => {
          //   var now = new Date();
          //   now = new Date(+now - now.getTimezoneOffset() + 3600000)
          //     .toISOString()
          //     .split(".")[0];

          //   now = now.split("T");
          //   var todayDate = now[0];

          //   now = now[1].split(":");
          //   now = now[0] + ":" + now[1] + ":" + "00";
          //   console.log(this.testNow);
          //   if (!this.testNow) {
          //     // console.log("is ts false");
          //     this.todayTestpapers.forEach(test => {
          //       if (
          //         now >= test.start_time &&
          //         now < test.end_time &&
          //         test.date == todayDate
          //       ) {
          //         this.actualTest = test;
          //         this.testNow = true;
          //         console.log("ther is new test");
          //       }
          //     });
          //   } else {
          //     if (now >= this.actualTest.end_time) {
          //       this.testNow = false;
          //       this.actualTest = {};
          //       console.log("test ended");
          //     } else console.log("RAS");
          //   }
          // }, 700);
        })
        .catch(error => {
          console.log(error);
        });
    }
  },

  components: {
    sidebar,
    testpapers
  },

  props: ["userid", "username", "usersex"]
};
</script>
