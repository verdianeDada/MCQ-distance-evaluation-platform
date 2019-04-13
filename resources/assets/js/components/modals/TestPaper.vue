<template>
    <div class="modal-dialog modal-lg">
        <form 
            method="post" 
            @submit.prevent
            id="test-paper-form"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close color-alarm" data-dismiss="modal">&times;</button>
                    <h3 class="bold color">New Test Paper</h3>
                </div>
                <div class="modal-body">                
                    <div style="margin-bottom: 30px">
                        <div class="row margin-0">
                            <div class="form-group col-lg-3 col-md-3">
                                <label for="course" class="control-label">Course : </label>
                                <select id="course" v-model = "testpaper.course_id" class="form-control" autofocus required>
                                    <option 
                                        disabled 
                                        :selected="true" 
                                        value=""
                                        
                                    >Choose the course</option>                                    
                                    <option 
                                    v-for="course in courses"
                                    :key = "course.id"
                                    :value= "course.id"
                                    >{{course.code}}: {{course.title}}</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3">
                                <label for="title" class="control-label">Title: </label>
                                <input type="text" id="title" class="form-control" placeholder="Test title" v-model = "testpaper.title" required>
                            </div>
                            <div class="form-group col-lg-3 col-md-3">
                                <label for="date" class="control-label">Starting Date & Time</label>
                                <input type="datetime-local" class="form-control" id="date" v-model="testpaper.start_time">
                            </div>
                        
                            <div class="form-group col-lg-3 col-md-3">
                                <label for="end" class="control-label">Duration</label>
                                <input type="time" id="end" class="form-control" v-model="testpaper.duration">
                            </div>                        
                        </div>
                        <div class="row margin-0">
                            <div class="form-group">
                                <label for="number" class="control-label col-md-1 col-lg-1 padding-0">Add question</label>
                                <div class="col-md-1 col-lg-1" style="padding: 0 8px;">
                                    <i class="fa fa-plus bold color btn" style="font-size: 20px" @click="addQuestion"></i>
                                </div>                            
                            </div>
                        </div> 
                    </div>     
                    <!-- a question  -->
                    <div>
                        <newquestion 
                        v-for="(question, index) in testpaper.questions"
                        :key="index"
                        :numberQ = "index"
                        :question="question"
                        :remove="deleteQuestionForm"
                        :removeD="deleteDistractor"
                        :addD = "addDistractor"
                        >
                        </newquestion>    
                    </div>
                    <div style="text-align: right">
                        <label for="" class="control-label">Total marks: &nbsp;</label>
                        <span  class="bold color">{{totalMark}}</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        class="btn btn-danger"
                        data-dismiss = "modal"
                    >Cancel</button>
                    <button
                        class="btn btn-primary"
                        type="submit"
                        @click="createTestPaper"
                    >Save</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import newquestion from "../others/NewQuestion.vue";

export default {
  computed: {
    totalMark: function() {
      var total = 0;
      this.testpaper.questions.forEach(question => {
        total = total + question.over_mark;
      });
      return total;
    }
  },
  data: function() {
    return {
      testpaper: {
        course_id: "",
        title: "",
        start_time: "2019-07-31T08:00",
        duration: "01:30:00",
        over_mark: "",
        questions: [this.generateQuestion(), this.generateQuestion()]
      }
    };
  },
  methods: {
    addDistractor: function(indexQ) {
      this.testpaper.questions[indexQ].distractors.push({
        index: "",
        text: ""
      });
    },
    addQuestion: function() {
      this.testpaper.questions.push(this.generateQuestion());
    },
    createTestPaper: function(testpaper) {
      this.testpaper.over_mark = this.totalMark;
      var params = Object.assign({}, this.testpaper);
      axios
        .post("api/testpaper", params)
        .then(res => {
          console.log(res.data);
        })
        .catch(error => console.log(error));
      //   $("#testpapermodal").modal("hide");
    },
    deleteQuestionForm: function(index) {
      this.testpaper.questions.splice(index, 1);
    },
    deleteDistractor: function(indexQ, indexD) {
      console.log(
        this.testpaper.questions[indexQ].distractors.splice(indexD, 1)
      );
    },
    generateQuestion() {
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
    }
  },
  components: {
    newquestion
  },
  props: ["courses"]
};
</script>
