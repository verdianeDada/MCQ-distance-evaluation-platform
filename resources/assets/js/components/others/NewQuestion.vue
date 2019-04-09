<template>
    <div class="row margin-0 question">
        <div class="col-lg-1 col-md-1 padding-0">
            <label for="question" class="control-label bold color">Question {{numberQ + 1}}</label>
        </div>
        <div class="col-lg-9 col-lg-offset-1 col-md-9 padding-0">
            <div class="form-group">
                <textarea rows="2" id="question" class="form-control" placeholder="Question" v-model="question.text" required></textarea>
            </div>
            <div class="">
                <div class="row">
                    <div class="col-lg-1"><span class="color bold">Answer</span></div>
                    <div class="col-lg-11"><span class="color bold">Distractors</span></div>
                </div>
                <span>{{question.distractors.length}}</span>
                <div class="form-group row margin-0" v-for="(distractor, index) in question.distractors" :key="index">
                    <div class="col-lg-1">
                        <input type="radio" :value="''+ index" v-model="question.is_correct">
                    </div>
                    <div class="col-lg-11">
                        <textarea class="form-control" rows="2" placeholder="Distractor" v-model="distractor.text"></textarea>
                    </div>
                </div>
            </div>
        </div>                        
        <div class="col-lg-1 col-md-1 padding-0">
            <label for="mark" class="control-label col-lg-6 padding-0" style="padding-top: 6px;">Mark</label>
            <div class="col-lg-6 md-6 padding-0">
                <input type="number" min="1" class="form-control"  style="padding: 0" v-model.number="question.over_mark">
            </div>
            <button @click="remove(numberQ)">
                <i class="fa fa-trash color-alarm"></i>
            </button>
        </div>
    </div>
</template>
<script>
export default {
  props: ["numberQ", "question", "remove"]
};
</script>
