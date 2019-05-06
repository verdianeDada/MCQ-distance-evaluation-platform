<template>
    <div class="w3-example w3-padding">
      <div class="w3-padding w3-white" v-if="repeatingTestpapers[0]">
          <h1 class="color bold center">Scheduled Repeating Test Papers</h1>
          <table class="table table-hover">
          <thead class="">
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
              v-for="(testpaper,index) in repeatingTestpapers"
              :key ="testpaper.id"
            >
              <td>{{index}}</td>
              <td>{{testpaper.title}}</td>
              <td>{{testpaper.course.code}}</td>
              <td>{{testpaper.course.credit}}</td>
              <td>{{testpaper.date}}</td>
              <td>{{testpaper.start_time}}</td>
              <td>{{testpaper.end_time}}</td>
              <td>12 / {{testpaper.over_mark}}</td>
              <td class="center">
                <i v-if="testpaper.obsolete" class="fa fa-check color bold "></i>
              </td>
              <td class="center">
                <button   v-if="testpaper.obsolete" >
                  <i class="fa fa-download color bold"></i>
                </button>    
              </td>
            
            </tr>
          </tbody>
        </table>
      </div>

      <!-- actual test papers -->
      <div class="w3-padding w3-white">
          <h1 class="color bold center">Scheduled Test Papers</h1>
          <table class="table table-hover">
          <thead class="">
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
              v-for="(testpaper,index) in testpapers"
              :key ="testpaper.id"
            >
              <td>{{index}}</td>
              <td>{{testpaper.title}}</td>
              <td>{{testpaper.course.code}}</td>
              <td>{{testpaper.course.credit}}</td>
              <td>{{testpaper.date}}</td>
              <td>{{testpaper.start_time}}</td>
              <td>{{testpaper.end_time}}</td>
              <td>12 / {{testpaper.over_mark}}</td>
              <td class="center">
                <i v-if="testpaper.obsolete" class="fa fa-check color bold"></i>
              </td>
              <td class="center">
                <button v-if="testpaper.obsolete">
                  <i  class="fa fa-download color bold"></i>
                </button>    
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    
    </div>
</template>

<script>
export default {
  data: function() {
    return {};
  },
  methods: {},
  props: ["testpapers", "repeatingTestpapers"],
  components: {}
};
</script>
