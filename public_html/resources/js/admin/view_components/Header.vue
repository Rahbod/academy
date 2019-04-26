<template>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4>
                    <router-link v-if="routes.length>1" :tag="'i'" :to="routes[routes.length-2].path" style="cursor: pointer;"
                                 class=" mr-2" :class="[direction ==='ltr'?'icon-arrow-left52':'icon-arrow-right6']"></router-link>
                    <router-link v-else :tag="'i'" :to="'/'" style="cursor: pointer;"
                                 class=" mr-2" :class="[direction ==='ltr'?'icon-arrow-left52':'icon-arrow-right6']"></router-link>
                    <span class="font-weight-semibold"  v-if="routes.length>0">{{routes[routes.length - 1].name}}</span>
                </h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none">
                <div class="heading-btn-group">
                    <router-link :to="'/profile'" class="btn btn-link btn-float has-text"><i class="icon-user-plus text-primary"></i><span>{{$t('attributes.my_profile')}}</span></router-link>
                    <!--<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>-->
                    <!--<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>-->
                </div>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <router-link to="/" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{$t('attributes.home')}}
                    </router-link>

                    <router-link v-if="!loading && !route.active" :key="route.path" v-for="route in routes" :to="route.path"
                                 class="breadcrumb-item">{{route.name}}
                    </router-link>
                    <router-link v-if="!loading && route.active" :event="''" :key="route.path" v-for="route in routes" :to="route.path"
                                 class="breadcrumb-item active">{{route.name}}
                    </router-link>
                    <!--<a href="#" class="breadcrumb-item">Link</a>-->
                    <!--<span class="breadcrumb-item active">Current</span>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        computed: {
            ...mapGetters(['loading', 'resource', 'base_resource', 'action', 'menu_items', 'flat_menu_items','direction']),
            routes() {
                let routes = [];
                let prefix = '';
                if (this.base_resource !== null) {
                    prefix += '/' + this.base_resource;
                    if (this.flat_menu_items[prefix] !== undefined) {
                        routes.push(
                            {
                                name: this.flat_menu_items[prefix],
                                path: prefix,
                                active: false
                            }
                        );
                    }

                }
                if (this.resource !== null) {
                    prefix += '/' + this.resource;
                    if (this.flat_menu_items[prefix] !== undefined) {
                        routes.push(
                            {
                                name: this.flat_menu_items[prefix],
                                path: prefix,
                                active: this.action === undefined ? true : false
                            }
                        )
                    }

                }

                if (this.action !== undefined && this.action !== null) {

                    switch (this.action) {
                        case 'listView':
                            prefix += '/list-view';
                            if (this.resource === 'comments') {
                                prefix = '/'+this.base_resource+'/comments/list-view'
                            }
                            break;
                        case 'updateSettings':
                            prefix += '/settings/form';
                            break;
                        case 'updateAllSettings':
                            prefix += '/update_all_settings';
                            break;
                        case 'showFileManager':
                            prefix += '/file_manager/index';
                            break;
                        case 'showFileManager':
                            prefix += '/file_manager/index';
                            break;
                        default:
                            prefix += '/' + this.action
                    }
                    if(this.resource !== 'profile'){
                        routes.push(
                            {
                                name: this.flat_menu_items[prefix],
                                path: prefix,
                                active: true
                            }
                        );
                    }

                }
                return routes;
            },
        },
        methods: {}
    }
</script>