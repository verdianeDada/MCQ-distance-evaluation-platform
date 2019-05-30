<template>
    <div>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Course Code</th>
              <th>Credit</th>
              <th>Date</th>
              <th>Start time</th>
              <th>End time</th>
              <th>Marks obtained</th>
              <th>Obsolete</th>
              <th>Answer</th>
            </tr>
          </thead>
          <tbody>
            <tr 
              v-for="(course,index) in courses"
              :key ="course.id"
            >
              <td>{{index + 1}}</td>
              <td>{{course.title}}</td>
              <td>{{course.course.code}}</td>
              <td>{{course.course.credit}}</td>
              <td>{{course.date}}</td>
              <td>{{course.start_time}}</td>
              <td>{{course.end_time}}</td>
              <td class="center">
                <i v-if="course.done">{{course.mark_obtained}}&nbsp;/&nbsp;{{course.over_mark}}</i>
                <i v-else>--</i>
              </td>
              <td class="center">
                <span v-if="course.obsolete" class="fa fa-check color bold "></span>
                <span v-else>--</span>
              </td>
              <td class="center">
                <div v-if="course.obsolete">
                  <button>
                    <i class="fa fa-download color bold"></i>
                  </button>
                </div>
                <div v-else>
                  <i>--</i>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
</template>
<script>
export default {
  props: ["courses"]
};
</script>
