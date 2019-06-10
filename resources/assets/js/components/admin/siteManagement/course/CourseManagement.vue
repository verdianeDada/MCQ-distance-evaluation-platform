<template>
  <div>
     <div class="row" style="margin-top: 20px;" >
        <button 
          class="btn btn-primary"
          data-toggle = "modal"
          data-target = "#updatemodal"
          @click="clean"
          style="font-size: 18px;" 
        >
          Create a Course
        </button>
        <h1 class="color bold  well carousel-search hidden-phone collapse in" data-toggle="collapse" data-target="#common"  aria-expanded="true" style="margin: 40px 0; font-size: 30px">
          <i class="fa fa-book color"> 
            </i>&nbsp;&nbsp;Common courses<div class="expand_caret caret"></div>
        </h1>
        <div id="common" class="collapse in">
          <coursetable
            class="test-paper"                
            :deleteCourse="deleteCourse"
            :setUpdate="setUpdate"
            :courses="courses.common"
          ></coursetable>
        </div>
     </div>
     <div class="row" >
        <h1 class="color bold  well carousel-search hidden-phone collapse in" data-toggle="collapse" data-target="#ict"  aria-expanded="true" style="margin: 40px 0; font-size: 30px">
          <i class="fa fa-book color"> 
            </i>&nbsp;&nbsp;Information & Communication Technology's courses<div class="expand_caret caret"></div>
        </h1>
        <div id="ict" class="collapse in">
          <coursetable
            class="test-paper"                
            :deleteCourse="deleteCourse"
            :setUpdate="setUpdate"
            :courses="courses.ict"
          ></coursetable>
        </div>
     </div>
     <div class="row" >
        <h1 class="color bold  well carousel-search hidden-phone collapse in" data-toggle="collapse" data-target="#fcs"  aria-expanded="true" style="margin: 40px 0; font-size: 30px">
          <i class="fa fa-book color-black"> 
            </i>&nbsp;&nbsp;Fundamental Computer Science'S courses<div class="expand_caret caret"></div>
        </h1>
        <div id="fcs" class="collapse in">
          <coursetable
            class="test-paper"                
            :deleteCourse="deleteCourse"
            :setUpdate="setUpdate"
            :courses="courses.fcs"
          ></coursetable>
        </div>
     </div>
        <!-- <coursetable
            class="test-paper"                
            :courses="courses"
            :setModal="setDelete"
            :block="block"
            :putAdmin="putAdmin"
            :setUpdate="setUpdate"
            :isTeacher="true"
        ></coursetable> -->

      
      <div class="fade modal" id = "updatemodal" role="dialog">
        <updatemodal
          :update = "update"
          :course = "course"
          :edit = "edit"
          :create = "create"
          :teachers="teachers"
          :error="error"
        ></updatemodal>
      </div>
  </div>
</template>

<script>
// import deleteusermodal from "../../../modals/DeleteUser";
import updatemodal from "../../../modals/Course.vue";
import coursetable from "./CourseTable.vue";

export default {
  data: function() {
    return {
      courses: {
        ict: [],
        fcs: [],
        common: []
      },
      course: {
        id: "",
        title: "",
        code: "",
        isCommon: 0,
        option: 0,
        credit: "",
        year: "",
        user_id: ""
      },
      teachers: [],
      edit: false,
      previous_course: {},
      error: ""
    };
  },
  mounted: function() {
    this.loadpage();
  },
  methods: {
    clean: function() {
      this.course = {};
      this.error = "";
    },
    loadpage: function() {
      axios
        .get("api/all_course")
        .then(res => {
          if (res.data.courses) {
            res.data.courses.forEach(course => {
              let year = "year" + course.year;
              let option;
              if (course.isCommon) option = "common";
              else {
                if (course.option) option = "ict";
                else option = "fcs";
              }
              this.courses[option].push(course);
            });
          }
          this.teachers = res.data.teachers;
        })
        .then(err => console.log(err));
    },
    deleteCourse: function(course) {
      axios
        .delete("api/course/" + course.id)
        .then(res => {
          var option;
          if (course.isCommon == 1) option = "common";
          else {
            if (course.option == 1) option = "ict";
            else option = "fcs";
          }
          this.courses[option].forEach(temp => {
            if (temp.id === course.id) {
              var index = this.courses[option]
                .map(function(temp) {
                  return temp;
                })
                .indexOf(temp);
              this.courses[option].splice(index, 1);
            }
          });
        })
        .catch(error => console.log(error));
    },

    create: function() {
      if (
        $("#course-form")
          .parsley()
          .isValid()
      ) {
        this.error = "";
        let params = Object.assign({}, this.course);
        if (params.isCommon == null) params.isCommon = 1;
        axios
          .post("api/course", params)
          .then(res => {
            if (res.data.error) this.error = res.data.error;
            else {
              $("#updatemodal").modal("hide");

              // push new course

              var option;
              if (res.data.isCommon == 1) option = "common";
              else {
                if (res.data.option == 1) option = "ict";
                else option = "fcs";
              }
              this.teachers.forEach(temp => {
                if (temp.id === res.data.user_id) {
                  res.data.user = temp;
                  return;
                }
              });
              this.courses[option].push(res.data);
              this.courses[option].sort((a, b) => (a.code > b.code ? 1 : -1));
            }
          })
          .catch(error => {
            console.log("an error ocurred" + error);
          });
      }
    },
    update: function() {
      if (
        $("#course-form")
          .parsley()
          .isValid()
      ) {
        let params = Object.assign({}, this.course);

        axios
          .patch("api/course", params)
          .then(res => {
            if (res.data.error) this.error = res.data.error;
            else {
              $("#updatemodal").modal("hide");
              this.error = "";
              // delete previous course
              var option;
              if (this.previous_course.isCommon == 1) option = "common";
              else {
                if (this.previous_course.option == 1) option = "ict";
                else option = "fcs";
              }
              this.courses[option].forEach(temp => {
                if (temp.id === this.previous_course.id) {
                  var index = this.courses[option]
                    .map(function(temp) {
                      return temp;
                    })
                    .indexOf(temp);
                  this.courses[option].splice(index, 1);
                }
              });
              // put teacher
              this.teachers.forEach(temp => {
                if (temp.id === this.course.user_id) {
                  this.course.user = temp;
                  return;
                }
              });

              // push new course
              if (this.course.isCommon == 1) option = "common";
              else {
                if (this.course.option == 1) option = "ict";
                else option = "fcs";
              }
              this.courses[option].push(this.course);
              this.courses[option].sort((a, b) => (a.code > b.code ? 1 : -1));
              this.edit = false;
            }
          })
          .catch(error => {
            console.log("an error ocurred" + error);
          });
      }
    },
    setUpdate: function(course) {
      if (course.isCommon) course.option = 0;
      this.course = course;
      this.previous_course = Object.assign({}, course);
      this.edit = true;
      this.error = "";
    },
    putAdmin: function(teacher) {
      axios
        .get("api/user/put_admin/" + teacher.id)
        .then(res => {
          this.teachers.forEach(temp => {
            if (temp.id === teacher.id) {
              var index = this.teachers
                .map(function(temp) {
                  return temp;
                })
                .indexOf(temp);
              this.teachers[index].isAdmin = !this.teachers[index].isAdmin;
            }
          });
        })
        .catch(error => console.log(error));
    }
  },

  components: {
    coursetable,
    updatemodal
  },

  props: []
};
</script>
