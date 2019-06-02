<template>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close color-alarm" data-dismiss="modal">&times;</button>
                <h3 class="color-alarm">Confirm deletion</h3>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal"  @click="deleteCourse">
                    Delete
                </button>
            </div>
        </div>
            
    </div>
</template>
<script>
export default {
  methods: {},
  props: ["deleteCourse"]
};
</script>

