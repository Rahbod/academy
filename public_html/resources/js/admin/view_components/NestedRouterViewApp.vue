<template>
    <router-view>
        <router-view></router-view>
    </router-view>

</template>

<script>
    import {mapMutations} from 'vuex'
    export default {
        computed:{
            resource(){
                let routes=this.$route.matched;
                let resource=null;
                routes.forEach(route=>{
                    if(route.meta.resource !== undefined){
                        resource=route.meta.resource;
                    }
                });
                return resource;
            },
            action(){
                let routes=this.$route.matched;
                let action=null;
                routes.forEach(route=>{
                    if(route.meta.action !== undefined){
                        action=route.meta.action;
                    }
                });
                return action;
            },
            baseResource(){
                let routes=this.$route.matched;
                let base_resource=null;
                routes.forEach(route=>{
                    if(route.meta.base_resource !== undefined){
                        base_resource=route.meta.base_resource;
                    }
                });
                return base_resource;
            },
            useBaseResource(){
                let use_base_resource=false;
                if(this.$route.meta.use_base_resource !== undefined && this.$route.meta.use_base_resource === true){
                    use_base_resource =this.$route.meta.use_base_resource;
                }
                return use_base_resource;
            }
        },

        methods:{
            ...mapMutations(['setAction','setResource','setBaseResource','setEl']),
            getResource(route) {
                let routes = route.matched;
                let resource = null;
                routes.forEach(route => {
                    if (route.meta.resource !== undefined) {
                        resource = route.meta.resource;
                    }
                });
                return resource;
            },
            initRouter(){

                this.setEl('.content-wrapper');
                this.setResource(this.resource);
                this.setAction(this.action);
                this.setBaseResource(this.baseResource);
            }
        },
        created(){
            this.initRouter();
//
        },
        watch: {
            '$route' (to, from) {
                if (this.getResource(to) !== this.getResource(from)) {
                    this.initRouter();
                }
                this.setAction(this.action);
            }
        },
    }
</script>