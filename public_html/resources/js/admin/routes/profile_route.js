import VueRouter from 'vue-router';

import RouterViewApp from '../view_components/RouterViewApp.vue';
import NestedRouterViewApp from '../view_components/NestedRouterViewApp.vue';
const dashboard = resolve => require(['../views/Dashboard'], resolve);

const ListView=resolve=>{
    require.ensure(['../views/ListView.vue'],()=>{
        resolve(require('../views/ListView.vue'))
    })
};
const FormView=resolve=>{
    require.ensure(['../views/FormView.vue'],()=>{
        resolve(require('../views/FormView.vue'))
    })
};
const ShowView=resolve=>{
    require.ensure(['../views/ShowView.vue'],()=>{
        resolve(require('../views/ShowView.vue'))
    })
};
const ResourceView = resolve => {
    require.ensure(['../views/ResourceView.vue'], () => {
        resolve(require('../views/ResourceView.vue'))
    })
};
const SingleView = resolve => {
    require.ensure(['../views/SingleView.vue'], () => {
        resolve(require('../views/SingleView.vue'))
    })
};


export default new VueRouter ({
    routes:[
        {
            component: SingleView,
            path: '/profile',
            meta: {resource: 'profile',action: 'show'},
        },


    ]
});