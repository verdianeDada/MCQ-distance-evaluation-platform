<template>
    <div class="modal-dialog modal-lg">
        <form 
            method="post" 
            @submit.prevent
            id="test-paper-form"
            data-parsley-validate
        >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close color-alarm" data-dismiss="modal" @click="clean">&times;</button>
                    <h3 class="bold color" v-if="!edit">New Test Paper</h3>
                    <h3 class="bold color" v-if="edit">Modify Test Paper</h3>
                </div>
                <div class="modal-body">               
                    <div style="margin-bottom: 30px">
                        <div class="row margin-0">
                            <div class="form-group col-lg-3" style="padding: 0 3px">
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
                                      class="capitalize"
                                    >{{course.code}}: &nbsp; {{course.title}}</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3" style="padding: 0 3px">
                                <label for="title" class="control-label">Title: </label>
                                <input type="text" id="title" class="form-control" placeholder="Test title" v-model = "testpaper.title" required>
                            </div>
                            <div class="form-group col-lg-3" style="padding: 0 3px">
                                <label for="date" class="control-label">Date of the exam</label>
                                <flatpickr
                                  v-model="testpaper.date"
                                  :config = "config.date"
                                  class="form-control"
                                  placeholder="Exam Date"
                                  required
                                ></flatpickr>
                            </div>
                        
                            <div class="form-group col-lg-3" style="padding: 0 3px">
                                <label for="end" class="control-label">Duration</label>
                                <flatpickr
                                  v-model="testpaper.duration"
                                  :config = "config.duration"
                                  class="form-control"
                                  placeholder="Test duration"
                                  required
                                ></flatpickr>
                            </div>                        
                        </div>
                        <div class="row margin-0">
                          <div class="col-lg-2">
                              <div class="form-group">
                                  <label for="number" class="control-label col-md-1 col-lg-6 padding-0">Add question</label>
                                  <div class="col-md-1 col-lg-6" style="padding: 0 8px;">
                                      <i class="fa fa-plus bold color btn" style="font-size: 20px" @click="addQuestion"></i>
                                  </div>                            
                              </div>
                          </div>
                          <div class="col-lg-9 col-lg-offset-1" v-if= "dateProblem !== ''">
                            <span class="color-alarm bold">{{dateProblem}}</span>
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
                        @click="clean"
                    >Cancel</button>
                    <button
                        class="btn btn-primary"
                        type="submit"
                        v-if="!edit"
                        @click="createTestPaper"
                    >Save</button>
                    <button
                        class="btn btn-primary"
                        type="submit"
                        v-if="edit"
                        @click="updateTestPaper"
                    >Update</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import newquestion from "../others/NewQuestion.vue";
import flatpickr from "vue-flatpickr-component";
import "vue-flatpickr-component/dist/flatpickr.css";

export default {
  computed: {
    totalMark: function() {
      var total = 0;
      if (this.testpaper.questions) {
        this.testpaper.questions.forEach(question => {
          total = total + question.over_mark;
        });
      }
      this.testpaper.over_mark = total;
      return total;
    }
  },
  data: function() {
    return {
      config: {
        date: {
          altFormat: "j F Y",
          enableTime: false,
          altInput: true,
          minDate: "today",
          weekNumbers: true
        },
        duration: {
          altFormat: "H:i",
          enableTime: true,
          noCalendar: true,
          minTime: "01:00",
          maxTime: "01:30",
          time_24hr: true
        }
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

    deleteDistractor: function(indexQ, indexD) {
      this.testpaper.questions[indexQ].distractors[indexD].index = indexD;
      this.testpaper.questions[indexQ].distractors.splice(indexD, 1);
    },
    deleteQuestionForm: function(index) {
      this.testpaper.questions[index].index = index;
      this.testpaper.questions.splice(index, 1);
    }
  },
  components: {
    newquestion,
    flatpickr
  },
  props: [
    "courses",
    "mytestpapers",
    "edit",
    "testpaper",
    "generateQuestion",
    "dateProblem",
    "createTestPaper",
    "updateTestPaper",
    "clean"
  ]
};
</script>
