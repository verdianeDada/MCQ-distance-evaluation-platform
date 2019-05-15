<template>
    <div class="row">
      <div v-if="error" style="padding: 130px 0; text-align: center">
          <h1 class="bold" style="font-size: 42px; color:white">Sorry, There is not exam now!</h1>
          <a href="/home" style="color: white">click here to be redirected to the dashboard</a>
      </div>
      <div v-else>
        <div class="col-lg-2" style="">
          <timer 
            :start_datetime="start_datetime" 
            :end_datetime="end_datetime" 
         ></timer>
        </div>
        <div class="col-lg-9" id="test-body">
          <div class="test-header">
            <table style="width: 100%">                
              <caption><h1 class="bold color capitalize center">Test title:{{actualTest.title}} </h1></caption>
              <tbody>
                <tr>
                  <td><span class="bold">Student's matricule: </span>{{user.matricule}}</td>
                  <td><span class="bold">Student's name: </span>{{user.name}}</td>
                  <td><span class="bold">Student's phone: </span>{{user.phone}}</td>
                </tr>
                <tr>
                  <td><span class="bold">Course's code: </span>{{course.code}}</td>
                  <td><span class="bold">Course's title: </span>{{course.title}}</td>
                  <td><span class="bold">Course's option: </span>{{course.option}}</td>
                </tr>
                <tr>
                  <td><span class="bold">Course's year: </span>{{course.year}}</td>
                  <td><span class="bold">Course's credit: </span>{{course.credit}}</td>
                  <td><span class="bold">Allocated Time: </span>{{actualTest.duration}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- questions -->
          <div class="questions">
            <div 
              v-for="(question,index) in actualTest.questions"
              :key="question.id"
              class="question"
            >
              <p><span class="bold">{{index + 1}}&nbsp;&nbsp;&nbsp;&nbsp;{{question.text}}</span></p>
              <p><i>{{question.over_mark}} mark(s)</i></p>
              <div class="distrators">
                <div v-for = "distractor in question.distractors" :key="distractor.id">
                  <input type="radio" :name="question.id" :value="distractor.id">&nbsp;&nbsp;&nbsp;<span>{{distractor.text}}</span>
                </div>
              </div>
            </div>
        </div> 
        <legend></legend>
        <div class="row" style="text-align: right">
          <ul class="pagination">
            <li><a href="#">&lt;&lt;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&gt;&gt;</a></li>
          </ul>
      </div> 
      <div class="row" style="text-align: right">
        <button class="btn btn-primary">Submit Test</button>  
      </div>      
      </div>      
    </div>    
  </div>
</template>
<script>
import timer from "../others/Timer.vue";
export default {
  mounted: function() {
    this.loadpage();
  },
  data: function() {
    return {
      actualTest: {},
      course: {},
      user: {},
      error: "",
      start_datetime: 0,
      end_datetime: 0
    };
  },
  methods: {
    loadpage: function() {
      axios
        .get("api/set_test")
        .then(res => {
          this.actualTest = res.data.actualTest;
          this.course = res.data.course;
          this.user = res.data.user;
          console.log(res.data);
          if (res.data.error) this.error = res.data.error;

          this.start_datetime = this.actualTest.start_datetime;
          this.end_datetime = this.actualTest.end_datetime;
        })
        .catch(error => console.log(error));
    }
  },
  components: {
    timer
  }
};
</script>

