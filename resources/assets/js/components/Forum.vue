<template>
    <div>
        <form data-parsley-validate @submit.prevent id="new-post">
            <div class="row margin-0 post" style="padding: 20px 16px 16px 16px ; border-top: none">
                <div v-if="this.isteacher" class="col-lg-1 col-lg-offset-1">
                    <i class="fa fa-user-tie big"></i>
                </div>
                <div v-if="!this.isteacher" class="col-lg-1 col-lg-offset-1">
                    <i class="fa fa-user-graduate big"></i>
                </div>
                <div class="col-lg-9">
                    <textarea v-model="post.text"  row margin-0s="2" required autofocus class="form-control" placeholder="New Post"></textarea>
                </div>
                <div class="col-lg-1 padding-0">
                    <button class="fake-button">
                         <i class="fa btn fa-plus  big" @click="createPost">
                        </i>
                    </button>
                </div>
            </div>

              <!-- post -->
              <div 
                  v-for="post in postList"
                  :key = "post.id"
                  class="post-bg row margin-0"
              >
                <div class="post">
                  <div class="row margin-0">                     
                      <div v-if="post.user.isTeacher" class="col-lg-1">
                          <i class="fa fa-user-tie big"></i>
                      </div>
                      <div v-else class="col-lg-1">
                          <i class="fa fa-user-graduate big"></i>
                      </div>
                      <div class="col-lg-11">
                        <div class="capitalize bold">{{post.user.name}}</div>
                        <div class="row margin-0">
                            <div class="col-lg-3 padding-0">
                                2 days ago
                            </div>
                            <div class="col-lg-3 padding-0  col-lg-offset-6">
                                2 likes
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="post-text row margin-0">
                      <p>{{post.text}}</p>
                  </div> 
                </div>
              <!-- post comments -->
                
                <div class="row margin-0">
                  <!-- <div class="col-lg-1" style="background-color: transparent;"></div> -->
                  <div class="col-lg-11 col-lg-offset-1 padding-0">
                    <div                  
                    v-for ="(comment, i) in commentList"
                    :key = "`${i}-${comment.id}`"
                  >
                    <div 
                      class="row margin-0 post-comment " 
                      v-if="comment.post_id == post.id"
                    >
                      <div class="row margin-0">                     
                        <div v-if="comment.user.isTeacher" class="col-lg-1">
                            <i class="fa fa-user-tie big"></i>
                        </div>
                        <div v-else class="col-lg-1">
                            <i class="fa fa-user-graduate big"></i>
                        </div>
                        <div class="col-lg-11">
                            <div class="capitalize bold">{{comment.user.name}}</div>
                            <div class="row margin-0">
                                <div class="col-lg-3 padding-0">
                                    2 days ago
                                </div>
                                <div class="col-lg-3 padding-0  col-lg-offset-6">
                                    2 likes
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="post-text row margin-0">
                          <p>{{comment.text}}</p>
                      </div>  
                    </div>
                  </div>
                  </div>
                  
                </div>
              </div>
        </form>
    </div>
</template>
<script>
export default {
  data: function() {
    return {
      postList: [],
      commentList: [],
      post: {
        id: "",
        text: ""
      }
    };
  },
  mounted: function() {
    this.findPost();
  },
  methods: {
    createPost: function() {
      var params = Object.assign({}, this.post);
      axios
        .post("api/post", params)
        .then(res => {
          this.findPost();
          console.log(res.data);
          this.post = {};
        })
        .catch(error => {
          console.log("got an error" + error);
        });
    },
    deletePost: function(id) {
      axios
        .delete("api/post/" + id)
        .then(res => {
          console;
          //   this.findPost();
        })
        .catch(error => {
          console.log("an error ocurred" + error);
        });
    },
    findPost: function() {
      axios
        .get("api/all-post")
        .then(res => {
          this.postList = res.data.posts;
          this.commentList = res.data.comments;
          console.log(this.postList);
          console.log("commetn");
          console.log(this.commentList);
        })
        .catch(error => {
          console.log("got an error" + error);
        });
    }
  },
  props: ["userid", "username", "isteacher", "isadmin"]
};
</script>
