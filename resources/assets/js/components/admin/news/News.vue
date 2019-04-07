<template>
    <div class="panel panel-default" id="newsmgt">

      
        <div class="panel-heading">
            <h1 class="color bold center">News</h1>
        </div>
        <div class="panel-body">
            <div class="row">
                <button class="btn btn-primary" 
                    data-toggle="modal"
                    data-target="#newsmodal"
                    @click= "cleanModal"                     
                >Create News</button>
            </div>
            <div style="margin-top: 28px">
                <div
                    v-for= "news in newsList"
                    :key = "news.id"
                    class="news-mgt row"
                >
                    <div class="col-lg-11 padding-0">
                        <div class="news-title">
                            <span class="color bold capitalize">{{news.title}}</span>
                        </div>
                        <div class="news-text">
                            <span>{{news.text}}</span>    
                        </div> 
                    </div>
                    <div class="col-lg-1">
                        <button data-toggle= "modal" data-target = "#newsmodal" @click="setModal(news)">
                            <i class="fa fa-pen bold color" ></i>
                        </button>
                        <button  data-toggle="modal" data-target="#deletenews" @click ="setDelete(news.id)">
                            <i class="fa fa-trash color-alarm "></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- new modal -->
        <div class="modal fade" 
          id="newsmodal"
          role="dialog"
        >
            <newsmodal
              :newsList = 'newsList'
              @closeModal = "closeModal"
              @createNews = "createNews"
              :news = "news"
              @updateNews = "updateNews"
              :edit = "edit"
            ></newsmodal>
        </div>

        <!-- confirmation modal -->
        <div class="fade modal" id = "deletenews" role="dialog">
          <deletenews
            @deleteNews = "deleteNews"
            :id = "deleteid"
          ></deletenews>
        </div>
    </div>
</template>

<script>
import newsmodal from "../../modals/News.vue";
import deletenews from "../../modals/DeleteNews.vue";

export default {
  mounted: function() {
    this.findNews();
  },
  data: function() {
    return {
      newsList: [],
      news: {
        id: "",
        title: "",
        text: ""
      },
      edit: false,
      deleteid: ""
    };
  },
  methods: {
    closeModal: function() {
      $("#newsmodal").modal("hide");
    },
    createNews: function(params) {
      axios
        .post("api/news", params)
        .then(res => {
          this.newsList.unshift(res.data);
          this.news = {};
          this.closeModal();
        })
        .catch(error => {
          console.log("got an error" + error);
        });
    },
    deleteNews: function(id) {
      axios
        .delete("api/news/" + id)
        .then(res => {
          this.newsList.forEach(news => {
            if (news.id === id) {
              var index = this.newsList
                .map(function(news) {
                  return news;
                })
                .indexOf(news);
              this.newsList.splice(index, 1);
            }
          });
        })
        .catch(error => {
          console.log("an error ocurred" + error);
        });
    },
    findNews: function() {
      axios
        .get("api/all-news")
        .then(res => {
          this.newsList = res.data;
        })
        .catch(error => {
          console.log("got an error" + error);
        });
    },
    cleanModal: function(news) {
      this.news = {};
    },
    updateNews: function(id, params) {
      axios
        .patch("api/news/" + id, params)
        .then(res => {
          this.closeModal();
          params.id = id;
          this.newsList.forEach(news => {
            if (news.id === id) {
              var index = this.newsList
                .map(function(news) {
                  return news;
                })
                .indexOf(news);
              this.newsList.splice(index, 1);
            }
          });
          this.newsList.unshift(params);
          this.edit = false;
        })
        .catch(error => {
          console.log("an error ocurred" + error);
        });
    },
    setDelete: function(id) {
      this.deleteid = id;
    },
    setModal: function(news) {
      this.news = news;
      this.edit = true;
    }
  },
  components: {
    newsmodal,
    deletenews
  }
};
</script>

