<template>
    <div class="courses panel">
        <div class="panel-heading">
          <h4 class="color center">Attributed courses </h4>
        </div>
        <div class="panel-body">
          <div v-if="courses[0] == null" style="padding-top: 80px">
            <p class="color-alarm">You have no course, please contact the administrator</p>
          </div>
          <div v-else>
            <div
            v-for="course in courses"
            :key="course.id"
            >
              <i class="fa color fa-book"></i>
              <div class="inside">
                <p class="code">
                  {{course.code}}
                </p>
                <p class="title">
                  {{course.title}}
                </p>
                <p class="option">
                  {{course.option}}&nbsp;, Year &nbsp;{{course.year}}
                </p>
              </div>
              
            </div>
          </div>
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
  props: ["courses"]
};
</script>
