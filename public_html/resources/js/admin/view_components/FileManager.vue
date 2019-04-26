<template>
    <div class="panel">
        <iframe :src="url" style="width: 100%;"  frameborder="0" scrolling="no" v-on:load="resizeIframe"></iframe>
    </div>



</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        computed:{
            ...mapGetters(['base_resource_url','resource']),
           url(){
                return this.base_resource_url+"/file_manager/index"
           }
        },
        methods:{
            resizeIframe(event) {
                let obj=event.target;
                obj.style.height = (obj.contentWindow.document.body.scrollHeight+10) + 'px';
            }
        }
    }
</script>