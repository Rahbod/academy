<template>
    <div>
        <navbar></navbar>
        <page_container>
            <sidebar slot="sidebar"></sidebar>

            <!-- Main content -->
            <header_app slot="header"></header_app>
            <router-view slot="router-view"></router-view>
            <!-- /main content -->

            <footer_app slot="footer"></footer_app>
        </page_container>
    </div>
</template>

<script>
    import sidebar from './SidebarComponent.vue'
    import header_app from './Header.vue'
    import navbar from './NavbarComponent.vue';
    import page_container from './PageContainer.vue';
    import footer_app from './PageFooter.vue';

    export default{
        props: ['user','direction','menu','department','lang','lang_resource'],
        components:{
            navbar,
            page_container,
            sidebar,
            footer_app,
            header_app
        },
        methods:{
            setBaseUrl(){
                let url_tag = document.head.querySelector('meta[name="app_url"]');
                if (url_tag) {
                    let url = url_tag.content;
                    this.$store.commit('setBaseUrl', url);
                } else {
                    console.error('base url not found');
                }
            }
        },
        created: function () {
            this.$i18n.i18next.changeLanguage(this.lang);
            this.$i18n.i18next.setDefaultNamespace('main');
            this.$i18n.i18next.addResourceBundle(this.lang, 'main', this.lang_resource);
        },
        mounted(){
            App.initSidebars();
        },
        beforeMount(){
            this.setBaseUrl();
            this.$store.commit('setDepartment', this.department);
            this.$store.commit('setAuthUser', this.user);
            this.$store.commit('setMenuItems', this.menu);
            this.$store.commit('setLang', this.lang);
            this.$store.commit('setDirection', this.direction);
        }

    }
</script>

<style>
    .fade-enter{
        opacity: 0;
    }
    .fade-enter-active{
        transition: opacity 0.5s;
        /*-webkit-animation: slide-in 1s ease-out forwards;*/
        /*-o-animation: slide-in 1s ease-out forwards;*/
        /*animation: slide-in 1s ease-out forwards;*/
    }
    .fade-leave{
    }
    .fade-leave-active{
        transition: opacity 0.5s;
        opacity: 0;
        /*-webkit-animation: slide-out 1s ease-out forwards;*/
        /*-o-animation: slide-out 1s ease-out forwards;*/
        /*animation: slide-out 1s ease-out forwards;*/
    }
</style>