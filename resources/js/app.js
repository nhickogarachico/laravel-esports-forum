/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('tags-input', require('./components/TagsInput.vue').default);
Vue.component('add-post-form', require('./components/AddPostForm.vue').default);
Vue.component('edit-post-form', require('./components/EditPostForm.vue').default);
Vue.component('post-settings-dropdown', require('./components/PostSettingsDropdown.vue').default);
Vue.component('delete-post-confirmation', require('./components/DeletePostConfirmation.vue').default);
Vue.component('like-button', require('./components/LikeButton.vue').default);
Vue.component('add-tag-button', require('./components/AddTagButton.vue').default);
Vue.component('add-tag-modal', require('./components/AddTagModal.vue').default);
Vue.component('edit-tag-modal', require('./components/EditTagModal.vue').default);
Vue.component('edit-tag-button', require('./components/EditTagButton.vue').default);
Vue.component('delete-tag-button', require('./components/DeleteTagButton.vue').default);
Vue.component('delete-tag-confirmation', require('./components/DeleteTagConfirmation.vue').default);
Vue.component('delete-post-button', require('./components/DeletePostButton.vue').default);
Vue.component('delete-post-admin-confirmation', require('./components/DeletePostAdminConfirmation.vue').default);
Vue.component('go-to-page-button', require('./components/GoToPagePaginationButton.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});