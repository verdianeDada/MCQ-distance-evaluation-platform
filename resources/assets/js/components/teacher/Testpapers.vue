<template>
  <div>
    <div class="w3-example w3-padding">
      <div class="w3-padding w3-white">
          <h1 class="color bold center">Created Test Papers</h1>
          <table class="table table-hover">
          <thead class="">
            <tr>
              <th>Title</th>
              <th>Course Code</th>
              <th>Credit</th>
              <th>Date</th>
              <th>Start time</th>
              <th>End time</th>
              <th>Total Marks</th>
              <th></th>  
            </tr>
          </thead>
          <tbody>
            <tr 
              v-for="(testpaper) in mytestpapers"
              :key ="testpaper.id"
            >
              <td>{{testpaper.title}}</td>
              <td><span class="uppercase">{{testpaper.course.code}}</span></td>
              <td>{{testpaper.course.credit}}</td>
              <td>{{testpaper.date}}</td>
              <td>{{testpaper.start_time}}</td>
              <td>{{testpaper.end_time}}</td>
              <td>{{testpaper.over_mark}}</td>
              <td>
                <button data-toggle="modal" data-target="#testpapermodal" @click="setModal(testpaper.id)">
                  <i class="fa fa-pen bold color" ></i>
                </button>
                <button data-toggle="modal" data-target="#deletetest" @click="confirmDelete(testpaper)">
                  <i class="fa fa-trash color-alarm"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    
    </div>
    <div class="w3-example w3-padding">
      <div class="w3-padding w3-white">
          <h1 class="color bold center">Obsolete Test Papers</h1>
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
              <th>Results</th>
              <th></th>  
            </tr>
          </thead>
          <tbody>
            <tr 
              v-for="(testpaper) in mytestpapers"
              :key ="testpaper.id"
            >
              <template v-if="testpaper.obsolete">
                <td><i class="fa fa-check color bold "></i></td>
                <td>{{testpaper.title}}</td>
                <td><span class="uppercase">{{testpaper.course.code}}</span></td>
                <td>{{testpaper.course.credit}}</td>
                <td>{{testpaper.date}}</td>
                <td>{{testpaper.start_time}}</td>
                <td>{{testpaper.end_time}}</td>
                <td>
                  <button @click="downloadResults(testpaper.id)">
                    <i class="fa fa-download color bold"></i>
                  </button>
                </td>
              </template>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    confirmDelete: function(test) {
      if (confirm("Confirm the deletion of: \n" + test.title))
        this.deleteTestPaper(test);
    }
  },
  props: [
    "mytestpapers",
    "courses",
    "deleteTestPaper",
    "setModal",
    "downloadResults"
  ],
  components: {}
};
</script>
