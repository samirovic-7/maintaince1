<template>
  <div class="card text-center m-3">
    <h3 class="card-header">Vue.js Pagination Tutorial & Example</h3>
    <div class="card-body">
      <div v-for="item in pageOfItems" :key="item.id">{{item.name}}</div>
    </div>
    <div class="card-footer pb-0 pt-3">
      <jw-pagination :maxPages="15" :items="exampleItems" @changePage="onChangePage"></jw-pagination>
    </div>
  </div>
</template>


<script>
import JwPagination from 'jw-vue-pagination'
import { Vue } from "vue-class-component"

Vue.component = function (jwPagination, JwPagination) {

}
Vue.component('jw-pagination', JwPagination)

const exampleItems = [...Array(150).keys()].map(i => ({ id: (i+1), name: 'Item ' + (i+1) }))

export default {
  // eslint-disable-next-line vue/component-api-style
  data() {
    return {
      exampleItems,
      pageOfItems: [],
    }
  },
  // eslint-disable-next-line vue/component-api-style
  methods: {
    onChangePage(pageOfItems) {
      // update page of items
      this.pageOfItems = pageOfItems
    },
  },
}
</script>
