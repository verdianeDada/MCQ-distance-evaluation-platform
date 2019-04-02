<template>
    <div class="container margin-0">
        <div class="row">
            <news class="col-lg-6"></news>
            <staff class="col-lg-6"></staff>
        </div>
    </div>
</template>

<script>
import news from "./news/News.vue";
import staff from "./staff/Staff.vue";

export default {
  components: {
    news,
    staff
  }
};
</script>

