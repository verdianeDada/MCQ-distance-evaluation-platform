<template>
    <div class="w3-example w3-padding">
      <div class="w3-padding w3-white">
          <h1 class="color bold center">Created Tests Papers</h1>
          <table class="table table-hover">
          <thead class="">
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Course Code</th>
              <th>Date</th>
              <th>Start time</th>
              <th>End time</th>
              <th>Total Marks</th>
              <th></th>  
            </tr>
          </thead>
          <tbody>
            <tr 
              v-for="(testpaper,index) in mytestpapers"
              :key ="testpaper.id"
            >
              <td>{{index}}</td>
              <td>{{testpaper.title}}</td>
              <td>{{testpaper.course.code}}</td>
              <td>{{testpaper.date}}</td>
              <td>{{testpaper.start_time}}</td>
              <td>{{testpaper.end_time}}</td>
              <td>{{testpaper.over_mark}}</td>
              <td>
                <button >
                  <i class="fa fa-pen bold color" ></i>
                </button>
                <button>
                  <i class="fa fa-trash color-alarm"></i>
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
  props: ["mytestpapers"]
};
</script>
