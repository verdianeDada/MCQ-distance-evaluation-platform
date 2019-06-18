<template>
    <div class="row">
      <div v-if="error.isThereError" style="padding: 140px 20px; text-align: center">
          <h1 class="bold" style="font-size: 42px; color:white">{{error.message}}</h1>
          <a href="/home" style="color: white">click here to be redirected to the dashboard</a>
      </div>
      <div v-else>
        <div class="col-lg-2" style="">
          <timer 
            :start_datetime="start_datetime" 
            :end_datetime="end_datetime" 
            :submitTest = "submitTest"
         ></timer>
        </div>
        <div class="col-lg-9" id="test-body">
          <div class="test-header">
            <table style="width: 100%">                
              <caption><h1 class="bold color capitalize center">Test title:&nbsp;{{actualTest.title}} </h1></caption>
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
              v-for="question in paginatedQuestions"
              :key="question.id"
              class="question"
            >
              <p><span class="bold">{{question.number}}&nbsp;-&nbsp;&nbsp;&nbsp;{{question.text}}</span></p>
              <p style="padding-left: 24px"><i>{{question.over_mark}} mark(s)</i></p>
              <div class="distrators">
                <div v-for = "(distractor, index) in question.distractors" :key="distractor.id">
                  <input type="radio" :name="question.id" :value="distractor.id" :checked="distractor.isCorrect == 1" @change="insertAnswer(question.number - 1, index)">&nbsp;&nbsp;&nbsp;<span>{{distractor.text}}</span>
                </div>
              </div>
            </div>
        </div> 
        <legend></legend>
       
        <div class="row" style="text-align: right">
          <ul class="pagination">
            <li v-if="pageNumber>0" @click="prevPage" ><a href="#">&lt;&lt;</a></li>
            <li v-for="(pne,p) in pageCount()" :key="p" @click="goToPage(p)" >
              <a :class="{'btn-primary': (p)===pageNumber}" href="#">{{p + 1}}</a>
            </li>
            <li v-if="(pageNumber + 1)<pageCount()" @click="nextPage" ><a href="#">&gt;&gt;</a></li>
          </ul>
      </div> 
      <div class="row" style="text-align: right">
        <button class="btn btn-danger" @click="submitTest()">Submit Test</button>  
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
      error: {
        isThereError: false,
        message: ""
      },
      start_datetime: "",
      end_datetime: "",
      pageNumber: 0,
      size: 3,
      paginatedQuestions: []
    };
  },
  methods: {
    goToPage: function(page) {
      this.pageNumber = page;
      this.paginatedData();
    },
    paginatedData() {
      var start = this.pageNumber * this.size;
      var end = start + this.size;
      this.paginatedQuestions = this.actualTest.questions.slice(start, end);
    },
    nextPage() {
      this.pageNumber++;
      this.paginatedData();
    },
    prevPage() {
      this.pageNumber--;
      this.paginatedData();
    },
    pageCount() {
      if (this.actualTest !== {}) {
        let l = this.actualTest.questions.length;
        let s = this.size;
        return Math.ceil(l / s);
      }
    },
    loadpage: function() {
      axios
        .get("api/set_test")
        .then(res => {
          console.log(res.data);
          if (res.data.error) {
            this.error.isThereError = true;
            this.error.message = res.data.error;
          } else {
            if (res.data.course) this.course = res.data.course;
            if (res.data.user) this.user = res.data.user;
            if (res.data.actualTest) {
              res.data.actualTest.questions.forEach(quest => {
                quest.distractors = this.shuffle(quest.distractors);
              });
              this.actualTest = res.data.actualTest;
              this.start_datetime = this.actualTest.start_datetime;
              this.end_datetime = this.actualTest.end_datetime;
              this.pageCount();
              this.paginatedData();
            }
          }
        })
        .catch(error => console.log(error));
    },
    shuffle: function(array) {
      let counter = array.length;

      while (counter > 0) {
        let index = Math.floor(Math.random() * counter);
        counter--;
        let temp = array[counter];
        array[counter] = array[index];
        array[index] = temp;
      }
      return array;
    },
    submitTest: function() {
      var params = Object.assign({}, this.actualTest);
      axios
        .post("api/submit_test", params)
        .then(res => {
          if (res.data.error) {
            this.error.isThereError = true;
            this.error.message = res.data.error;
          } else location.href = "/home";
        })
        .catch(error => console.log(error));
    },
    insertAnswer: function(qPos, dPos) {
      this.actualTest.questions[qPos].distractors.forEach(dist => {
        dist.isCorrect = 0;
      });
      this.actualTest.questions[qPos].distractors[dPos].isCorrect = 1;
    }
  },
  components: {
    timer
  }
};
</script>

