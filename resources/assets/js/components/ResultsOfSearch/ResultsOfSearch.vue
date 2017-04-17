<template>
	<div>
		<div class="content-bottom-header">
			<div class="container">
				<div class="col-md-offset-1 col-md-10">
					<div class="tags">
					      <div class="panel">
					         <h3 v-if="!this.$route.query.tag">Tags</h3>
                   <h3 v-if="this.$route.query.tag"> Buscan per el tag {{nameTag}} {{setTag(this.$route.query.tag)}}</h3>
					         <hr>
					         <a v-on:click="getResourceForTag()" v-bind:href="'#/search?tag='+ t.tags_id" v-for="t in tags" ><span class="tag-rounded">{{t.nomTags}}</span></a>
					      </div>
					</div>
				</div>
			</div>
      <div class="container">
          <div class="row">
              <div class="col-md-12 total-results">
                  <h4>Em trobat <b>{{totalResults}}</b> recurs/os amb aquets criteris de cerca...</h4>
              </div>
              <div class="col-sm-4 col-md-4 margin-post" v-for="l in list">
                  <div class="post">
                      <div class="post-img-content">
                          <img :src="l.fotoResum ? '/img/image/'+ l.fotoResum : '/img/image/tsfi-default-image.png'" class="img-responsive" />
                          <!-- <img :src="user.photo ? user.photo.file : '/images/default-profile.png'"></td> -->
                          <span class="post-title">
                            <b><a v-bind:href="'#/resource/'+ l.recurs_id">{{l.titolRecurs}}</a></b><br />
                              <b>{{l.subTitol}}</b></span>
                      </div>
                      <div class="content">
                          <div class="author">
                              By <b>{{l.creatPer}}</b> |
                              <time datetime="2014-01-20">{{l.dataPublicacio}}</time>
                          </div>
                          <div class="description-resource">
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

<script src="./ResultsOfSearch.js" ></script>