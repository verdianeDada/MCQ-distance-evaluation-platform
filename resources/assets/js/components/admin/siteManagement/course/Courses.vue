<template>
    <div class="w3-example w3-padding">
      <div class="w3-padding w3-white" v-if="todayTestpapers[0]">
          <h1 class="color bold center">Today's Test Papers</h1>
          
      </div>
    </div>
</template>

<script>
export default {
  data: function() {
    return {};
  },
  methods: {},
  props: ["courses"],
  components: {}
};
</script>
