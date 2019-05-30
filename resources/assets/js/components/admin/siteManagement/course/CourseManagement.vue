<template>
  <div>
      <!-- <div class="row">
        <button 
          class="btn btn-primary"
          data-toggle = "modal"
          data-target = "#coursemodal"
          @click="clean"
        >
          Create a Course
        </button>
      </div>
      <div class="row" style="margin-top: 20px;">
        <courses 
          class="test-paper"
          :courses="courses"
        ></courses>
      </div>
    <div class="modal fade" 
      id="coursemodal"
      role="dialog"
    >
      <coursemodal
        :course = "course"
      ></coursemodal>
    </div> -->
  </div>
</template>

<script>
import courses from "./courses.vue";
// import coursemodal from "../modals/Course.vue";

export default {
  mounted() {
    this.loadpage();
  },
  data: function() {
    return {
      edit: false,
      course: {
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
    clean: function() {
      this.course = {};
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

  components: {},

  props: ["courses"]
};
</script>
