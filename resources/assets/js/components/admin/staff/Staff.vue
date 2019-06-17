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
              style="font-size: 18px;"                   
          >Create Member</button>
      </div>
      <div style="margin-top: 40px">
        <h3 style="font-size: 22px" class="bold center color-black ">Head Of Department</h3>
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
              <button @click="deleteStaff(staff)">
                <i class="fa fa-trash color-alarm "></i>
              </button>
          </div>
        </div>
        
        <h3 style="font-size: 22px" class="bold center color-black  collapse in" data-toggle="collapse" data-target="#hoo" aria-expanded="true">
          Heads Of Options&nbsp;&nbsp;
          <div class="expand_caret caret"></div>
        </h3>
        <div class="collapse in" id="hoo">
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
              <button @click="deleteStaff(staff)">
                <i class="fa fa-trash color-alarm "></i>
              </button>
            </div>
          </div>
        </div>

        <h3 style="font-size: 22px" class="bold center color-black collapse in" data-toggle="collapse" data-target="#teachers" aria-expanded="true">
          Teachers &nbsp;
          <div class="expand_caret caret"></div>          
        </h3>
        <div id="teachers" class="collapse in">
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
              <button @click="deleteStaff(staff)">
                <i class="fa fa-trash color-alarm "></i>
              </button>
            </div>
          </div>
        </div>

        <h3 style="font-size: 22px" class="bold center color-black collapse in" data-toggle="collapse" data-target="#delegates" aria-expanded="true">
          Delegates&nbsp;
          <div class="expand_caret caret"></div>
        </h3>
        <div id="delegates" class="collapse in">
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
              <button @click="deleteStaff(staff)">
                <i class="fa fa-trash color-alarm "></i>
              </button>
            </div>
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

  </div>
</template>

<script>
import staffmodal from "../../modals/Staff.vue";

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
      editStaff: false
    };
  },
  methods: {
    cleanModal: function() {
      this.staff = {};
      this.staff.type = "hod";
    },
    closeModal: function() {
      $("#staffmodal").modal("hide");
    },
    createStaff: function(params) {
      axios
        .post("api/staff", params)
        .then(res => {
          if (res.data.type === "hod") this.staffList.hod.unshift(res.data);
          else if (res.data.type === "hoo")
            this.staffList.hoo.unshift(res.data);
          else if (res.data.type === "teacher")
            this.staffList.teacher.unshift(res.data);
          else this.staffList.delegate.unshift(res.data);
          this.closeModal();
          this.cleanModal();
        })
        .catch(error => {
          console.log("got an error" + error);
        });
    },
    deleteStaff: function(st) {
      if (confirm("Confirm the deletion of: \n" + st.name)) {
        axios
          .delete("api/staff/" + st.id)
          .then(res => {
            var type = st.type;
            this.staffList[type].forEach(staff => {
              if (staff.id === st.id) {
                var index = this.staffList[type]
                  .map(function(staff) {
                    return staff;
                  })
                  .indexOf(staff);
                this.staffList[type].splice(index, 1);
              }
            });
          })
          .catch(error => {
            console.log("an error ocurred" + error);
          });
      }
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
    setModal: function(staff) {
      this.staff = staff;
      this.editStaff = true;
    }
  },
  components: {
    staffmodal
  }
};
</script>

