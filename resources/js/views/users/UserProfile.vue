<template>
  <div class="app-container">
    <el-form v-if="user" :model="user">
      <el-row :gutter="20">
        <el-col :span="6">
          <user-card :user="user" />
          <user-bio />
        </el-col>
        <el-col :span="18">
          <user-activity :user="user" />
        </el-col>
      </el-row>
    </el-form>
  </div>
</template>

<script>
import Resource from '@/api/resource';
import UserBio from './components/UserBio';
import UserCard from './components/UserCard';
import UserActivity from './components/UserActivity';
import TokenResource from '@/api/tokenTransaction';
const tokenResource = new TokenResource();

const userResource = new Resource('users');
export default {
  name: 'EditUser',
  components: { UserBio, UserCard, UserActivity },
  data() {
    return {
      transactions: [],
      user: {},
      transactionQuery: {
        page: 1,
        limit: 20,
        paginate: 20,
        sort_by_desc: 'created_at',
        with: 'transactionable.comic',
      },
    };
  },
  watch: {
    '$route': 'getUser',
  },
  created() {
    const id = this.$route.params && this.$route.params.id;
    const currentUserId = this.$store.getters.userId;
    if (id === currentUserId) {
      this.$router.push('/profile/edit');
      return;
    }
    this.getUser(id);
    this.getTransactions(id);
  },
  methods: {
    async getTransactions(id){
      console.log('asdfasdf');
      this.transactionQuery.where_user_id = id;
      const { data } = await tokenResource.list(this.transactionQuery);
      this.transactions = data;
      return data;
    },
    async getUser(id) {
      const { data } = await userResource.get(id);
      this.user = data;
      return data;
    },
  },
};
</script>
