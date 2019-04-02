<template>
    <div class="row margin-0 question">
        <div class="col-lg-1 col-md-1 padding-0">
            <label for="question" class="control-label bold color">Question {{numberQ}}</label>
        </div>
        <div class="col-lg-9 col-lg-offset-1 col-md-9 padding-0">
            <div class="form-group">
                <textarea rows="2" id="question" class="form-control" placeholder="Question" required></textarea>
            </div>
            <div class="">
                <div class="row">
                    <div class="col-lg-1"><span class="color bold">Answer</span></div>
                    <div class="col-lg-11"><span class="color bold">Distractors</span></div>
                </div>
                <div class="form-group row margin-0">
                    <div class="col-lg-1">
                        <input type="radio" name="correct" >
                    </div>
                    <div class="col-lg-11">
                        <textarea class="form-control" rows="2" placeholder="Distractor"></textarea>
                    </div>
                </div>
                <div class="form-group row margin-0">
                    <div class="col-lg-1">
                        <input type="radio" name="correct">
                    </div>
                    <div class="col-lg-11">
                        <textarea class="form-control"  rows="2" placeholder="Distractor"></textarea>
                    </div>
                </div>
            </div>
        </div>                        
        <div class="col-lg-1 col-md-1 padding-0">
            <label for="mark" class="control-label col-lg-6 padding-0">Mark</label>
            <div class="col-lg-6 md-6 padding-0">
                <input type="number" min="1" class="form-control"  style="padding: 0" value="2">
            </div>
        </div>
    </div>
</template>
<script>
export default {
  mounted: function() {
    console.log(this.numberQ);
  },
  props: ["numberQ"]
};
</script>
