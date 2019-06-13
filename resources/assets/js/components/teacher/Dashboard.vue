<template>
  <div class="row">
    <sidebar
      class="col-md-3 sidebar"
      :courses = "courses"
    ></sidebar>
    <div class="col-md-9" style="padding:35px">
      <div class="row">
        <button 
          class="btn btn-primary"
          data-toggle = "modal"
          data-target = "#testpapermodal"
          v-if="courses[0]"
          @click="clean"
          style="font-size: 18px;"
        >
          Create a Test
        </button>
      </div>
      <div class="row" style="margin-top: 20px;">
        <testpapers 
          class="test-paper"
          :mytestpapers ="mytestpapers"
          :courses="courses"
          :deleteTestPaper ="deleteTestPaper"
          :setModal="setModal"
          :downloadResults="downloadResults"
        ></testpapers>
      </div>
    </div>

    <!-- modal to create a new test paper -->
    <div class="modal fade" 
      id="testpapermodal"
      role="dialog"
    >
      <testpapermodal
        :courses ="courses"
        :mytestpapers="mytestpapers"
        :testpaper="testpaper"
        :dateProblem ="dateProblem"
        :generateQuestion="generateQuestion"
        :createTestPaper="createTestPaper"
        :updateTestPaper="updateTestPaper"
        :edit="edit"
        :clean="clean"
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
      mytestpapers: [],
      dateProblem: "",
      testpaper: {
        id: "",
        course_id: "",
        title: "",
        date: "",
        duration: "01:00",
        over_mark: "",
        questions: [this.generateQuestion(), this.generateQuestion()]
      },
      edit: false
    };
  },
  methods: {
    clean: function() {
      this.edit = false;
      this.testpaper.title = "";
      this.testpaper.course_id = "";
      this.testpaper.questions = [
        this.generateQuestion(),
        this.generateQuestion()
      ];
    },
    createTestPaper: function() {
      if (
        $("#test-paper-form")
          .parsley()
          .isValid()
      ) {
        var iQ = -1;
        this.testpaper.questions.forEach(question => {
          iQ++;
          question.index = iQ;
          var iD = -1;
          question.distractors.forEach(dis => {
            iD++;
            dis.index = iD;
          });
        });
        var params = Object.assign({}, this.testpaper);
        axios
          .post("api/testpaper", params)
          .then(res => {
            if (res.data.problem) this.dateProblem = res.data.problem;
            else {
              this.dateProblem = "";
              $("#testpapermodal").modal("hide");
              this.mytestpapers.unshift(res.data);
              this.clean();
            }
          })
          .catch(error => console.log(error));
      }
    },
    deleteTestPaper: function(tes) {
      axios
        .delete("api/testpaper/" + tes.id)
        .then(res => {
          this.mytestpapers.forEach(test => {
            if (test.id === tes.id) {
              var index = this.mytestpapers
                .map(function(test) {
                  return test;
                })
                .indexOf(test);
              this.mytestpapers.splice(index, 1);
            }
          });
        })
        .catch(error => console.log(error));
    },
    downloadResults: function(id) {
      location.href = "/results/" + id;
      // })
      // .catch(error => console.log(error));
    },
    generateQuestion: function() {
      return {
        index: "",
        is_correct: "0",
        text: "",
        over_mark: 2,
        distractors: [
          {
            text: ""
          },
          {
            text: ""
          }
        ]
      };
    },
    loadpage: function() {
      axios
        .get("api/teacherdashboard/")
        .then(res => {
          if (res.data.courses) this.courses = res.data.courses;
          if (res.data.testpapers) this.mytestpapers = res.data.testpapers;
        })
        .catch(error => {
          console.log(error);
        });
    },
    updateTestPaper: function() {
      if (
        $("#test-paper-form")
          .parsley()
          .isValid()
      ) {
        var iQ = -1;
        this.testpaper.questions.forEach(question => {
          iQ++;
          question.index = iQ;
          var iD = -1;
          question.distractors.forEach(dis => {
            iD++;
            dis.index = iD;
          });
        });
        var params = Object.assign({}, this.testpaper);
        axios
          .patch("api/testpaper", params)
          .then(res => {
            if (res.data.problem) this.dateProblem = res.data.problem;
            else {
              this.dateProblem = "";
              $("#testpapermodal").modal("hide");
              this.mytestpapers.unshift(res.data);
              this.clean();
              this.mytestpapers.forEach(test => {
                if (test.id === this.testpaper.id) {
                  var index = this.mytestpapers
                    .map(function(test) {
                      return test;
                    })
                    .indexOf(test);
                  this.mytestpapers.splice(index, 1);
                }
              });
            }
          })
          .catch(error => console.log(error));
      }
    },
    setModal: function(id) {
      this.edit = true;
      axios
        .get("api/set_update_testpaper/" + id)
        .then(res => {
          console.log(res.data);
          this.testpaper = res.data;
        })
        .catch(error => console.log(error));
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
