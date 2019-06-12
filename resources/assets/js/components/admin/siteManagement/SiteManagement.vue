<template>
    <div>
        <!-- nav bar -->
        <div class=" row margin-0">
            <div class="col-lg-5 col-lg-offset-7">
                <ul class="nav navbar-nav" style="margin-right: 5px; float: right">
                    <li @click="selectLink(1)">
                        <a href="#" :class="[{'selected':selectedLink == 1}]">Students</a> 
                    </li>
                    <li @click="selectLink(2)">
                        <a href="#" :class="[{'selected':selectedLink == 2}]">Teachers</a>
                    </li>
                    <li @click="selectLink(3)" >
                        <a href="#" :class="[{'selected':selectedLink == 3}]">Courses</a>
                    </li>
                    <li @click="selectLink(4)" >
                        <a href="#" :class="[{'selected':selectedLink == 4}]">Carried Courses</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row margin-0" id="sitemanagement-body">
            <studentmanagement 
              v-if="selectedLink == 1"
              class="col-lg-10 col-lg-offset-1"
              :students="students"
            ></studentmanagement>
            <teachermanagement
              v-if="selectedLink == 2"
              class="col-lg-10 col-lg-offset-1"
              :teachers="teachers"
            ></teachermanagement> 
            
            <coursemanagement 
              v-if="selectedLink == 3"
              class="col-lg-10 col-lg-offset-1"
            ></coursemanagement>
            
            <carriedcourse 
              v-if="selectedLink == 4"
              class="col-lg-10 col-lg-offset-1"
            ></carriedcourse>
            
        </div>
    </div>
</template>
<script>
import coursemanagement from "./course/CourseManagement.vue";
import carriedcourse from "./course/CarriedCourse.vue";
import studentmanagement from "./student/StudentManagement.vue";
import teachermanagement from "./teacher/TeacherManagement.vue";

export default {
  data: function() {
    return {
      teachers: [],
      students: {
        fcs: {
          year1: [],
          year2: [],
          year3: [],
          year4: [],
          year5: []
        },
        ict: {
          year1: [],
          year2: [],
          year3: [],
          year4: [],
          year5: []
        }
      },
      selectedLink: 4
    };
  },
  mounted: function() {
    this.load_users();
  },
  methods: {
    selectLink: function(s) {
      this.selectedLink = s;
    },
    load_users: function() {
      axios
        .get("api/load_users")
        .then(res => {
          if (res.data.users) {
            res.data.users.forEach(user => {
              if (user.sex) user.sex = "F";
              else user.sex = "M";
              user.password = "";
              if (user.isTeacher) this.teachers.push(user);
              else {
                if (user.year == 1) {
                  if (user.option) this.students.ict.year1.push(user);
                  else this.students.fcs.year1.push(user);
                } else if (user.year == 2) {
                  if (user.option) this.students.ict.year2.push(user);
                  else this.students.fcs.year2.push(user);
                } else if (user.year == 3) {
                  if (user.option) this.students.ict.year3.push(user);
                  else this.students.fcs.year3.push(user);
                } else if (user.year == 4) {
                  if (user.option) this.students.ict.year4.push(user);
                  else this.students.fcs.year4.push(user);
                } else {
                  if (user.option) this.students.ict.year5.push(user);
                  else this.students.fcs.year5.push(user);
                }
              }
              this.teachers.sort((a, b) => (a.name > b.name ? 1 : -1));
            });
          }
        })
        .catch(error => console.log(error));
    }
  },
  components: {
    studentmanagement,
    teachermanagement,
    coursemanagement,
    carriedcourse
  }
};
</script>
