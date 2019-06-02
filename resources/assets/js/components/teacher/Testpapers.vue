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
              <td>{{testpaper.course.code}}</td>
              <td>{{testpaper.course.credit}}</td>
              <td>{{testpaper.date}}</td>
              <td>{{testpaper.start_time}}</td>
              <td>{{testpaper.end_time}}</td>
              <td>{{testpaper.over_mark}}</td>
              <td>
                <button data-toggle="modal" data-target="#testpapermodal" @click="setModal(testpaper.id)">
                  <i class="fa fa-pen bold color" ></i>
                </button>
                <button data-toggle="modal" data-target="#deletetest" @click="setdelete(testpaper.id)">
                  <i class="fa fa-trash color-alarm"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="fade modal" id="deletetest" role="dialog">
          <deletetest
            :id = "deleteid"
            :mytestpapers="mytestpapers"
            :deleteTestPaper= "deleteTestPaper"
          ></deletetest>
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
              <th>results</th>
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
                <td>{{testpaper.course.code}}</td>
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
import deletetest from "../modals/DeleteTestPaper.vue";

export default {
  data: function() {
    return {
      deleteid: ""
    };
  },
  methods: {
    setdelete: function(id) {
      this.deleteid = id;
    }
  },
  props: [
    "mytestpapers",
    "courses",
    "deleteTestPaper",
    "setModal",
    "downloadResults"
  ],
  components: { deletetest }
};
</script>
