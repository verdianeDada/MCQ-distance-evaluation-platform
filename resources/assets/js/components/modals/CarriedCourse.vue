<template>
    <div class="modal-dialog">
        <form data-parsley-validate @submit.prevent id="carried-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close color-alarm" data-dismiss="modal">&times;</button>
                    <h1 class="bold color">Carried course</h1>
                </div>
                <div class="modal-body">
                    <div class="row margin-0" style="padding: 16px" v-if="error">
                        <span class="color-alarm bold">{{error}}</span>
                    </div>                
                    
                    <div class="row form-group">
                        <div class="col-lg-6 padding-0">
                            <label for="option" class="control-label">Option:</label>
                            <select id="option"  class="form-control" required
                                @change="filtering" v-model.number="carryCourse.option"
                            >                               
                                <option value="1">FCS & ICT</option>
                                <option value="2">ICT</option>
                                <option value="3">FCS</option>
                            </select> 
                        </div>
                        <div class="col-lg-6 padding-0">
                            <label for="level" class="control-label">Level:</label>
                            <select id="level" class="form-control" required 
                                @change="filtering" v-model.number="carryCourse.level"
                            >                               
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="4">4</option>
                            </select> 
                        </div>
                        
                    </div>
                    <div class="row form-group">
                        <label for="student" class="control-label">Choose a student:</label>
                        <select id="student" class="form-control" required v-model="carryCourse.student">                               
                            <option
                                class="capitalize"
                                style="font-size: 16px"
                                v-for="student in filteredd.students"
                                :key="student.id" 
                                :value="student"
                            >{{student.matricule}}&nbsp;&nbsp;:&nbsp;&nbsp;{{student.name}}</option>
                        </select> 
                    </div>
                    <div class="row form-group">
                        <label for="course" class="control-label">Choose a course:</label>
                        <select id="course" class="form-control" required v-model="carryCourse.course">                               
                            <option
                                class="capitalize"
                                style="font-size: 16px"
                                v-for="course in filteredd.courses"
                                :key="course.id" 
                                :value="course"
                            >{{course.code}}&nbsp;&nbsp;:&nbsp;&nbsp;{{course.title}}</option>
                        </select> 
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
                        @click="create"
                    >Save</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
  data: function() {
    return {
      filteredd: {
        students: [],
        courses: []
      }
    };
  },
  methods: {
    filtering: function() {
      this.error = "";
      this.filteredd.students = [];
      this.filteredd.courses = [];
      var level = this.carryCourse.level;
      var option = this.carryCourse.option;
      //if it is common course
      if (option === 1) {
        this.students.forEach(stud => {
          if (stud.year === level + 1) {
            this.filteredd.students.push(stud);
          }
        });
        this.courses.forEach(cour => {
          if (cour.year === level && cour.isCommon) {
            this.filteredd.courses.push(cour);
          }
        });
      } else if (option === 2) {
        this.students.forEach(stud => {
          if (stud.year === level + 1 && stud.option === 1) {
            this.filteredd.students.push(stud);
          }
        });
        this.courses.forEach(cour => {
          if (cour.year === level && cour.option) {
            this.filteredd.courses.push(cour);
          }
        });
      } else {
        this.students.forEach(stud => {
          if (stud.year === level + 1 && stud.option === 0) {
            this.filteredd.students.push(stud);
          }
        });
        this.courses.forEach(cour => {
          if (cour.year === level && !cour.option) {
            this.filteredd.courses.push(cour);
          }
        });
      }
    }
  },
  props: ["courses", "error", "students", "carryCourse", "create"]
};
</script>
