<template>
  <div>
    <el-card>
      {{ commentObject }}
    </el-card>
  </div>
</template>

<script>
export default {
  name: 'Comment',
  props: {
    commentObject: {
      type: Object,
      default: () => {},
    },
  },
};
</script>
