<template>
    <div class="courses panel">
      <!-- repeatingCourses -->
      <div v-if="repeatingCourses[0]">
          <div class="panel-heading">
            <h4 class="color center">Carried Courses </h4>
          </div>
          <div class="panel-body">
            <div>
              <div
              v-for="course in repeatingCourses"
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
                    Year: &nbsp;{{course.year}}&nbsp; Credit:&nbsp;{{course.credit}};
                  </p>
                  <p class="option capitalize">
                    <span class="bold"> Lecturer: </span>{{course.user.name}}
                  </p>
                </div>
                
              </div>
            </div>
          </div>
      </div>
      <!-- other courses -->
      <div>
        <div class="panel-heading">
          <h4 class="color center">Actual Courses </h4>
        </div>
        <div class="panel-body">
          <div>
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
                  Year: &nbsp;{{course.year}}&nbsp; Credit:&nbsp;{{course.credit}};
                </p>
                <p class="option capitalize">
                 <span class="bold"> Lecturer: </span>{{course.user.name}}
                </p>
              </div>
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
  props: ["courses", "repeatingCourses"]
};
</script>
