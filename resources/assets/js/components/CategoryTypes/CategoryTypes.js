import InfiniteLoading from 'vue-infinite-loading';

  export default{
    data(){
      return{
          loading:false,
          correctCategory:'asda',
          recursos:[],
          typeUserUrl: this.$route.params.typeuser,
          typeCategory:this.$route.params.category,
          num:0
        }

    },
    created(){
      
    },
    mounted(){

    },
    methods:{
          onInfinite(){
                this.$parent.onInfinite(this.$route.params.typeuser, this.$route.params.category);
          },
          getCategory: function(value){
            this.$root.recursos = [];
            var cap = value.charAt(0).toUpperCase() + value.slice(1);
            this.$router.push('/'+this.typeUserUrl + '/' + value);
            this.$nextTick(() => {
                this.$refs.infiniteLoading.$emit('$InfiniteLoading:reset');
                this.$root.page = 1;
            });
            this.$parent.animationScroll();
            this.$root.category = { codiCategoria: cap, nomCategoria: value };
          }
         },
    components: {
            InfiniteLoading
    }
  }