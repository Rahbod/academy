<script>
    import {mapActions,mapMutations,mapGetters} from 'vuex'
    export default {
        computed:{
            ...mapGetters(['loading']),
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
            ...mapActions(['getResourceInfo']),
            ...mapMutations(['setAction','setResource','setBaseResource','setUseBaseResource','setEl','setLoading']),
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
                this.setLoading(true);
                this.setEl('.content-wrapper');
                this.setResource(this.resource);
                this.setAction(this.action);
                this.setBaseResource(this.baseResource);
                this.setUseBaseResource(this.useBaseResource);
                this.getResourceInfo()
                    .then(response=>{
                        if(response.data.lang_resource !== undefined){
                            this.$i18n.i18next.addResourceBundle(this.$store.getters.lang, this.resource, response.data.lang_resource);
                            this.setLoading(false);
                        }
                    });
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