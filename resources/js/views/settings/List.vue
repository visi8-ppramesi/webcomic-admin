<template>
  <div style="padding: 15px;">
      <el-card style="font-size: 14px;">
          <el-tabs style="margin: 10px;" v-model="activeName" @tab-click="handleClick">
              <el-tab-pane label="Tags" name="first">
                  <el-button style="margin-top: 5px;" type="primary" icon="el-icon-circle-plus-outline" @click="addTags">Add tags</el-button>
                  <el-card v-for="(item, index) in tags" :key="'social-' + index" style="margin-top: 15px; width: 420px;">
                      <el-input
                          placeholder="Input Tags"
                          style="width: 250px;"
                          clearable
                      ></el-input>
                      <el-button @click="deleteTags" type="danger" style="margin-left: 10px;">Delete</el-button>
                  </el-card>
                  <el-button type="success" style="margin-top: 15px;">Save</el-button>
              </el-tab-pane>
              <el-tab-pane label="Prices" name="second">
                  <el-button style="margin-top: 5px;" type="primary" icon="el-icon-circle-plus-outline" @click="addPrices">Add Prices</el-button>
                  <el-card v-for="(item, index) in prices" :key="'social-' + index" style="margin-top: 15px; width: 670px;">
                      <el-input
                          placeholder="Input Price"
                          style="width: 250px;"
                          clearable
                      ></el-input>
                      -
                      <el-input
                          placeholder="Input Amount"
                          style="width: 250px;"
                          clearable
                      ></el-input>
                      <el-button @click="deletePrices" type="danger" style="margin-left: 10px;">Delete</el-button>
                  </el-card>
                  <el-button type="success" style="margin-top: 15px;">Save</el-button>
              </el-tab-pane>
              <el-tab-pane label="Social Media" name="third">
                  <el-button style="margin-top: 5px;" type="primary" icon="el-icon-circle-plus-outline" @click="addNewSocialMedia">Add Social Media</el-button>
                  <div>
                      <el-card v-for="(social, index) in social_media" :key="'social-' + index" style="margin-top: 20px; width: 500px;">
                          <div>
                              <MDinput style="width: 350px;">
                                  Social Media Name
                              </MDinput>
                              <el-input
                                  placeholder="Please input"
                                  clearable
                                  style="width: 350px; padding-top: 15px;"
                              >
                              </el-input>
                          </div>
                          <el-button @click="deleteSocialMedia" type="danger" style="margin-top: 10px;">Delete</el-button>
                      </el-card>
                      <el-button type="success" style="margin-top: 15px;">Save</el-button>
                  </div>
              </el-tab-pane>
          </el-tabs>
      </el-card>
  </div>
</template>

<script>
import MDinput from '@/components/MDinput';
export default {
  name: 'SettingsList',
  data() {
    return {
      activeName: 'first',
      social_media: [{
          name: '',
          link: '',
      }],
      prices: [{
          prices: '',
          amount: '',
      }],
      tags: [{
          tags: '',
      }],
    };
  },
  components: {
      MDinput,
  },
  methods: {
    serializeData(){

    },
    addNewSocialMedia(){
        this.social_media.push({
            name: '',
            link: '',
        });
    },
    deleteSocialMedia(index){
        this.social_media.splice(index, 1);
    },
    addPrices(){
        this.prices.push({
            prices: '',
            amount: '',
        });
    },
    deletePrices(index){
        this.prices.splice(index, 1);
    },
    addTags(){
        this.tags.push({
            tags: '',
        });
    },
    deleteTags(index){
        this.tags.splice(index, 1);
    },
    handleClick(tab, event) {
      console.log(tab, event);
    }
  }
};
</script>
