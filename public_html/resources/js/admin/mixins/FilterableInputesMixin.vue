<script>
    import {mapMutations,mapGetters} from 'vuex'
    export default {
        data(){
            return{
                query_1:null,
                query_2:null,
                id:null
            }
        },
        props:['index'],
        computed:{
            ...mapGetters('filterable_table',['filterCandidates','updating']),
            filterCandidate(){
                return this.filterCandidates[this.index];
            }
        },
        watch:{
            query_1(value){
                this.query_1=value;
                if(this.filterCandidate.query_1!==value){
                    this.filterCandidate.query_1=value;
                    this.setFilterCandidate({index:this.index,data:this.filterCandidate})
                }

            },
            query_2(value){
                this.query_2=value;
                if(this.filterCandidate.query_2!==value){
                    this.filterCandidate.query_2=value;
                    this.setFilterCandidate({index:this.index,data:this.filterCandidate})
                }

            }
        },
        methods:{
            ...mapMutations('filterable_table',['setFilterCandidate']),
            updateInput({key,value}){
                this[key]=value;
                this.filterCandidate[key]=value;
                this.setFilterCandidate({index:this.index,data:this.filterCandidate})
            },
        },
        created(){
            this.id=this._uid;
            this.query_1=this.filterCandidate.query_1;
            this.query_2=this.filterCandidate.query_2;
        },
        mounted(){
//            console.log(this.filterCandidate,this.query_1);
        },
        destroyed(){
//            this.query_1=null;
//            this.query_2=null;
        }
    }
</script>