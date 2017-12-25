
/**
 * Global components
 */

Vue.component('ajax-spinner', require('./components/AjaxSpinner.vue'));
Vue.component('image-manager', require('./components/ImageManager.vue'));
Vue.component('forgot-password', require('./components/ForgotPassword.vue'));

Vue.component('settings-workbench', require('./components/settings/SettingsWorkbench.vue'));
Vue.component('settings-navbar', require('./components/settings/navbar/SettingsNavbar.vue'));

Vue.component('cms-workbench', require('./components/cms/CmsWorkbench.vue'));
Vue.component('cms-navbar', require('./components/cms/navbar/CmsNavbar.vue'));

Vue.component('dashboard-workbench', require('./components/dashboard/DashboardWorkbench.vue'));
Vue.component('dashboard-navbar', require('./components/dashboard/navbar/DashboardNavbar.vue'));

Vue.component('projects', require('./components/frontend/Projects.vue'));
Vue.component('project-item', require('./components/frontend/ProjectItem.vue'));


/**
 * Global event hub
 */

const eventHub = new Vue();

Vue.mixin({
    data: function () {
        return {
        	eventHub: eventHub
        }
    }
});


/**
 * lodash in templates
 */

Vue.prototype._ = _;


import Vue2TouchEvents from 'vue2-touch-events';
 
Vue.use(Vue2TouchEvents);