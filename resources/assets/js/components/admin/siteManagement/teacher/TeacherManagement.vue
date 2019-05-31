<template>
  <div>
      <!-- ict students -->

      <div class="row" >
        <h1 class="color bold center well carousel-search hidden-phone " style="margin: 40px 0; font-size: 30px">
          <i class="fa fa-user-tie color-black"> 
            </i>&nbsp;&nbsp;Computer Science Lecturers
        </h1>
        <studenttable
            class="test-paper"                
            :users="teachers"
            :setModal="setDelete"
            :block="block"
            :putAdmin="putAdmin"
            :setUpdate="setUpdate"
            :isTeacher="true"
        ></studenttable>
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
          :user = "student"
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
import updatemodal from "../../../modals/User";
// import studentmodal from "../modals/Student.vue";
import studenttable from "../UserTable.vue";

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
    update: function(id) {
      if (
        $("#user-form")
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
              let stud = res.data;
              $("#updatemodal").modal("hide");

              // delete previous user
              console.log(params.year);
              this.students[option][year].forEach(temp => {
                if (temp.id === stud.id) {
                  var index = this.students[option][year]
                    .map(function(temp) {
                      return temp;
                    })
                    .indexOf(temp);
                  this.students[option][year][index] = temp;
                }
              });

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
