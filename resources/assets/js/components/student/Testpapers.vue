<template>
    <div class="w3-example w3-padding">

      <!-- // today testpapzers -->
      <div class="w3-padding w3-white" v-if="todayTestpapers[0]">
          <h1 class="color bold center">Today's Test Papers</h1>
          <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Course Code</th>
              <th>Date</th>
              <th>Start time</th>
              <th>End time</th>
              <th>Marks obtained</th>
              <th>Obsolete</th>
              <th>Correction</th>
            </tr>
          </thead>
          <tbody>
            <tr 
              v-for="(testpaper,index) in todayTestpapers"
              :key ="testpaper.id"
            >
              <td>{{index + 1}}</td>
              <td>{{testpaper.title}}</td>
              <td><span class="uppercase">{{testpaper.course.code}}</span></td>
              <td>{{testpaper.date}}</td>
              <td>{{testpaper.start_time}}</td>
              <td>{{testpaper.end_time}}</td>
              <td class="center">
                <i v-if="testpaper.done">{{testpaper.mark_obtained}}&nbsp;/&nbsp;{{testpaper.over_mark}}</i>
                <i v-else>--</i>
              </td>
              <td class="center">
                <span v-if="testpaper.obsolete" class="fa fa-check color bold "></span>
                <span v-else>--</span>
              </td>
              <td class="center">
                <div v-if="testpaper.obsolete">
                  <button @click="download_r(testpaper.id)">
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

      <!-- //repeatingTestpapers -->
      <div class="w3-padding w3-white" v-if="repeatingTestpapers[0]">
          <h1 class="color bold center">Carried Courses' Tests Papers </h1>
          <table class="table table-hover">
          <thead class="">
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Course Code</th>
              <th>Date</th>
              <th>Start time</th>
              <th>End time</th>
              <th>Marks obtained</th>
              <th>Obsolete</th>
              <th>Correction</th>
            </tr>
          </thead>
          <tbody>
            <tr 
              v-for="(testpaper,index) in repeatingTestpapers"
              :key ="testpaper.id"
            >
              <td>{{index + 1}}</td>
              <td>{{testpaper.title}}</td>
              <td><span class="uppercase">{{testpaper.course.code}}</span></td>
              <td>{{testpaper.date}}</td>
              <td>{{testpaper.start_time}}</td>
              <td>{{testpaper.end_time}}</td>
              <td class="center">
                <span v-if="testpaper.done">{{testpaper.mark_obtained}}&nbsp;/&nbsp;{{testpaper.over_mark}}</span>
                <span v-else>--</span>
              </td>
              <td class="center">
                <i v-if="testpaper.obsolete" class="fa fa-check color bold "></i>
                <i v-else>--</i>
              </td>
              <td class="center">
                <div v-if="testpaper.obsolete">
                  <button @click="download_r(testpaper.id)">
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

      <!-- actual test papers -->
      <div class="w3-padding w3-white">
          <h1 class="color bold center">Test Papers</h1>
          <table class="table table-hover">
          <thead class="">
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Course Code</th>
              <th>Date</th>
              <th>Start time</th>
              <th>End time</th>
              <th>Marks obtained</th>
              <th>Obsolete</th>
              <th>Correction</th>
            </tr>
          </thead>
          <tbody>
            <tr 
              v-for="(testpaper,index) in testpapers"
              :key ="testpaper.id"
            >
              <td>{{index + 1}}</td>
              <td>{{testpaper.title}}</td>
              <td><span class="uppercase">{{testpaper.course.code}}</span></td>
              <td>{{testpaper.date}}</td>
              <td>{{testpaper.start_time}}</td>
              <td>{{testpaper.end_time}}</td>
              <td class="center">
                <span v-if="testpaper.done">{{testpaper.mark_obtained}}&nbsp;/&nbsp;{{testpaper.over_mark}}</span>
                <span v-else>--</span>
              </td>
              <td class="center">
                <i v-if="testpaper.obsolete" class="fa fa-check color bold "></i>
                <i v-else>--</i>
              </td>
              <td class="center">
                <div v-if="testpaper.obsolete">
                  <button @click="download_r(testpaper.id)">
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
    
    </div>
</template>

<script>
export default {
  data: function() {
    return {};
  },
  methods: {},
  props: ["testpapers", "repeatingTestpapers", "todayTestpapers", "download_r"],
  components: {}
};
</script>
