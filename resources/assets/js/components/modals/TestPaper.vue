<template>
    <div class="modal-dialog modal-lg">
        <form 
            method="post" 
            @submit.prevent
            data-parsley-validate 
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
                                <select id="course" v-model = "testpaper.course_id" class="form-control" required>
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
                                <input type="text" id="title" class="form-control" placeholder="Test title" autofocus required>
                            </div>
                            <div class="form-group col-lg-3 col-md-3">
                                <label for="date" class="control-label">Starting Date & Time</label>
                                <input type="datetime-local" class="form-control" id="date" v-model="testpaper.start_time">
                            </div>
                        
                            <div class="form-group col-lg-3 col-md-3">
                                <label for="end" class="control-label">Duration</label>
                                <input type="time" id="end" class="form-control" min="01:00:00" max="01:30:00" v-model="testpaper.duration">
                            </div>                        
                        </div>
                        <div class="row margin-0">
                            <div class="form-group">
                                <label for="number" class="control-label col-md-1 col-lg-1 padding-0">N°of questions</label>
                                <div class="col-md-1 col-lg-1">
                                    <input type="number" id="number" min="1"  class="form-control " 
                                    v-model="question_num"
                                    >
                                </div>                            
                            </div>
                        </div> 
                    </div>     
                    <!-- a question  -->
                    <div>
                        <newquestion 
                        v-for="n in question_num"
                        :key="n"
                        :numberQ = "n"
                        >
                        </newquestion>    
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
  data: function() {
    return {
      question_num: 2,
      testpaper: {
        course_id: "",
        title: "",
        start_time: "2019-07-31T08:00",
        duration: "01:30",
        questions: [
          {
            number: "",
            text: "",
            over_mark: "",
            distractors: [
              {
                text: "",
                is_correct: ""
              }
            ]
          }
        ]
      }
    };
  },
  methods: {
    createTestPaper: function() {
      console.log(this.testpaper.duration);
      //   $("#testpapermodal").modal("hide");
    }
  },
  components: {
    newquestion
  },
  props: ["courses"]
};
</script>
