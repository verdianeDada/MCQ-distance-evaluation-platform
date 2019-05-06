<template>
  <div class="row">
    <sidebar
      class="col-md-3 sidebar"
      :courses = "courses"
      :repeatingCourses = "repeatingCourses"
    ></sidebar>
    <div class="col-md-9" style="padding:35px">
      <div class="row" style="margin-top: 20px;">
        <!-- exam
        
        
        
        
        
         -->
        <testpapers 
          class="test-paper"
          :testpapers ="testpapers"
          :repeatingTestpapers ="repeatingTestpapers"
        ></testpapers>
      </div>
    </div>

 
    </div>
</template>

<script>
import sidebar from "./Sidebar.vue";
import testpapers from "./Testpapers.vue";

export default {
  mounted() {
    this.loadpage();
    console.log(new Date)
  },
  data: function() {
    return {
      courses: [],
      repeatingCourses: [],
      testpapers: [],
      repeatingTestpapers: [],

    };
  },
  methods: {
    loadpage: function() {
      axios
        .get("api/studentdashboard/")
        .then(res => {
          this.courses = res.data.courses;
          this.repeatingCourses = res.data.repeatingCourses;
          this.testpapers = res.data.testpapers;
          this.repeatingTestpapers = res.data.repeatingTestpapers;
          this.repeatingTestpapers.sort(function compare(a, b) {
            var dateA = new Date(a.date);
            var dateB = new Date(b.date);
            return new Date(b.updated_at) - new Date(a.updated_at);
          });
        })
        .catch(error => {
          console.log(error);
        });
    }
  },

  components: {
    sidebar,
    testpapers
  },

  props: ["userid", "username", "usersex"]
};
</script>
