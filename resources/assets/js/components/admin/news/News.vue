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
                        <button>
                            <i class="fa fa-pen bold color" data-toggle= "modal" data-target = "#newsmodal" @click="setModal(news)"></i>
                        </button>
                        <button>
                            <i class="fa fa-trash color-alarm " @click="deleteNews(news.id)"></i>
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
    </div>
</template>

<script>
import newsmodal from "../../modals/News.vue";

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
      edit: false
    };
  },
  methods: {
    closeModal: function() {
      //   $("#newsmodal").modal("toggle");
      //   $("#newmodal").modal("hide");
    },
    createNews: function(params) {
      axios
        .post("api/news", params)
        .then(res => {
          this.closeModal();
          this.findNews();
          //   const news = res.data;
          //   this.newsList.push(news);
          //   this.news.title = "";
          //   this.news.text = "";
        })
        .catch(error => {
          console.log("got an error" + error);
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
    setModal: function(news) {
      this.news = news;
      this.edit = true;
    },
    cleanModal: function(news) {
      this.news = {};
    },
    updateNews: function(id, params) {
      axios
        .patch("api/news/" + id, params)
        .then(res => {
          this.findNews();
          this.edit = false;
        })
        .catch(error => {
          console.log("an error ocurred" + error);
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
    }
  },
  components: {
    newsmodal
  }
};
</script>

