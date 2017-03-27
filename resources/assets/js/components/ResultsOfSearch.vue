<template>
	<div>
		<div class="content-bottom-header">
			<div class="container">
				<div class="col-md-offset-2 col-md-8">
					<div class="tags">
					      <div class="panel">
					         <h3>Tags</h3>
					         <hr>
					         <a v-on:click="getResourceForTag()" v-bind:href="'#/search?tag='+ t.tags_id" v-for="t in tags" ><span class="tag-rounded">{{t.nomTags}}</span></a>
					      </div>
					</div>
				</div>
			</div>
      <div class="container">
          <div class="row">
              <div class="col-sm-4 col-md-4 margin-post" v-for="l in list">
                  <div class="post">
                      <div class="post-img-content">
                          <img :src="'/images/'+ l.fotoResum" class="img-responsive" />
                          <span class="post-title">
                            <b><a v-bind:href="'#/resource/'+ l.recurs_id">{{l.titolRecurs}}</a></b><br />
                              <b>{{l.subTitol}}</b></span>
                      </div>
                      <div class="content">
                          <div class="author">
                              By <b>{{l.creatPer}}</b> |
                              <time datetime="2014-01-20">{{l.dataPublicacio}}</time>
                          </div>
                          <div>
                              <span>{{l.descBreu}}</span>
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
      var t;
      var d;

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

          this.list.forEach(function(data){
              if(data.dataPublicacio){
                  t = data.dataPublicacio.split(/[- :]/);
                  d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
                  data.dataPublicacio = d.toLocaleDateString('en-GB');
              }
          });

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
    getResourceForTag: function(value){
            this.list = [];
            this.$nextTick(() => {
                this.$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                this.pageSearch = 1;
            });
            this.$parent.animationScroll();
          }
  },
  components: {
    InfiniteLoading,
  },
};
</script>