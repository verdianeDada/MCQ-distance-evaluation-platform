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
              <th>Starting date & time</th>
              <th>Duration</th>
              <th>Total Mark</th>
              <th></th>  
            </tr>
          </thead>
          <tbody>
            <tr 
              v-for="(testpaper, index) in mytestpapers"
              :key ="testpaper.id"
            >
              <td>{{index + 1}}</td>
              <td>{{testpaper.title}}</td>
              <td>{{testpaper.course.code}}</td>
              <td>{{testpaper.start_time}}</td>
              <td>{{testpaper.duration}}</td>
              <td>{{testpaper.over_mark}}</td>
              <td>
                <button>
                  <i class="fa fa-pencil bold color"></i>
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
  mounted() {},
  data: function() {
    return {};
  },
  methods: {},
  components: {},

  props: ["mytestpapers"]
};
</script>
