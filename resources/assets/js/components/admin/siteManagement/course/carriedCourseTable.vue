<template>
    <div class="w3-example w3-padding w3-padding w3-white">
        <table class="table table-hover">
          <thead class="color">
            <tr>
              <th>#</th>
              <th>Matricule</th>
              <th style="width: 320px;">Name</th>
              <th>Course code</th>
              <th style="width: 320px;">Course's title</th>
              <th>credit</th>
              <th></th>
            </tr>
          </thead>
          <tbody v-for="(student, index) in students"
            :key ="student.id"
          >
          <tr style="border-top: black 1px solid">
            <td :rowspan="student.user_course_repeat_count*2">{{index + 1}}</td>
            <td :rowspan="student.user_course_repeat_count*2" class="bold uppercase">{{student.matricule}}</td>
            <td :rowspan="student.user_course_repeat_count*2" class="capitalize bold">{{student.name}}</td>
          </tr>
          <tr 
            v-for="(course) in student.user_course_repeat" :key ="course.id"
          >
              <td class="uppercase">{{course.code}} </td>
              <td class="capitalize">{{course.title}}</td>
              <td>{{course.credit}}</td>
              <td>
                  <button @click="confirmDelete(student.id, course.id)">
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
    confirmDelete: function(sid, cid) {
      if (confirm("Confirm the deletion")) this.delete(sid, cid);
      else console.log("nooo");
    }
  },
  props: ["students", "delete"],
  components: {}
};
</script>
