<template>
  <div>
     <div class="row" >
        <h1 class="color bold center well carousel-search hidden-phone collapse in" data-toggle="collapse" data-target="#common"  aria-expanded="true" style="margin: 40px 0; font-size: 30px">
          <i class="fa fa-book color-black"> 
            </i>&nbsp;&nbsp;Common courses<div class="expand_caret caret"></div>
        </h1>
        <div id="common" class="collapse in">
          <coursetable
            class="test-paper"                
            :setDelete="setDelete"
            :deleteCourse="deleteCourse"
            :setUpdate="setUpdate"
            :courses="courses.common"
          ></coursetable>
        </div>
     </div>
     <div class="row" >
        <h1 class="color bold center well carousel-search hidden-phone collapse in" data-toggle="collapse" data-target="#ict"  aria-expanded="true" style="margin: 40px 0; font-size: 30px">
          <i class="fa fa-book color-black"> 
            </i>&nbsp;&nbsp;Information & Communication Technology's courses<div class="expand_caret caret"></div>
        </h1>
        <div id="ict" class="collapse in">
          <coursetable
            class="test-paper"                
            :setDelete="setDelete"
            :deleteCourse="deleteCourse"
            :setUpdate="setUpdate"
            :courses="courses.ict"
          ></coursetable>
        </div>
     </div>
     <div class="row" >
        <h1 class="color bold center well carousel-search hidden-phone collapse in" data-toggle="collapse" data-target="#fcs"  aria-expanded="true" style="margin: 40px 0; font-size: 30px">
          <i class="fa fa-book color-black"> 
            </i>&nbsp;&nbsp;Fundamental Computer Science'S courses<div class="expand_caret caret"></div>
        </h1>
        <div id="fcs" class="collapse in">
          <coursetable
            class="test-paper"                
            :setDelete="setDelete"
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
        isCommon: "",
        option: "",
        credit: "",
        year: "",
        user_id: ""
      },
      teachers: [],
      error: ""
    };
  },
  mounted: function() {
    this.loadpage();
  },
  methods: {
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
    setDelete: function(course) {
      this.course = course;
    },
    deleteCourse: function() {
      axios
        .delete("api/course/" + this.course.id)
        .then(res => {
          // this.teachers.forEach(temp => {
          //   if (temp.id === this.actualUser.id) {
          //     var index = this.teachers
          //       .map(function(temp) {
          //         return temp;
          //       })
          //       .indexOf(temp);
          //     this.teachers.splice(index, 1);
          //   }
          // });
        })
        .catch(error => console.log(error));
    },
    block: function(teacher) {
      axios
        .get("api/user/block/" + teacher.id)
        .then(res => {
          this.teachers.forEach(temp => {
            if (temp.id === teacher.id) {
              var index = this.teachers
                .map(function(temp) {
                  return temp;
                })
                .indexOf(temp);
              this.teachers[index].isAllowed = !this.teachers[index].isAllowed;
            }
          });
        })
        .catch(error => console.log(error));
    },
    update: function(id) {
      if (
        $("#course-form")
          .parsley()
          .isValid()
      ) {
        let params = Object.assign({}, this.course);
        axios
          .patch("api/course", params)
          .then(res => {
            if (res.data.error) {
              this.error = res.data.error;
            } else {
              this.error = "";
              let teacher = res.data;
              $("#updatemodal").modal("hide");

              this.teachers.forEach(temp => {
                if (temp.id === teacher.id) {
                  var index = this.teachers
                    .map(function(temp) {
                      return temp;
                    })
                    .indexOf(temp);
                  if (teacher.sex) teacher.sex = "F";
                  else teacher.sex = "M";
                  this.teachers[index] = teacher;
                }
              });

              this.teachers.sort((a, b) => (a.name > b.name ? 1 : -1));
            }
          })
          .catch(error => {
            console.log("an error ocurred" + error);
          });
      }
    },
    setUpdate: function(course) {
      this.course = course;
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
