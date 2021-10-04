<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input v-model="query.keyword" :placeholder="$t('table.keyword')" style="width: 200px;" class="filter-item" @keyup.enter.native="handleFilter" />
      <el-button class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter">
        {{ $t('table.search') }}
      </el-button>
      <el-button class="filter-item" style="margin-left: 10px;" type="primary" icon="el-icon-plus" @click="handleCreate">
        {{ $t('table.add') }}
      </el-button>
    </div>
    <el-table v-loading="listLoading" :data="list" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="ID" width="80">
        <template slot-scope="scope">
          <span>{{ scope.row.id }}</span>
        </template>
      </el-table-column>

      <el-table-column min-width="180px" label="Name">
        <template slot-scope="{row}">
          <span>{{ row.name }}</span>
        </template>
      </el-table-column>

      <el-table-column min-width="180px" align="center" label="Tokens Received">
        <template slot-scope="{row}">
          <span class="link-type" @click="openTransactionsModal(row.id)">{{ Math.floor(row.total_tokens) }}</span>
        </template>
      </el-table-column>

      <el-table-column width="180px" align="center" label="Email">
        <template slot-scope="scope">
          <span>{{ scope.row.email }}</span>
        </template>
      </el-table-column>

      <el-table-column width="180px" align="center" label="Description">
        <template slot-scope="scope">
          <span>{{ scope.row.description }}</span>
        </template>
      </el-table-column>

      <el-table-column align="center" label="Actions" width="200">
        <template slot-scope="scope">
          <router-link :to="'/author/edit/'+scope.row.id">
            <el-button type="primary" size="small" icon="el-icon-edit">
              Edit
            </el-button>
          </router-link>
          <el-button type="primary" size="small" icon="el-icon-delete" @click="deleteItem(scope.row.id)">
            Delete
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <pagination v-show="total>0" :total="total" :page.sync="listQuery.page" :limit.sync="listQuery.limit" @pagination="getList" />
  </div>
</template>

<script>
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import Resource from '@/api/resource';
const authorResource = new Resource('authors');

export default {
  name: 'AuthorList',
  components: { Pagination },
  data() {
    return {
      query: {
        keyword: '',
      },
      list: null,
      total: 0,
      listLoading: true,
      listQuery: {
        page: 1,
        limit: 20,
        paginate: 20,
        with: 'tokenTransactions',
      },
    };
  },
  created() {
    this.getList();
  },
  methods: {
    openTransactionsModal(){

    },
    deleteItem(id){
      authorResource.destroy(id)
        .then((response) => {
          this.getList();
        });
    },
    async getList() {
      this.listLoading = true;
      const { data } = await authorResource.list(this.listQuery);
      console.log(data);
      this.list = data.items;
      this.total = data.total;
      this.listLoading = false;
    },
    handleFilter(){
      this.listQuery['search'] = this.query.keyword;
      this.getList();
    },
    handleCreate(){
      this.$router.push('/author/create');
    },
  },
};
</script>

<style scoped>
.edit-input {
  padding-right: 100px;
}
.cancel-btn {
  position: absolute;
  right: 15px;
  top: 10px;
}
</style>
