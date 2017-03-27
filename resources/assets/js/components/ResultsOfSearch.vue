<template>
	<div>
		<div class="content-bottom-header">
			<div class="container">
				<div class="col-md-offset-2 col-md-8">
					<div class="tags">
					      <div class="panel">
					         <h3>Tags</h3>
					         <hr>
					         <a v-bind:href="'#/search?tag='+ t.tags_id" v-for="t in tags" ><span class="tag-rounded">{{t.nomTags}}</span></a>
					      </div>
					</div>
				</div>
			</div>
			<infinite-loading :on-infinite="onInfiniteSearch" ref="infiniteLoading">
		    <span slot="no-more">
		      No hi han més recursos amb aquets resultats.
		    </span>
		    <span slot="no-results">
			  No em trobat cap resultat amb aquesta paraula.
			</span>
		  </infinite-loading>
		</div>
	</div>
</template>

<script>

	import InfiniteLoading from 'vue-infinite-loading';

export default {
  data() {
    return {
      list: [],
      tags:[],
      pageSearch:1
    };
  },
  methods: {

    onInfiniteSearch() {

    	var route = '../api/search?page=' + this.pageSearch;

      this.$http.get(route, {
        params: {
          name: this.$route.query.name,
          tag: this.$route.query.tag,
        },
      }).then((res) => {
      	if(this.pageSearch === 1){
      		this.tags = res.data.tags;
      	}
      	
        if (res.data.resources.length) {
          this.list = this.list.concat(res.data.resources);
          this.$refs.infiniteLoading.$emit('$InfiniteLoading:loaded');
          if (this.list.length / 20 === 10) {
            this.$refs.infiniteLoading.$emit('$InfiniteLoading:complete');
          }
          this.pageSearch++;
        } else {
          this.$refs.infiniteLoading.$emit('$InfiniteLoading:complete');
        }
      });
    },
  },
  components: {
    InfiniteLoading,
  },
};
</script>