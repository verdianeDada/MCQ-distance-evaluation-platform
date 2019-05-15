<template>
    <div class="timer">
        <i class="fa fa-clock" style="color: white; vertical-align: middle;font-size: 37px"></i>
      <div class="hour">
        &nbsp;&nbsp;<span class="number">{{ hours }}&nbsp;:&nbsp;</span>
      </div>
      <div class="min">
        <span class="number">{{ minutes }}&nbsp;:&nbsp;</span>
      </div>
      <div class="sec">
        <span class="number">{{ seconds }}</span>
      </div>
    </div>
</template>
<script>
export default {
  data: function() {
    return {
      timer: "",
      wordString: {},
      start: "",
      end: "",
      interval: "",
      minutes: "",
      seconds: "",
      hours: "",
      expired: false
    };
  },
  created: function() {
    this.wordString = JSON.parse(this.trans);
  },
  mounted() {
    setTimeout(() => {
      this.start_count();
    }, 2000);
  },
  methods: {
    start_count: function() {
      this.start = new Date(this.start_datetime).getTime();
      this.end = new Date(this.end_datetime).getTime();
      // Update the count down every 1 second
      this.timerCount(this.start, this.end);
      this.interval = setInterval(() => {
        this.timerCount(this.start, this.end);
      }, 1000);
    },
    timerCount: function(start, end) {
      // Get todays date and time
      var now = new Date();
      // Find the distance between now an the count down date
      var distance = start - now;
      var passTime = end - now;

      if (distance < 0 && passTime < 0) {
        // this.message = this.wordString.expired;
        // this.statusType = "expired";
        this.expired = true;
        // this.statusText = this.wordString.status.expired;
        clearInterval(this.interval);
        return;
      } else if (distance < 0 && passTime > 0) {
        this.calcTime(passTime);
        // this.message = this.wordString.running;
        // this.statusType = s"running";
        // this.statusText = this.wordString.status.running;
      } else if (distance > 0 && passTime > 0) {
        this.calcTime(distance);
        //   this.message = this.wordString.upcoming;
        //   this.statusType = "upcoming";
        //   this.statusText = this.wordString.status.upcoming;
      }
    },
    calcTime: function(dist) {
      // Time calculations for days, hours, minutes and seconds
      // this.days = Math.floor(dist / (1000 * 60 * 60 * 24));
      this.hours = Math.floor(
        // (dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        dist / (1000 * 60 * 60)
      );
      this.minutes = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
      this.seconds = Math.floor((dist % (1000 * 60)) / 1000);
    }
  },
  props: ["start_datetime", "end_datetime", "trans"]
};
</script>

