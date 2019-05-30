<template>
  <div>
      <!-- ict students -->
    <!-- cpurse repeating -->

      <div class="row" >
        <h1 class="color bold center" style="margin: 40px 0; font-size: 30px"><i class="fa fa-desktop"></i>&nbsp;&nbsp;Information and Communication Technology</h1>
        <div>
            <h3 class="bold center" style="margin-top: 40px;">ICT Year 1</h3>
            <studenttable
                class="test-paper"                
                :students="students.ict.year1"
                :setModal="setDelete"
                :block="block"
                :setUpdate="setUpdate"
            ></studenttable>
        </div>
        <div>
            <h3 class="bold center" style="margin-top: 20px;">ICT Year 2</h3>
            <studenttable 
                class="test-paper"
                :students="students.ict.year2"
                :setModal="setDelete"
                :block="block"
                :setUpdate="setUpdate"
            ></studenttable>
        </div>
        <div>
            <h3 class="bold center" style="margin-top: 20px;">ICT Year 3</h3>
            <studenttable 
                class="test-paper"
                :students="students.ict.year3"
                :setModal="setDelete"
                :block="block"
                :setUpdate="setUpdate"
            ></studenttable>
        </div>
        <div>
            <h3 class="bold center" style="margin-top: 20px;">ICT Year 4</h3>
            <studenttable 
                class="test-paper"
                :students="students.ict.year4"
                :setModal="setDelete"
                :block="block"
                :setUpdate="setUpdate"
            ></studenttable>
        </div>
        <div>
            <h3 class="bold center" style="margin-top: 20px;">ICT Year 5</h3>
            <studenttable 
                class="test-paper"
                :students="students.ict.year5"
                :setModal="setDelete"
                :block="block"
                :setUpdate="setUpdate"
            ></studenttable>
        </div>
      </div>

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
      actualUser: {}
    };
  },
  methods: {
    mounted: function() {
      console.log(this.students);
    },
    clean: function() {
      this.student = {};
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
        axios
          .patch("api/user/" + id, params)
          .then(res => {
            this.closeModal();
            this.findStaff();
          })
          .catch(error => {
            console.log("an error ocurred" + error);
          });
      }
    },
    setUpdate: function(student) {
      this.student = student;
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
