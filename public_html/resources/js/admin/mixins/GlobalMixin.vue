<script>
    import {mapGetters} from 'vuex'
    export default {

        computed:{
            ...mapGetters(['actions'])
        },
        methods:{
            hasAction(action_name,resource_name){
                if(resource_name===undefined)
                {
                    if(this.actions[action_name]===1)
                    {
                        return true;
                    }
                    return false;
                }
                else {

                    if(this.actions[resource_name]!== undefined && this.actions[resource_name][action_name]===1)
                    {
                        return true;
                    }
                    return false;
                }
            },
        },
        mounted(){

        },
        destroyed(){

        }
    }
</script>