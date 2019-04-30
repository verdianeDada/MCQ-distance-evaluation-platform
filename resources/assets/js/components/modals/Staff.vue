<template>
    <div class="modal-dialog">
        <form data-parsley-validate @submit.prevent id="staff-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close color-alarm" data-dismiss="modal">&times;</button>
                    <h1 class="bold color">Staff Member</h1>
                </div>
                <div class="modal-body">                
                    <div class="row form-group">
                        <label for="name" class="control-label col-lg-2">Name:</label>
                        <div class="col-lg-10">
                            <input type="text" name="" id="name" class="form-control" 
                                placeholder="Member's Name" 
                                required 
                                autofocus
                                v-model="staff.name"
                            >
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="email" class="control-label col-lg-2">Email:</label>
                        <div class="col-lg-10">
                            <input type="email" name="" id="email" class="form-control" 
                                placeholder="Email" 
                                required 
                                v-model="staff.email"
                            >
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="description" class="control-label col-lg-2">Description:</label>
                        <div class="col-lg-10">
                            <input type="text" name="" id="description" class="form-control" 
                                placeholder="Description" 
                                required 
                                v-model="staff.description"
                            >
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="phone" class="control-label col-lg-2">Phone</label>
                        <div class="col-lg-10">
                            <input id="phone" 
                                type="number" 
                                v-model = "staff.phone"
                                class="form-control" 
                                placeholder="Eg: 672778972"
                                required ="required"
                                data-parsley-required-message = " The phone number is required"
                                data-parsley-length-message = "The phone number should have 9 digits"
                                data-parsley-type="digits"
                                data-parsley-length= "[9,9]">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="type" class="control-label col-lg-2">Type:</label>
                        <div class="col-lg-10">
                           <select id="type" v-model = "staff.type" class="form-control" required>                               
                                <option value="hod">Head Of Department</option>
                                <option value="hoo">Head Of Option</option>
                                <option value="teacher">Teacher</option>
                                <option value="delegate">Delegate</option>
                            </select> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        class="btn btn-danger"
                        data-dismiss = "modal"
                    >Cancel</button>
                    <button
                        class="btn btn-primary"
                        type="submit"
                        @click="createStaff"
                        v-if = "!editStaff"
                    >Save</button>
                    <button
                        class="btn btn-primary"
                        type="submit"
                        @click="updateStaff(staff.id)"
                        v-if = "editStaff"
                    >Update</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
  mounted: function() {},

  data: function() {
    return {};
  },
  methods: {
    createStaff: function() {
      if (
        $("#staff-form")
          .parsley()
          .isValid()
      ) {
        let params = Object.assign({}, this.staff);
        this.$emit("createStaff", params);
      }
    },
    updateStaff: function(id) {
      if (
        $("#staff-form")
          .parsley()
          .isValid()
      ) {
        let params = Object.assign({}, this.staff);
        this.$emit("updateStaff", id, params);
      }
    }
  },
  props: ["staffList", "staff", "editStaff"]
};
</script>
