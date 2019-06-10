<template>
  <div>
     <div class="row" >
        <h1 class="color bold well carousel-search hidden-phone " style="margin: 40px 0; font-size: 30px">
          <i class="fa fa-user-tie color-black"> 
            </i>&nbsp;&nbsp;Computer Science Lecturers
        </h1>
        <teachertable
            class="test-paper"                
            :users="teachers"
            :block="block"
            :putAdmin="putAdmin"
            :setUpdate="setUpdate"
            :isTeacher="true"
        ></teachertable>
      </div>

      <div class="fade modal" id = "updatemodal" role="dialog">
        <updatemodal
          :update = "update"
          :user = "teacher"
          :cleanModal = "clean"
          :error="error"
        ></updatemodal>
      </div>
  </div>
</template>

<script>
import updatemodal from "../../../modals/User";
import teachertable from "../UserTable.vue";

export default {
  data: function() {
    return {
      teacher: {
        name: "",
        phone: "",
        password: ""
      },
      actualUser: {},
      error: ""
    };
  },
  methods: {
    clean: function() {
      this.teacher = {};
    },
    deleteUser: function(user) {
      axios
        .delete("api/user/" + user.id)
        .then(res => {
          this.teachers.forEach(temp => {
            if (temp.id === user.id) {
              var index = this.teachers
                .map(function(temp) {
                  return temp;
                })
                .indexOf(temp);
              this.teachers.splice(index, 1);
            }
          });
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
        $("#user-form")
          .parsley()
          .isValid()
      ) {
        let params = Object.assign({}, this.teacher);
        axios
          .patch("api/user", params)
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
    setUpdate: function(teacher) {
      this.teacher = teacher;
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
    teachertable,
    updatemodal
  },
  props: ["teachers"]
};
</script>
