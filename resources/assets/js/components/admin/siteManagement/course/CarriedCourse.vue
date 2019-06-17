<template>
  <div>
    <div class="row" style="margin-top: 20px;" >
        <button 
          class="btn btn-primary"
          data-toggle = "modal"
          data-target = "#carriedmodal"
          @click="setModal"
          style="font-size: 18px;" 
        >Attribute a carried course
        </button>

        <h1 class="color bold  well carousel-search hidden-phone collapse in" data-toggle="collapse" data-target="#fcs"  aria-expanded="true" style="margin: 40px 0; font-size: 30px">
          <i class="fa fa-book  color-black"> 
            </i>&nbsp;&nbsp;Information & Communication Technology<div class="expand_caret caret"></div>
        </h1>
        <div id="ict" class="collapse in">
          <div v-if="carryingStudents.ict.year1[0]" >
            <h3 class="bold  color-black collapse in" data-toggle="collapse" data-target="#ict1"  aria-expanded="true" style="margin-top: 40px;">Ict Year 1&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>
            <div id="ict1" class="collapse in">
                <carriedtable 
                  :delete="deleteC"
                  :students="carryingStudents.ict.year1"
                ></carriedtable>
            </div>
          </div>
          <div v-if="carryingStudents.ict.year2[0]" >
              <h3 class="bold  color-black collapse in" data-toggle="collapse" data-target="#ict2"  aria-expanded="true" style="margin-top: 40px;">Ict Year 2&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>
              <div class="collapse in" id="ict2">
                <carriedtable 
                  :delete="deleteC"
                  :students="carryingStudents.ict.year2"
                ></carriedtable>
              </div>
          </div>
          <div v-if="carryingStudents.ict.year4[0]">
              <h3 class="bold  color-black collapse in" data-toggle="collapse" data-target="#ict4"  aria-expanded="true" style="margin-top: 40px;">Ict Year 4&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>          
              <div class="collapse in" id="ict4">
                <carriedtable 
                  :delete="deleteC"
                  :students="carryingStudents.ict.year4"
                ></carriedtable>
              </div>
          </div>
        </div>
        <h1 class="color bold  well carousel-search hidden-phone collapse in" data-toggle="collapse" data-target="#fcs"  aria-expanded="true" style="margin: 40px 0; font-size: 30px">
          <i class="fa fa-book  color-black"> 
            </i>&nbsp;&nbsp;Fundamental Computer Science<div class="expand_caret caret"></div>
        </h1>
        <div id="fcs" class="collapse in">
          <div v-if="carryingStudents.fcs.year1[0]" >
            <h3 class="bold  color-black collapse in" data-toggle="collapse" data-target="#fcs1"  aria-expanded="true" style="margin-top: 40px;">FCS Year 1&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>
            <div id="fcs1" class="collapse in">
                <carriedtable 
                  :delete="deleteC"
                  :students="carryingStudents.fcs.year1"
                ></carriedtable>
            </div>
          </div>
          <div v-if="carryingStudents.fcs.year2[0]" >
              <h3 class="bold  color-black collapse in" data-toggle="collapse" data-target="#fcs2"  aria-expanded="true" style="margin-top: 40px;">FCS Year 2&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>
              <div class="collapse in" id="fcs2">
                <carriedtable 
                  :delete="deleteC"
                  :students="carryingStudents.fcs.year2"
                ></carriedtable>
              </div>
          </div>
          <div v-if="carryingStudents.fcs.year4[0]">
              <h3 class="bold  color-black collapse in" data-toggle="collapse" data-target="#fcs4"  aria-expanded="true" style="margin-top: 40px;">FCS Year 4&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>          
              <div class="collapse in" id="fcs4">
                <carriedtable 
                  :delete="deleteC"
                  :students="carryingStudents.fcs.year4"
                ></carriedtable>
              </div>
          </div>
        </div>

    </div>
    <div class="fade modal" id = "carriedmodal" role="dialog">
      <carriedmodal
        :courses="courses"
        :students="students"
        :error="error"
        :carryCourse="carryCourse"
        :create="create"
      ></carriedmodal>
    </div>
    
  </div> 
</template>

<script>
import carriedtable from "./CarriedCourseTable.vue";
import carriedmodal from "../../../modals/CarriedCourse.vue";

export default {
  data: function() {
    return {
      error: "",
      courses: [],
      students: [],
      carryCourse: {
        level: 1,
        option: "",
        course: {},
        student: {}
      },
      carryingStudents: {
        fcs: {
          year1: [],
          year2: [],
          year4: []
        },
        ict: {
          year1: [],
          year2: [],
          year4: []
        }
      }
    };
  },
  mounted: function() {
    this.loadpage();
  },
  methods: {
    create: function() {
      if (
        $("#carried-form")
          .parsley()
          .isValid()
      ) {
        var params = Object.assign({}, this.carryCourse);
        axios
          .post("api/carried", params)
          .then(res => {
            if (res.data.error) this.error = res.data.error;
            else {
              this.error = "";
              $("#carriedmodal").modal("hide");
              this.carryCourse = {
                level: 1,
                option: "",
                course: {},
                student: {}
              };
              this.loadpage();
              // var option,
              //   year,
              //   found = false;
              // if (params.student.option === 1) option = "ict";
              // else option = "fcs";
              // year = "year" + (params.student.year - 1);

              // this.carryingStudents[option][year].forEach(stu => {
              //   if (stu.id === params.student.id) {
              //     var index = this.carryingStudents[option][year]
              //       .map(function(stu) {
              //         return stu;
              //       })
              //       .indexOf(stu);
              //     this.carryingStudents[option][year][
              //       index
              //     ].user_course_repeat.push(params.course);
              //     this.carryingStudents[option][year][index]
              //       .user_course_repeat_count++;
              //     this.carryingStudents[option][year][
              //       index
              //     ].user_course_repeat.sort(
              //       (a, b) => (a.code > b.code ? 1 : -1)
              //     );
              //     found = true;
              //   }
              // });
              // if (!found) {
              //   var student = params.student;
              //   student.user_course_repeat = [];
              //   student.user_course_repeat.push(params.course);
              //   student.user_course_repeat_count = 1;
              //   this.carryingStudents[option][year].push(student);
              //   this.carryingStudents[option][year].sort(
              //     (a, b) => (a.matricule > b.matricule ? 1 : -1)
              //   );
              // }
            }
          })
          .catch(err => console.log(err));
      }
    },
    loadpage: function() {
      axios
        .get("api/carried")
        .then(res => {
          this.carryingStudents = {
            fcs: {
              year1: [],
              year2: [],
              year4: []
            },
            ict: {
              year1: [],
              year2: [],
              year4: []
            }
          };
          var option, year;
          if (res.data.users.length > 0) {
            res.data.users.forEach(user => {
              if (user.user_course_repeat.length > 0) {
                if (user.option === 1) option = "ict";
                else option = "fcs";
                year = "year" + (user.year - 1);
                this.carryingStudents[option][year].push(user);
              }
            });
          }
        })
        .catch(err => console.log(err));
    },
    setModal: function() {
      axios
        .get("api/all_courses")
        .then(res => {
          if (res.data.courses.length > 0) this.courses = res.data.courses;
          if (res.data.students.length > 0) this.students = res.data.students;
        })
        .catch(error => console.log(error));
    },
    deleteC: function(sid, cid) {
      axios
        .delete("api/carried/" + sid + "/" + cid)
        .then(res => {
          this.loadpage();
        })
        .catch(error => console.log(error));
    }
  },

  components: { carriedtable, carriedmodal },

  props: [""]
};
</script>
