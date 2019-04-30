<template>
    <div class="row margin-0 question">
        <div class="">
            <label for="question" class="control-label bold color">Question {{numberQ + 1}}</label>
        </div>
        <div class="col-lg-10">
            <div class="form-group">
                <textarea rows="2" id="question" class="form-control" placeholder="Question" v-model="question.text" required></textarea>
            </div>
            <div class="">
                <div class="row">
                    <div class="col-lg-1"><span class="color-gray bold">Answer</span></div>
                    <div class="col-lg-3 col-lg-offset-1"><span class="color-gray bold">Distractors</span></div>
                    <div class="col-lg-2 col-lg-offset-5">
                        <i class="fa fa-plus bold color btn" @click="addD(numberQ)">Add distractor</i>
                    </div>
                </div>
                <div class="form-group row margin-0 padding-0" 
                    v-for="(distractor, indexD) in question.distractors" :key="indexD"
                >
                    <div class="col-lg-1">
                        <input type="radio" :value="''+ indexD" v-model="question.is_correct">
                    </div>
                    <div class="col-lg-10" style="padding-right: 0">
                        <textarea class="form-control" rows="2" placeholder="Distractor" v-model="distractor.text" required></textarea>
                    </div>
                    <div class="col-lg-1" v-if="indexD > 1">
                        <div class="col-lg-1" style="padding-left: 0">
                            <i class="fa fa-trash bold color-alarm btn" @click="removeD(numberQ, indexD)"></i>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1" style="padding-left: 0" v-if="numberQ > 0">
            <i class="fa fa-trash bold color-alarm btn" @click="remove(numberQ)"></i>
        </div>                        
        <div class="col-lg-1 padding-0">
            <label for="mark" class="control-label col-lg-6 padding-0" style="padding-top: 6px;">Mark</label>
            <div class="col-lg-6 md-4 padding-0">
                <input type="number" min="1" class="form-control"  style="padding: 0" required v-model.number="question.over_mark">
            </div>            
        </div>
        
    </div>
</template>
<script>
export default {
  methods: {},
  props: ["numberQ", "question", "remove", "removeD", "addD"]
};
</script>
