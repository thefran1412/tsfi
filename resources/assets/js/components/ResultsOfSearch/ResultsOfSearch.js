	import InfiniteLoading from 'vue-infinite-loading';

export default {
  data() {
    return {
      list: [],
      tags:[],
      totalResults:'',
      pageSearch:1,
      nameTag:''
    };
  },
  methods: {

    onInfiniteSearch() {

    	var route = 'api/search?page=' + this.pageSearch;
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
          this.totalResults = res.data.totalCount;
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
    },
    setTag(value){
        var t;

        if(this.list[0]){
           this.list[0].tag.forEach(function(v){
              if(v.tags_id == value){
                  t = v.nomTags;
              }
          });
        }

        this.nameTag = t;
    }
  },
  components: {
    InfiniteLoading,
  },
};