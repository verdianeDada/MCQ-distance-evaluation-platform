<template>
  <div>
<!-- <a data-toggle="collapse" data-target="#collapseExampleArea" href="#collapseExampleArea" aria-expanded="false">
  Click to toggle collapse status of section below
  <div class="expand_caret caret"></div>
</a>
<div id="collapseExampleArea" class="collapse in">
  <p>Content inside the collapse area</p>
</div> -->
      <!-- ict students -->

      <div class="row" >
        <h1 class="color bold center well carousel-search hidden-phone collapse in" data-toggle="collapse" data-target="#ict"  aria-expanded="true" style="margin: 40px 0; font-size: 30px">
          <i class="fa fa-desktop color-black"> 
            </i>&nbsp;&nbsp;Information and Communication Technology<div class="expand_caret caret"></div>
        </h1>
        <div id="ict" class="collapse in">
          <h3 class="bold center color-black collapse in" data-toggle="collapse" data-target="#ict1"  aria-expanded="true" style="margin-top: 40px;">ICT Year 1&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>
          <div id="ict1" class="collapse in">
              <studenttable
                  class="test-paper"                
                  :students="students.ict.year1"
                  :setModal="setDelete"
                  :block="block"
                  :putAdmin="putAdmin"
                  :setUpdate="setUpdate"
              ></studenttable>
          </div>
          <h3 class="bold center color-black collapse in" data-toggle="collapse" data-target="#ict2"  aria-expanded="true" style="margin-top: 40px;">ICT Year 2&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>
          <div class="collapse in" id="ict2">
              <studenttable 
                  class="test-paper"
                  :students="students.ict.year2"
                  :setModal="setDelete"
                  :block="block"
                  :putAdmin="putAdmin"
                  :setUpdate="setUpdate"
              ></studenttable>
          </div>
          <h3 class="bold center color-black collapse in" data-toggle="collapse" data-target="#ict3"  aria-expanded="true" style="margin-top: 40px;">ICT Year 3&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>          
          <div class="collapse in" id="ict3">
              <studenttable 
                  class="test-paper"
                  :students="students.ict.year3"
                  :setModal="setDelete"
                  :block="block"
                  :putAdmin="putAdmin"
                  :setUpdate="setUpdate"
              ></studenttable>
          </div>
          <h3 class="bold center color-black collapse in" data-toggle="collapse" data-target="#ict4"  aria-expanded="true" style="margin-top: 40px;">ICT Year 4&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>          
          <div class="collapse in" id="ict4">
              <studenttable 
                  class="test-paper"
                  :students="students.ict.year4"
                  :setModal="setDelete"
                  :block="block"
                  :putAdmin="putAdmin"
                  :setUpdate="setUpdate"
              ></studenttable>
          </div>
          <h3 class="bold center color-black collapse in" data-toggle="collapse" data-target="#ict5"  aria-expanded="true" style="margin-top: 40px;">ICT Year 5&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>          
          <div class="collapse in" id="ict5">
              <studenttable 
                  class="test-paper"
                  :students="students.ict.year5"
                  :setModal="setDelete"
                  :block="block"
                  :putAdmin="putAdmin"
                  :setUpdate="setUpdate"
              ></studenttable>
          </div>
        </div>
      </div>
      <!-- end ICT -->

      <!-- FCS students -->
      <div class="row" >
        <h1 class="color bold center well carousel-search hidden-phone collapse in" data-toggle="collapse" data-target="#fcs"  aria-expanded="true" style="margin: 40px 0; font-size: 30px">
          <i class="fa fa-desktop color-black"> 
            </i>&nbsp;&nbsp;Fundamental Computer Science<div class="expand_caret caret"></div>
        </h1>
        <div id="fcs" class="collapse in">
          <h3 class="bold center color-black collapse in" data-toggle="collapse" data-target="#fcs1"  aria-expanded="true" style="margin-top: 40px;">FCS Year 1&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>          
          <div class="collapse in" id="fcs1">
              <studenttable
                  class="test-paper"                
                  :students="students.fcs.year1"
                  :setModal="setDelete"
                  :block="block"
                  :putAdmin="putAdmin"
                  :setUpdate="setUpdate"
              ></studenttable>
          </div>
          <h3 class="bold center color-black collapse in" data-toggle="collapse" data-target="#fcs2"  aria-expanded="true" style="margin-top: 40px;">FCS Year 2&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>          
          <div class="collapse in" id="fcs2">
              <studenttable 
                  class="test-paper"
                  :students="students.fcs.year2"
                  :setModal="setDelete"
                  :block="block"
                  :putAdmin="putAdmin"
                  :setUpdate="setUpdate"
              ></studenttable>
          </div>
          <h3 class="bold center color-black collapse in" data-toggle="collapse" data-target="#fcs3"  aria-expanded="true" style="margin-top: 40px;">FCS Year 3&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>          
          <div class="collapse in" id="fcs3">
              <studenttable 
                  class="test-paper"
                  :students="students.fcs.year3"
                  :setModal="setDelete"
                  :block="block"
                  :putAdmin="putAdmin"
                  :setUpdate="setUpdate"
              ></studenttable>
          </div>
          <h3 class="bold center color-black collapse in" data-toggle="collapse" data-target="#fcs4"  aria-expanded="true" style="margin-top: 40px;">FCS Year 4&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>          
          <div class="collapse in" id="fcs4">
              <studenttable 
                  class="test-paper"
                  :students="students.fcs.year4"
                  :setModal="setDelete"
                  :block="block"
                  :putAdmin="putAdmin"
                  :setUpdate="setUpdate"
              ></studenttable>
          </div>
          <h3 class="bold center color-black collapse in" data-toggle="collapse" data-target="#fcs5"  aria-expanded="true" style="margin-top: 40px;">FCS Year 5&nbsp;&nbsp;<div class="expand_caret caret"></div></h3>          
          <div class="collapse in" id="fcs5">
              <studenttable 
                  class="test-paper"
                  :students="students.fcs.year5"
                  :setModal="setDelete"
                  :block="block"
                  :putAdmin="putAdmin"
                  :setUpdate="setUpdate"
              ></studenttable>
          </div>
        </div>
      </div>
      <!-- end FCS -->

      <div class="fade modal" id = "deleteuser" role="dialog">
        <deleteusermodal
          :deleteUser = "deleteUser"
        ></deleteusermodal>
      </div>
      <div class="fade modal" id = "updatemodal" role="dialog">
        <updatemodal
          :update = "update"
          :student = "student"
          :cleanModal = "clean"
          :error="error"
        ></updatemodal>
      </div>
     
    <!-- modal to create a new course -->
    <!-- <div class="modal fade" 
      id="studentmodal"
      role="dialog"
    >
      <studentmodal
        :course = "course"
      ></studentmodal>
    </div> -->
    
  </div>
</template>

<script>
import deleteusermodal from "../../../modals/DeleteUser";
import updatemodal from "../../../modals/Student";
// import studentmodal from "../modals/Student.vue";
import studenttable from "./StudentTable.vue";

export default {
  data: function() {
    return {
      student: {
        name: "",
        phone: "",
        password: "",
        option: "",
        matricule: "",
        year: ""
      },
      actualUser: {},
      error: ""
    };
  },
  methods: {
    mounted: function() {
      console.log(this.students);
    },
    clean: function() {
      this.student = {};
    },
    dropdown: function(option, year) {
      this.show[option][year] = !this.show[option][year];
    },
    setDelete: function(student) {
      this.actualUser = student;
    },
    deleteUser: function() {
      axios
        .delete("api/user/" + this.actualUser.id)
        .then(res => {
          var option, year;
          // get student  option
          if (this.actualUser.option) option = "ict";
          else option = "fcs";
          // get student  option
          if (this.actualUser.year === 1) year = "year1";
          else if (this.actualUser.year === 2) year = "year2";
          else if (this.actualUser.year === 3) year = "year3";
          else if (this.actualUser.year === 4) year = "year4";
          else year = "year5";
          this.students[option][year].forEach(stu => {
            if (stu.id === this.actualUser.id) {
              var index = this.students[option][year]
                .map(function(stu) {
                  return stu;
                })
                .indexOf(stu);
              this.students[option][year].splice(index, 1);
            }
          });
        })
        .catch(error => console.log(error));
    },
    block: function(stud) {
      axios
        .get("api/user/block/" + stud.id)
        .then(res => {
          var option, year;
          // get student  option
          if (stud.option) option = "ict";
          else option = "fcs";
          // get student  option
          if (stud.year === 1) year = "year1";
          else if (stud.year === 2) year = "year2";
          else if (stud.year === 3) year = "year3";
          else if (stud.year === 4) year = "year4";
          else year = "year5";
          this.students[option][year].forEach(stu => {
            if (stu.id === stud.id) {
              var index = this.students[option][year]
                .map(function(stu) {
                  return stu;
                })
                .indexOf(stu);
              this.students[option][year][index].isAllowed = !this.students[
                option
              ][year][index].isAllowed;
            }
          });
        })
        .catch(error => console.log(error));
    },
    update: function(id, params) {
      if (
        $("#student-form")
          .parsley()
          .isValid()
      ) {
        let params = Object.assign({}, this.student);
        axios
          .patch("api/user", params)
          .then(res => {
            console.log(res.data);
            if (res.data.error) {
              this.error = res.data.error;
            } else {
              this.error = "";
              let stu = res.data;
              $("#updatemodal").modal("hide");
              var option, year;
              // get student  option
              if (stud.option) option = "ict";
              else option = "fcs";
              // get student  option
              if (stud.year === 1) year = "year1";
              else if (stud.year === 2) year = "year2";
              else if (stud.year === 3) year = "year3";
              else if (stud.year === 4) year = "year4";
              else year = "year5";
              this.students[option][year].forEach(stu => {
                if (stu.id === stud.id) {
                  var index = this.students[option][year]
                    .map(function(stu) {
                      return stu;
                    })
                    .indexOf(stu);
                  this.students[option][year][index] = stu;
                }
              });
            }
          })
          .catch(error => {
            console.log("an error ocurred" + error);
          });
      }
    },
    setUpdate: function(student) {
      this.student = student;
    },
    putAdmin: function(stud) {
      axios
        .get("api/user/put_admin/" + stud.id)
        .then(res => {
          var option, year;
          // get student  option
          if (stud.option) option = "ict";
          else option = "fcs";
          // get student  option
          if (stud.year === 1) year = "year1";
          else if (stud.year === 2) year = "year2";
          else if (stud.year === 3) year = "year3";
          else if (stud.year === 4) year = "year4";
          else year = "year5";
          this.students[option][year].forEach(stu => {
            if (stu.id === stud.id) {
              var index = this.students[option][year]
                .map(function(stu) {
                  return stu;
                })
                .indexOf(stu);
              this.students[option][year][index].isAdmin = !this.students[
                option
              ][year][index].isAdmin;
            }
          });
        })
        .catch(error => console.log(error));
    }
  },

  components: {
    studenttable,
    deleteusermodal,
    updatemodal
  },

  props: ["students"]
};
</script>
