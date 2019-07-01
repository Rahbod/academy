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

const RegisterCourse = resolve => {
    require.ensure(['../views/courses/Register.vue'], () => {
        resolve(require('../views/courses/Register.vue'))
    })
};


export default new VueRouter ({
    routes:[
        {
            component: SingleView,
            path: '/profile',
            meta: {resource: 'profile',action: 'show'},
        },

        {
            component: RouterViewApp,
            path: '/courses',
            meta: { resource: 'courses' },
            children:[
                {
                    component: ResourceView,
                    path: '/',
                    name: 'courses-resource-view',
                },
                {
                    component: ListView,
                    path: 'my_classrooms',
                    name: 'courses-my-classrooms',
                    meta: { action: 'myClassrooms' },
                },

            ]
        },
        {
            component: RouterViewApp,
            path: '/translate_requests',
            meta: {resource: 'translate_requests'},
            children: [
                {
                    component: ResourceView,
                    path: '/',
                    name: 'translate_requests-resource-view',
                },
                {
                    component: ListView,
                    path: 'list-view',
                    name: 'translate_requests-list-view',
                    meta: {action: 'listView'},
                },
                {
                    component: ListView,
                    path: 'unverified_requests',
                    name: 'translate_requests-unverified_requests',
                    meta: {action: 'unverifiedRequests'},
                },
                {
                    component: ListView,
                    path: 'rejected_requests',
                    name: 'translate_requests-rejected_requests',
                    meta: {action: 'rejectedRequests'},
                },
                {
                    component: ListView,
                    path: 'awaiting_payment_requests',
                    name: 'translate_requests-awaiting_payment_requests',
                    meta: {action: 'awaitingPaymentRequests'},
                },
                {
                    component: ListView,
                    path: 'paid_requests',
                    name: 'translate_requests-paid_requests',
                    meta: {action: 'paidRequests'},
                },
                {
                    component: ListView,
                    path: 'translated_requests',
                    name: 'translate_requests-translated_requests',
                    meta: {action: 'translatedRequests'},
                },
                {
                    component: FormView,
                    path: 'create',
                    name: 'translate_requests-create',
                    meta: {action: 'create'},
                },
                {
                    component: ShowView,
                    path: ':id',
                    name: 'translate_requests-show',
                },
            ]
        },

    ]
});