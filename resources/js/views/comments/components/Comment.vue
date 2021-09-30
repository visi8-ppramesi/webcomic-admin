<template>
  <div>
    <el-card style="margin-top: 20px;">
      <div style="float: right; margin-top:15px;">{{ commentObject.created_at | dateFormatter }}</div>
      <div style="margin-top: 10px; font-size: 18px;">
        {{ commentObject.commenter.name }}
      </div>
      <div style="margin-top: 30px;">
        <p class="text-sm" v-html="commentObject.comment" />
      </div>
      <el-button style="margin-left: 80%;" type="danger" size="small" icon="el-icon-delete" @click="deleteItem(commentObject.id)">
        Delete
      </el-button>
    </el-card>
  </div>
</template>

<script>
// import Resource from '@/api/resource';
// const commentResource = new Resource('comments');
export default {
  name: 'Comment',
  filters: {
    dateFormatter(date) {
      return (new Date(date)).toLocaleDateString('id-ID');
    },
  },
  props: {
    commentObject: {
      type: Object,
      default: () => {},
    },
  },
  methods: {
    deleteItem(id){

    },
  },
};
</script>
