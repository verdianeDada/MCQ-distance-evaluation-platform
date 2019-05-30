<template>
    <div class="modal-dialog">
        <form data-parsley-validate @submit.prevent id="news-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close color-alarm" data-dismiss="modal">&times;</button>
                    <h1 class="bold color">News</h1>
                </div>
                <div class="modal-body">                
                    <div class="row form-group">
                        <label for="title" class="control-label col-lg-2">Title:</label>
                        <div class="col-lg-10">
                            <input type="text" name="" id="title" class="form-control" 
                                placeholder="New's Title" 
                                required 
                                autofocus
                                v-model="news.title"
                            >
                        </div>
                    </div>
                    <div class="row form-group">
                        <label id="des" class="control-label col-lg-2">Description</label>
                        <div class="col-lg-10">
                            <textarea id="des" rows="3" class="form-control" placeholder="New's Description" 
                                required 
                                v-model="news.text"
                            ></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        class="btn btn-danger"
                        data-dismiss = "modal"
                    >Cancel</button>
                    <button
                        class="btn btn-primary"
                        type="submit"
                        @click="createNews"
                        v-if = "!edit"
                    >Save</button>
                    <button
                        class="btn btn-primary"
                        type="submit"
                        @click="updateNews(news.id)"
                        v-if = "edit"
                    >Update</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
  mounted: function() {},
  data: function() {
    return {};
  },
  methods: {
    createNews: function() {
      if (
        $("#news-form")
          .parsley()
          .isValid()
      ) {
        let params = Object.assign({}, this.news);
        this.$emit("createNews", params);
      }
    },
    updateNews: function(id) {
      if (
        $("#news-form")
          .parsley()
          .isValid()
      ) {
        let params = Object.assign({}, this.news);
        this.$emit("updateNews", id, params);
      }
    }
  },
  props: ["newsList", "news", "edit", "cleanModal"]
};
</script>
