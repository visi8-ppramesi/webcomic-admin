<template>
  <div>
    <comment :comment-object="comment" />
    <div v-if="comment.all_children_with_commenter && comment.all_children_with_commenter.length > 0">
      <comment v-for="(innerComment, idx) in comment.all_children_with_commenter" :key="idx" :comment-object="innerComment" />
    </div>
  </div>
</template>

<script>
import Comment from './Comment';
export default {
  name: 'Comments',
  components: { Comment },
  props: {
    comment: {
      type: Object,
      default: () => {},
    },
  },
};
</script>
