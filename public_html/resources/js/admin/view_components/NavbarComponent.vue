<template>
    <div class="navbar navbar-expand-md navbar-dark">
        <div class="navbar-brand">
            <a href="./" class="d-inline-block" style="font-size: 1rem;color: #fff;">
                ProfsAdvice
                <!--<img src="/assets/admin/global_assets/images/logo_light.png" alt="">-->
            </a>
        </div>

        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown language-switch">
                    <a class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <img :src="'/assets/admin/global_assets/images/lang/'+lang+'.png'" class="img-flag mr-2" alt="">
                        {{lang_label}}
                    </a>
                    <div class="dropdown-menu">
                        <a @click.prervent="changeLang('fa')" class="dropdown-item" :class="[lang == 'fa' ? 'active' : '']">
                            <img src="/assets/admin/global_assets/images/lang/fa.png" class="img-flag" alt="">
                            فارسی
                        </a>
                        <a @click.prervent="changeLang('en')" class="dropdown-item" :class="[lang == 'en' ? 'active' : '']">
                            <img src="/assets/admin/global_assets/images/lang/en.png" class="img-flag" alt="">
                            English
                        </a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <img :src="user.avatar" class="rounded-circle" alt="">
                        <span>{{user.name}}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <router-link :to="'/profile'" class="dropdown-item"><i class="icon-user-plus"></i>
                            {{$t('attributes.my_profile')}}
                        </router-link>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" @click.prevent="logout()"><i class="icon-switch2"></i>
                            {{$t('actions.logout')}}</a>
                    </div>
                </li>
            </ul>
        </div>
        <form id="logout-form" :action="logout_url" method="post" hidden>
            <input name="_token" type="hidden" :value="token">
        </form>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        computed: {
            ...mapGetters(['user', 'lang','base_url','department']),
            logout_url() {
                return this.$store.getters.main_url + '/logout';
            },
            token() {
                return document.head.querySelector('meta[name="csrf-token"]').content;
            },
            lang_label(){
                switch (this.lang){
                    case 'fa':
                        return 'فارسی';
                        break;
                    case 'ar':
                        return 'العربیه';
                        break;
                    case 'en':
                        return 'English';
                        break;
                    default:
                        return 'فارسی';
                        break;
                }
            }
        },
        methods: {
            logout() {
                $('#logout-form').submit();
            },
            changeLang(lang){
                let route=this.base_url+'/'+lang+'/'+this.department+'#'+this.$route.path;
                window.location=route;
            }
        },
    }
</script>