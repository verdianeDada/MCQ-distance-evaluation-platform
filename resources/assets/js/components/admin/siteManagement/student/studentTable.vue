<template>
    <div class="w3-example w3-padding w3-padding w3-white">
        <table class="table table-hover">
          <thead class="color">
            <tr>
              <th>#</th>
              <th>Matricule</th>
              <th style="width: 500px;">Name</th>
              <th>Sex</th>
              <th>Phone</th>
              <th>Admin</th>
              <th>Enable / Disable</th>
              <th></th>
            </tr>
          </thead>
          <tbody v-if="students[0]">
            <tr 
              v-for="(student,index) in students"
              :key ="student.id"
              :class="[{'blocked':student.isAllowed == 0}]"
            >
                <td>{{index + 1}}</td>
                <td class="uppercase">{{student.matricule}}</td>
                <td class="capitalize" >{{student.name}}</td>
                <td>{{student.sex}}</td>
                <td>{{student.phone}}</td>
                <td class="center">
                  <button v-if="student.isAdmin" @click="putAdmin(student)">Yes</button>
                  <button v-else @click="putAdmin(student)">No</button>
                <td class="center">
                  <button  @click="block(student)">
                    <i class="fa fa-ban bold" :class="[{'color-alarm': student.isAllowed},{'color': !student.isAllowed}]" ></i>
                  </button>
                </td>
                <td>
                  <button  data-toggle="modal" data-target="#updatemodal" @click="setUpdate(student)">
                    <i class="fa fa-pen color "></i>
                  </button>
                  <button  data-toggle="modal" data-target="#deleteuser" @click="setModal(student)">
                    <i class="fa fa-trash color-alarm "></i>
                  </button>
                </td>
            </tr>
          </tbody>
        </table>
        <!-- delete confirmation -->
        
    </div>
</template>
<script>
// import deleteuser from "../../../modals/DeleteUser";
export default {
  data: function() {
    return {};
  },
  methods: {},
  props: ["students", "setModal", "block", "setUpdate", "putAdmin"],
  components: {}
};
</script>
