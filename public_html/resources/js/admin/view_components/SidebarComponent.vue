<template>
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            Navigation
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->


        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- User menu -->
            <div class="sidebar-user">
                <div class="card-body">
                    <div class="media">
                        <div class="mr-3">
                            <a href="#"><img :src="user.avatar" width="38" height="38" class="rounded-circle" alt=""></a>
                        </div>

                        <div class="media-body">
                            <div class="media-title font-weight-semibold">{{user.name}}</div>
                            <div class="font-size-xs opacity-50">
                                <i class="icon-envelop2 font-size-sm"></i> &nbsp;{{user.email}}
                            </div>
                        </div>

                        <!--<div class="ml-3 align-self-center">-->
                            <!--<a href="#" class="text-white"><i class="icon-cog3"></i></a>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
            <!-- /user menu -->


            <!-- Main navigation -->
            <div class="card card-sidebar-mobile">
                <ul class="nav nav-sidebar" data-nav-type="accordion">

                    <template v-for="menu_item in menu_items">
                        <li class="nav-item" v-if="menu_item.children.length == 0">
                            <router-link :to="'/'+menu_item.url" class="nav-link"  active-class="active" exact>
                                <i :class="menu_item.icon"></i>
                                <span>{{menu_item.display_name}}</span>
                            </router-link>
                        </li>
                        <router-link v-else :tag="'li'" :event="''" :to="'/'+menu_item.url" class="nav-item nav-item-submenu" active-class="nav-item-open nav-item-expanded">
                            <a :href="'/'+menu_item.url" class="nav-link"><i :class="menu_item.icon"></i> <span>{{menu_item.display_name}}</span></a>
                            <ul class="nav nav-group-sub" :data-submenu-title="menu_item.display_name">
                                <template v-for="first_child in menu_item.children">
                                    <li v-if="first_child.children.length == 0" class="nav-item">
                                        <router-link :to="'/'+first_child.url" class="nav-link" active-class="active">
                                            <i :class="first_child.icon"></i>
                                            <span>{{first_child.display_name}}</span>
                                        </router-link>
                                    </li>
                                    <template v-else>
                                        <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">{{first_child.display_name}}</div> <i :class="first_child.icon" :title="first_child.display_name"></i></li>
                                        <template v-for="(second_child,index) in first_child.children">
                                            <li class="nav-item">
                                                <router-link :to="'/'+second_child.url" class="nav-link" active-class="active">
                                                    <i :class="second_child.icon"></i>
                                                    <span>{{second_child.display_name}}</span>
                                                </router-link>
                                            </li>
                                            <li class="nav-item-divider" v-if="first_child.children.length == index+1"></li>
                                        </template>
                                    </template>
                                </template>
                            </ul>
                        </router-link>
                    </template>
                    <!-- /main -->

                </ul>
            </div>
            <!-- /main navigation -->

        </div>
        <!-- /sidebar content -->

    </div>
</template>

<script>
    export default{
        computed:{
            user(){
                return this.$store.getters.user;
            },
            menu_items(){
                return this.$store.getters.menu_items;
            },
            main_url(){
                return this.$store.getters.main_url;
            }
        },
        mounted(){

        }
    }
</script>