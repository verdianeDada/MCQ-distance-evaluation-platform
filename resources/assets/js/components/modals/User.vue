<template>
    <div class="modal-dialog modal-lg">
        <form data-parsley-validate @submit.prevent id="user-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close color-alarm" data-dismiss="modal">&times;</button>
                    <h1 class="bold color center">Edit User</h1>
                </div>
                <div class="modal-body">                
                    <div class="row margin-0">
                        <div class="row margin-0" style="padding: 16px" v-if="error">
                            <span class="color-alarm bold">{{error}}</span>
                        </div>
                        <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                            <label for="name" class="control-label">Name<strong>&nbsp;*</strong></label>
                            <div>
                                <input 
                                    placeholder="Eg: Dada " 
                                    id="name" type="text" 
                                    class="form-control" 
                                    name="name" 
                                    required = "required"
                                    data-parsley-required-message = "Your name is required"
                                    data-parsley-maxlength= "32" 
                                    v-model = "user.name"
                                    autofocus
                                >
                            </div>
                        </div>

                        <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                            <label for="phone" class="control-label">Phone number<strong>&nbsp;*</strong></label>
                            <div>
                                <input id="phone" 
                                type="number" 
                                class="form-control" 
                                placeholder="Eg: 672778972"
                                name="phone" 
                                required ="required"
                                data-parsley-required-message = "Your phone number is required"
                                data-parsley-length-message = "Your phone number should have 9 digits"
                                data-parsley-type="digits"
                                data-parsley-length= "[9,9]"
                                v-model = "user.phone"
                            >
                            </div>
                        </div>
                    </div>
                    <div class="row margin-0">
                        <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                            <label for="password" class="control-label">Password<strong>&nbsp;*</strong></label>
                            <div>
                                <input 
                                    id="password" 
                                    type="password" 
                                    class="form-control" 
                                    name="password" 
                                    value=""
                                    required
                                    data-parsley-required-message = "Your password is required"
                                    data-parsley-minlength= "3"
                                    data-parsley-minlength-message = "Your password should have at least 3 characters"
                                    v-model = "user.password"
                                >
                            </div>
                        </div>

                        <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                            <label for="password-confirm" class="control-label">Confirm Password<strong>&nbsp;*</strong></label>
                            <div>
                                <input 
                                id ="password-confirm" 
                                type= "password" 
                                class= "form-control" 
                                name= "password_confirm"
                                required= "required"
                                data-parsley-required-message = "Confirm your password"
                                data-parsley-isequal=""
                                >
                            </div>
                        </div>
                    </div>                    
                    <div class="row margin-0">
                        <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                            <label class="control-label">Sex:</label>
                            <div>
                                <label for="male" class="radio col-lg-6 col-sm-6 col-xm-12">
                                    <input type="radio" value="M"  id="male" v-model="user.sex">Male
                                </label>
                                <label for="female" class="radio col-lg-6 col-sm-6 col-xm-12">
                                    <input type="radio" value="F" id="female" v-model="user.sex">Female
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-sm-6 col-xm-12" v-if="!user.isTeacher">
                            <label for="option" class="control-label">Option:</label>
                            <div>
                                <select name="option" id="option" class="form-control" v-model = "user.option">
                                    <option value="0" selected>Computer Science</option>
                                    <option value="1">Information &amp; Communication Technology</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-0" v-if="!user.isTeacher">
                        <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                            <label for="year" class="control-label">Year:</label>
                            <div>
                                <select name="year" id="year" class="form-control" v-model.number = "user.year">
                                    <option value="1" selected>Year 1</option>
                                    <option value="2">Year 2</option>
                                    <option value="3">Year 3</option>
                                    <option value="4">Year 4</option>
                                    <option value="5">Year 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-sm-6 col-xm-12">
                            <label for="matricule" class="control-label">Registration number <strong>&nbsp;*</strong></label>
                            <div>
                                <input 
                                    id ="matricule" 
                                    type= "text" 
                                    class= "form-control" 
                                    name= "matricule"
                                    placeholder="Eg: 16T0222"
                                    data-parsley-length-message = "Your matricule should have 7 characters"
                                    data-parsley-length= "[7,7]"
                                    v-model = "user.matricule"
                                >
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
                            @click="update(user.id)"
                        >Update</button>
                    </div>
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
  methods: {},
  props: ["user", "update", "cleanModal", "error"]
};
</script>
