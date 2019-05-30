<template>
  <div>
      <!-- ict students -->
    <!-- cpurse repeating -->

      <div class="row" >
        <h1 class="color bold center" style="margin: 40px 0; font-size: 30px"><i class="fa fa-desktop"></i>&nbsp;&nbsp;Information and Communication Technology</h1>
        <div v-if="students.ict.year1[0]">
            <h3 class="bold center" style="margin-top: 40px;">ICT Year 1</h3>
            <studenttable 
                class="test-paper"
                :students="students.ict.year1"
            ></studenttable>
        </div>
        <div v-if="students.ict.year2[0]">
            <h3 class="bold center" style="margin-top: 20px;">ICT Year 2</h3>
            <studenttable 
                class="test-paper"
                :students="students.ict.year2"
            ></studenttable>
        </div>
        <div v-if="students.ict.year3[0]">
            <h3 class="bold center" style="margin-top: 20px;">ICT Year 3</h3>
            <studenttable 
                class="test-paper"
                :students="students.ict.year3"
            ></studenttable>
        </div>
        <div v-if="students.ict.year4[0]">
            <h3 class="bold center" style="margin-top: 20px;">ICT Year 4</h3>
            <studenttable 
                class="test-paper"
                :students="students.ict.year4"
            ></studenttable>
        </div>
        <div v-if="students.ict.year5[0]">
            <h3 class="bold center" style="margin-top: 20px;">ICT Year 5</h3>
            <studenttable 
                class="test-paper"
                :students="students.ict.year5"
            ></studenttable>
        </div>
        
        
        
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
// import studentmodal from "../modals/Student.vue";
import studenttable from "./StudentTable.vue";

export default {
  data: function() {
    return {
      edit: false,
      student: {
        title: "",
        isCommon: false,
        code: "",
        option: "",
        year: "",
        credit: "",
        user_id: ""
      }
    };
  },
  methods: {
    mounted: function() {
      console.log(this.students);
    },
    clean: function() {
      this.student = {};
    },
    createTestPaper: function() {
      // if (
      //   $("#test-paper-form")
      //     .parsley()
      //     .isValid()
      // ) {
      //   var params = Object.assign({}, this.course);
      //   axios
      //     .post("api/course", params)
      //     .then(res => {})
      //     .catch(error => console.log(error));
      // }
    }
    // deleteTestPaper: function(id) {
    //   axios
    //     .delete("api/testpaper/" + id)
    //     .then(res => {
    //       $("#deletetest").modal("hide");
    //     })
    //     .catch(error => console.log(error));
    // },

    // loadpage: function() {
    //   axios
    //     .get("api/teacherdashboard/")
    //     .then(res => {
    //       if (res.data.courses) this.courses = res.data.courses;
    //       if (res.data.courses) this.mycourses = res.data.courses;
    //     })
    //     .catch(error => {
    //       console.log(error);
    //     });
    // },
    // updateTestPaper: function() {
    //   if (
    //     $("#test-paper-form")
    //       .parsley()
    //       .isValid()
    //   ) {
    //     var params = Object.assign({}, this.testpaper);
    //     axios
    //       .patch("api/testpaper", params)
    //       .then(res => {})
    //       .catch(error => console.log(error));
    //   }
    // },
    // setModal: function(id) {
    //   this.edit = true;
    //   axios
    //     .get("api/set_update_testpaper/" + id)
    //     .then(res => {
    //       console.log(res.data);
    //       this.testpaper = res.data;
    //     })
    //     .catch(error => console.log(error));
    // }
  },

  components: {
    studenttable
  },

  props: ["students"]
};
</script>
