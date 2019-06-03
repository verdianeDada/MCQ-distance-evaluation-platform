<template>
    <div class="modal-dialog">
        <form data-parsley-validate @submit.prevent id="course-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close color-alarm" data-dismiss="modal">&times;</button>
                    <h1 class="bold color">Course</h1>
                </div>
                <div class="modal-body">
                    <div class="row margin-0" style="padding: 16px" v-if="error">
                        <span class="color-alarm bold">{{error}}</span>
                    </div>                
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <label for="title" class="control-label">Title:</label>
                            <input type="text" name="" id="title" class="form-control" 
                                placeholder="Title" 
                                required 
                                autofocus
                                v-model="course.title"
                            >
                        </div>
                        <div class="col-lg-6">
                            <label for="code" class="control-label">Code:</label>
                            <input type="text" name="" id="code" class="form-control" 
                                placeholder="CSC291" 
                                required 
                                v-model="course.code"
                            >
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <label for="year" class="control-label">Year:</label>
                            <select id="year" v-model.number = "course.year" class="form-control" required>                               
                                <option  selected value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select> 
                        </div>
                        <div class="col-lg-6">
                            <label for="credit" class="control-label">credit:</label>
                            <input type="number" name="" id="credit" class="form-control" 
                                required 
                                v-model.number="course.credit"
                                min="1"
                                max="5"
                            >
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <label for="lecturer" class="control-label">Lecturer:</label>
                            <select id="lecturer" v-model= "course.user_id" class="form-control" required>                               
                                <option class="capitalize color"
                                    v-for="teacher in teachers"
                                    :key="teacher.id" 
                                    :value="teacher.id"
                                >{{teacher.name}}</option>
                            </select> 
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label">Is it common course ?</label>
                            <div class="row" style="padding-top: 8px">
                                <div class="col-lg-6">
                                    <label for="Yes" class="control-label">Yes</label>
                                    <input type="radio" name="" id="Yes"
                                        value="1"
                                        v-model.number="course.isCommon"
                                        checked
                                    > 
                                </div>
                                <div class="col-lg-6">
                                    <label for="No" class="control-label">No</label>
                                    <input type="radio" name="" id="No"
                                        value="0"
                                        v-model.number="course.isCommon"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group" v-if="course.isCommon == 0">
                        <div class="col-lg-6" style="padding-top: 8px">
                            <label for="fcs" class="control-label">Option :</label>
                            <div class="row">
                                <div class="col-lg-6" >
                                    <label for="fcs" class="control-label">FCS</label>
                                    <input type="radio" id="fcs" 
                                        value="0"
                                        v-model.number="course.option"
                                    >
                                </div>
                                <div class="col-lg-6">
                                    <label for="ict" class="control-label">ICT</label>
                                    <input type="radio" name="" id="ict"  
                                        value="1"
                                        v-model.number="course.option"
                                    > 
                                </div>
                            </div>
                            
                            
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
                        v-if = "!edit"
                        @click="create"
                    >Save</button>
                    <button
                        class="btn btn-primary"
                        type="submit"
                        @click="update"
                        v-if = "edit"
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
  methods: {},
  props: ["course", "teachers", "edit", "update", "create", "error"]
};
</script>
