<template>
    <div id="appVue">
        <header>
            <div class="header-top-item header-search-container">

                <div class="row">
                    <div class="logo" >
                        <li v-on:click="returnHomePage('teacher')" v-if="type === 'teacher'">
                                <span class="title">TSFI</span><span class="role">Orientadors i Professors</span>
                        </li>
                        
                        <li  v-on:click="returnHomePage('student')" v-if="type === 'student'">
                                <span class="title">TSFI</span><span class="role">Estudiants i Pares</span>
                        </li>
                    </div>
                    <div class="input">
                        <div class="selects">
                            <multiselect @select="dispatchAction" v-model="category" selected-label="Seleccionada" track-by="codiCategoria" label="codiCategoria" placeholder="Selecciona una categoria" :options="categories" :searchable="false" :allow-empty="false"></multiselect>
                        </div>
                    </div>
                    <div class="input" v-show="noShow">
                        <multiselect v-model="entity" :options="entities" :custom-label="nameWithLang" placeholder="Selecciona una entitat" label="codiCategoria" track-by="codiCategoria"  :allow-empty="false"></multiselect>
                    </div>
                    <div class="input search">
                            <form @submit.prevent="actionToSearch" class="site-search" >
                              <div id="site-search-container">
                                <input v-model="search" type="search" id="site-search" placeholder="Cerca el recurs...">
                              </div>
                              <button tabindex="2" type="submit">
                                    <span class="a11y-only">Search</span>
                                    <svg class="icon-search" viewBox="0 0 34 34" fill="none" stroke="currentColor">
                                        <ellipse stroke-width="3" cx="16" cy="15" rx="12" ry="12"></ellipse>
                                        <path d="M26 26 l 8 8" stroke-width="3" stroke-linecap="square"></path>
                                    </svg>
                               </button>
                            </form>
                    </div>

                    <div class="user-type">
                        <li class="search_icon" v-on:click="searchMobile()" hidden>
                           <i class="fa fa-search" title="Buscar"> 
                        </li>
                        <li v-on:click="typeUser('Envians un recurs')">
                            <router-link :to="{name: 'enviar-recurs'}">
                                <i class="fa fa-cloud-upload" aria-hidden="true" title="Enviar recurs"></i>
                            </router-link>
                        </li>
                        <li v-on:click="changeTypeUser('teacher')" v-if="type === 'student'">
                                <i class="fa fa-user" aria-hidden="true" title="Canviar perfil"></i>
                        </li>
                        <li  v-on:click="changeTypeUser('student')" v-if="type === 'teacher'">
                                <i class="fa fa-user" aria-hidden="true" title="Canviar perfil"></i>
                        </li>
                    </div>
                </div>   
            </div>
            <div class="searchMobile" v-if="mobile === true">
                <div class="input mobile">
                    <form @submit.prevent="actionToSearch" class="site-search" >
                        <div id="site-search-container">
                            <input v-model="search" type="search" id="site-search" placeholder="Cerca el recurs...">
                        </div>
                        <button tabindex="2" type="submit">
                            <span class="a11y-only">Search</span>
                            <svg class="icon-search" viewBox="0 0 34 34" fill="none" stroke="currentColor">
                                <ellipse stroke-width="3" cx="16" cy="15" rx="12" ry="12"></ellipse>
                                <path d="M26 26 l 8 8" stroke-width="3" stroke-linecap="square"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </header>
        <div class="container">
            <router-view></router-view>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footertitle">TSFI</div>
                    <div class="col-md-4 network">
                        <h4>Segueix-nos a :</h4>
                        <div class="social">
                            <a href="#"><i class="fa fa-twitter"></a>
                            <a href="#"><i class="fa fa-facebook"></a>
                            <a href="#"><i class="fa fa-instagram"></a>
                        </div>
                    </div>
                    <div class="col-md-4 contact">
                        <h4>Contacta amb nosaltres:</h4>
                        <span>Número de Telefón: 93 333 33 33</span>
                        <span>Correu Electrónic: 
                            <a href="mailto:info@tsfi.com">info@tsfi.com</a>
                        </span>
                    </div>
                </div>
                <div class="row entitats">
                    <div class="col-md-12">
                        <h4>Entitats Col·laboradores :</h4>
                    </div>
                    <div class="col-md-4" v-for="e in entities">
                        <a v-bind:href="e.link" target="_blank">{{ e.nomEntitat }}</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script src="./MenuAndFooter.js" ></script>