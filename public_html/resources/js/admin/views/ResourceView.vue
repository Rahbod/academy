<template>
    <!--<div class="row">-->
        <!--<div class="col-lg-4" v-for="menu_item in current_menu.children">-->
            <!--<div class="card">-->
                <!--<div class="card-body text-center">-->
                    <!--<i class=" icon-2x text-blue border-blue border-3 rounded-round p-3 mb-3 mt-1" :class="[menu_item.icon !== null ?menu_item.icon:'icon-lifebuoy']"></i>-->
                    <!--<h5 class="card-title" v-text="menu_item.display_name"></h5>-->
                    <!--<router-link :to="'/'+menu_item.url" tag="button" class="btn bg-blue"> {{$t('actions.show')}}</router-link>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title" v-if="current_menu.display_name !== undefined"
                v-text="current_menu.display_name"></h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="fullscreen"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-4" v-for="menu_item in current_menu.children">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class=" icon-2x text-blue border-blue border-3 rounded-round p-3 mb-3 mt-1" :class="[menu_item.icon !== null ?menu_item.icon:'icon-lifebuoy']"></i>
                            <h5 class="card-title" v-text="menu_item.display_name"></h5>
                            <router-link :to="'/'+menu_item.url" tag="button" class="btn bg-blue"> {{$t('actions.show')}}</router-link>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        computed: {
            ...mapGetters(['loading', 'resource', 'base_resource', 'action', 'menu_items', 'flat_menu_items']),
            current_menu() {
                let current_menu = {};
                this.menu_items.forEach((menu_item) => {
                    if (this.$route.path === '/' + menu_item.url) {
                        current_menu = menu_item;
                    }
                    if (menu_item.children !== undefined) {
                        menu_item.children.forEach((menu_item) => {
                            if (this.$route.path === '/' + menu_item.url) {
                                current_menu = menu_item;
                            }
                            if (menu_item.children !== undefined) {
                                menu_item.children.forEach((menu_item) => {
                                    if (this.$route.path === '/' + menu_item.url) {
                                        current_menu = menu_item;
                                    }
                                });

                            }
                        })
                    }
                });

                return current_menu;
            }
        },
        mounted() {
            console.log(this.$route.path)
        }
    }
</script>