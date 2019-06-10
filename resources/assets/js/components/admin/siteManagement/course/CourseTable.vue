<template>
    <div class="w3-example w3-padding w3-padding w3-white">
        <table class="table table-hover">
          <thead class="color">
            <tr>
              <th>year</th>
              <th>Code</th>
              <th style="width: 450px;">Title</th>
              <th>Credit</th>
              <th style="width: 250px;">Lecturer</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr 
              v-for="(course) in courses"
              :key ="course.id"
              :class="[{'blocked': !course.user}]"
            >
                <td>{{course.year}}</td>
                <td class="uppercase">{{course.code}}</td>
                <td class="capitalize" >{{course.title}}</td>
                <td>{{course.credit}}</td>
                <td class="capitalize">
                  <template v-if="course.user">{{course.user.name}}</template>
                  <template v-else></template>
                </td>
                <td>
                  <button  data-toggle="modal" data-target="#updatemodal" @click="setUpdate(course)">
                    <i class="fa fa-pen color "></i>
                  </button>
                  <button @click="confirmDelete(course)">
                    <i class="fa fa-trash color-alarm "></i>
                  </button>
                </td>
            </tr>
          </tbody>
        </table>
    </div>
</template>
<script>
export default {
  data: function() {
    return {};
  },
  methods: {
    confirmDelete: function(course) {
      if (confirm("Confirm the deletion of: \n" + course.code.toUpperCase()))
        this.deleteCourse(course);
      else console.log("nooo");
    }
  },
  props: ["courses", "deleteCourse", "setUpdate", "putAdmin", "isTeacher"],
  components: {}
};
</script>
