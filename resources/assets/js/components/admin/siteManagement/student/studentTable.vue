<template>
    <div class="w3-example w3-padding w3-padding w3-white">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Matricule</th>
              <th style="width: 700px;">Name</th>
              <th>Sex</th>
              <th>Enable / Disable</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr 
              v-for="(student,index) in students"
              :key ="student.id"
              :class="[{'blocked':student.isAllowed == 0}]"
            >
                <td>{{index + 1}}</td>
                <td class="uppercase">{{student.matricule}}</td>
                <td class="capitalize" >{{student.name}}</td>
                <td>{{student.sex}}</td>
                <td class="center">
                  <button data-toggle= "modal" >
                              <i class="fa fa-ban bold" :class="[{'color-alarm': student.isAllowed},{'color': !student.isAllowed}]" ></i>
                  </button>
                </td>
                <td>
                  <button  data-toggle="modal" data-target="#">
                      <i class="fa fa-pen color "></i>
                  </button>
                  <button  data-toggle="modal" data-target="#deleteuser" @click="setDelete(student)">
                      <i class="fa fa-trash color-alarm "></i>
                  </button>
                </td>
            </tr>
          </tbody>
        </table>
        <!-- delete confirmation -->
        <div class="fade modal" id = "deleteuser" role="dialog">
        <deleteuser
          :deleteUser = "deleteUser"
        ></deleteuser>
      </div>
    </div>
</template>
<script>
import deleteuser from "../../../modals/DeleteUser";
export default {
  data: function() {
    return {
      actualUser: {}
    };
  },
  methods: {
    setDelete: function(student) {
      this.actualUser = student;
    },
    deleteUser: function() {
      axios
        .delete("api/user/" + this.actualUser.id)
        .then(res => {
          this.students.forEach(stu => {
            if (stu.id === this.actualUser.id) {
              var index = this.students
                .map(function(stu) {
                  return stu;
                })
                .indexOf(stu);
              this.students.splice(index, 1);
            }
          });
        })
        .catch(error => console.log(error));
    }
  },
  props: ["students"],
  components: {
    deleteuser
  }
};
</script>
