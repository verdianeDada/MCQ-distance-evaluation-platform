<template>
  <div class="panel panel-default" id="staffmgt">
    <div class="panel-heading">
        <h1 class="color bold center">Department Staff</h1>
    </div>
    <div class="panel-body">
      <div class="row">
          <button class="btn btn-primary" 
              data-toggle="modal"
              data-target="#staffmodal" 
              @click = "cleanModal"                    
          >Create Member</button>
      </div>
      <div style="margin-top: 40px">
        <h4 class="bold center color-black underline">Head Of Department</h4>
        <div
          v-for= "staff in staffList.hod"
          :key = "staff.id"
          class="staff-mgt row"
        >
          <div class="col-lg-1 padding-0">
            <i class="fa fa-user-tie fa-staff color-black"></i>
          </div>
          <div class="col-lg-10 padding-0">
            <p class="bold capitalize color">{{staff.name}}</p>
            <p>{{staff.description}}</p>
            <p><strong>Email: &nbsp;</strong>{{staff.email}} <strong>Phone: &nbsp;</strong>{{staff.phone}}</p>
          </div>
          <div class="col-lg-1">
              <button data-toggle= "modal" data-target = "#staffmodal" @click="setModal(staff)">
                <i class="fa fa-pen bold color"></i>
              </button>
              <button data-toggle= "modal" data-target = "#deletestaff" @click="setDelete(staff.id)">
                <i class="fa fa-trash color-alarm "></i>
              </button>
          </div>
        </div>
        
        <h4 class="bold center color-black underline">Head Of Option</h4>
        <div
          v-for= "staff in staffList.hoo"
          :key = "staff.id"
          class="staff-mgt row"
        >
          <div class="col-lg-1 padding-0">
            <i class="fa fa-user-tie fa-staff color-black"></i>
          </div>
          <div class="col-lg-10 padding-0">
            <p class="bold capitalize color">{{staff.name}}</p>
            <p>{{staff.description}}</p>
            <p><strong>Email: &nbsp;</strong>{{staff.email}} <strong>Phone: &nbsp;</strong>{{staff.phone}}</p>
          </div>
          <div class="col-lg-1">
            <button data-toggle= "modal" data-target = "#staffmodal" @click="setModal(staff)">
              <i class="fa fa-pen bold color"></i>
            </button>
            <button data-toggle= "modal" data-target = "#deletestaff" @click="setDelete(staff.id)">
              <i class="fa fa-trash color-alarm "></i>
            </button>
          </div>
        </div>

        <h4 class="bold center color-black underline">Teachers</h4>
        <div
          v-for= "staff in staffList.teacher"
          :key = "staff.id"
          class="staff-mgt row"
        >
          <div class="col-lg-1 padding-0">
            <i class="fa fa-user-tie fa-staff color-black"></i>
          </div>
          <div class="col-lg-10 padding-0">
            <p class="bold capitalize color">{{staff.name}}</p>
            <p>{{staff.description}}</p>
            <p><strong>Email: &nbsp;</strong>{{staff.email}} <strong>Phone: &nbsp;</strong>{{staff.phone}}</p>
          </div>
          <div class="col-lg-1">
            <button data-toggle= "modal" data-target = "#staffmodal" @click="setModal(staff)">
              <i class="fa fa-pen bold color"></i>
            </button>
            <button data-toggle= "modal" data-target = "#deletestaff" @click="setDelete(staff.id)">
              <i class="fa fa-trash color-alarm "></i>
            </button>
          </div>
        </div>

        <h4 class="bold center color-black underline">Class coordinator</h4>
        <div
          v-for= "staff in staffList.delegate"
          :key = "staff.id"
          class="staff-mgt row"
        >
          <div class="col-lg-1 padding-0">
            <i class="fa fa-user-graduate fa-staff color-black"></i>
          </div>
          <div class="col-lg-10 padding-0">
            <div>
              <p class="bold capitalize color">{{staff.name}}</p>
              <p>{{staff.description}}</p>
              <p><strong>Email: &nbsp;</strong>{{staff.email}} <strong>Phone: &nbsp;</strong>{{staff.phone}}</p>
            </div>
          </div>
          <div class="col-lg-1">
            <button data-toggle= "modal" data-target = "#staffmodal" @click="setModal(staff)">
              <i class="fa fa-pen bold color"></i>
            </button>
            <button data-toggle= "modal" data-target = "#deletestaff"  @click="setDelete(staff.id)">
              <i class="fa fa-trash color-alarm "></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- new modal -->
    <div class="modal fade" 
      id="staffmodal"
      role="dialog"
    >
      <staffmodal
        :staffList = 'staffList'
        @closeModal = "closeModal"
        @createStaff = "createStaff"
        :staff = "staff"
        @updateStaff = "updateStaff"
        :editStaff = "editStaff"
      ></staffmodal>
    </div>

    <!-- delete confirmation -->
    <div class="fade modal" id = "deletestaff" role="dialog">
      <deletestaff
        @deleteStaff = "deleteStaff"
        :id = "deleteid"
      ></deletestaff>
    </div>
  </div>
</template>

<script>
import staffmodal from "../../modals/Staff.vue";
import deletestaff from "../../modals/DeleteStaff.vue";

export default {
  mounted: function() {
    this.findStaff();
  },
  data: function() {
    return {
      staffList: {
        hod: [],
        hoo: [],
        teacher: [],
        delegate: []
      },
      staff: {
        id: "",
        name: "",
        type: "",
        email: "",
        phone: "",
        description: ""
      },
      editStaff: false,
      deleteid: ""
    };
  },
  methods: {
    cleanModal: function() {
      this.staff = {};
    },
    closeModal: function() {
      $("#staffmodal").modal("hide");
    },
    createStaff: function(params) {
      axios
        .post("api/staff", params)
        .then(res => {
          if ((res.data.type = "hod")) this.staffList.hod.unshift(res.data);
          else if ((res.data.type = "hoo"))
            this.staffList.hoo.unshift(res.data);
          else if ((res.data.type = "teacher"))
            this.staffList.teacher.unshift(res.data);
          else this.staffList.delegate.unshift(res.data);
          this.closeModal();
          this.cleanModal();
        })
        .catch(error => {
          console.log("got an error" + error);
        });
    },
    deleteStaff: function(id) {
      console.log("in delee");
      axios
        .delete("api/staff/" + id)
        .then(res => {
          console.log(res);
          this.staffList.hod.forEach(staff => {
            if (staff.id === id) {
              var index = this.staffList.hod
                .map(function(staff) {
                  return staff;
                })
                .indexOf(staff);
              this.staffList.hod.splice(index, 1);
            }
          });
          this.staffList.hoo.forEach(staff => {
            if (staff.id === id) {
              var index = this.staffList.hoo
                .map(function(staff) {
                  return staff;
                })
                .indexOf(staff);
              this.staffList.hoo.splice(index, 1);
            }
          });
          this.staffList.teacher.forEach(staff => {
            if (staff.id === id) {
              var index = this.staffList.teacher
                .map(function(staff) {
                  return staff;
                })
                .indexOf(staff);
              this.staffList.teacher.splice(index, 1);
            }
          });
          this.staffList.delegate.forEach(staff => {
            if (staff.id === id) {
              var index = this.staffList.delegate
                .map(function(staff) {
                  return staff;
                })
                .indexOf(staff);
              this.staffList.delegate.splice(index, 1);
            }
          });
        })
        .catch(error => {
          console.log("an error ocurred" + error);
        });
    },
    findStaff: function() {
      axios
        .get("api/all-staff")
        .then(res => {
          this.staffList.hod = res.data.hod;
          this.staffList.hoo = res.data.hoo;
          this.staffList.teacher = res.data.teacher;
          this.staffList.delegate = res.data.delegate;
        })
        .catch(error => {
          console.log("got an error" + error);
        });
    },
    updateStaff: function(id, params) {
      axios
        .patch("api/staff/" + id, params)
        .then(res => {
          this.closeModal();
          this.cleanModal();
          this.findStaff();
          this.editStaff = false;
        })
        .catch(error => {
          console.log("an error ocurred" + error);
        });
    },
    setDelete: function(id) {
      this.deleteid = id;
    },
    setModal: function(staff) {
      this.staff = staff;
      this.editStaff = true;
    }
  },
  components: {
    staffmodal,
    deletestaff
  }
};
</script>

