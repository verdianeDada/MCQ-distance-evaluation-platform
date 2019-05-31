<template>
    <div class="w3-example w3-padding w3-padding w3-white">
        <table class="table table-hover">
          <thead class="color">
            <tr>
              <th>#</th>
              <th v-if="!isTeacher">Matricule</th>
              <th style="width: 500px;">Name</th>
              <th>Sex</th>
              <th>Phone</th>
              <th>Admin</th>
              <th>Enable / Disable</th>
              <th></th>
            </tr>
          </thead>
          <tbody v-if="users[0]">
            <tr 
              v-for="(user,index) in users"
              :key ="user.id"
              :class="[{'blocked':user.isAllowed == 0}]"
            >
                <td>{{index + 1}}</td>
                <td v-if="!isTeacher" class="uppercase">{{user.matricule}}</td>
                <td class="capitalize" >{{user.name}}</td>
                <td>{{user.sex}}</td>
                <td>{{user.phone}}</td>
                <td class="center">
                  <button v-if="user.isAdmin" @click="putAdmin(user)">Yes</button>
                  <button v-else @click="putAdmin(user)">No</button>
                <td class="center">
                  <button  @click="block(user)">
                    <i class="fa fa-ban bold" :class="[{'color-alarm': user.isAllowed},{'color': !user.isAllowed}]" ></i>
                  </button>
                </td>
                <td>
                  <button  data-toggle="modal" data-target="#updatemodal" @click="setUpdate(user)">
                    <i class="fa fa-pen color "></i>
                  </button>
                  <button  data-toggle="modal" data-target="#deleteuser" @click="setModal(user)">
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
  props: ["users", "setModal", "block", "setUpdate", "putAdmin", "isTeacher"],
  components: {}
};
</script>
