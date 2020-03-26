/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import Vue from 'vue';
 
// import axios from 'axios';
import VueChatScroll from 'vue-chat-scroll';
Vue.use(VueChatScroll);

import Toaster from 'v-toaster';
import 'v-toaster/dist/v-toaster.css';
Vue.use(Toaster, {timeout: 5000});

Vue.component('message', require('./components/message.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
    	message: "",
    	typing: "",
    	onCount: 0,
    	chat:{
    		message:[],
    		user:[],
    		color:[],
    		time:[]
    	}
    },
    watch:{
    	message(){
    		Echo.private('testChannel')
			    .whisper('typing', {
			        name: this.message
			    });
    	}
    },
    methods:{
    	getTime(){
    		let time = new Date()
    		return time.getHours()+":"+time.getMinutes()
    	},
    	oldMessages(){
    		axios.post("/oldMessages")
				.then(response => {
					if (response.data != "") {
						this.chat = response.data
					}
				})
				.catch(error => {
					console.log(error)
				});
    	},
    	delSession(){
            axios.post('/delSession')
            	.then(response => {
            		this.chat = ""
            		this.$toaster.success('Chat history removed')
            	})
            	.catch(error => console.log(error))
        },
    	send(){
    		if(this.message.length) {
    			this.chat.message.push(this.message);
    			this.chat.color.push("success");
    			this.chat.user.push("you");
    			this.chat.time.push(this.getTime());

    			axios.post("/event", {
					message: this.message,
					chat: this.chat
				})
				.then(response => {
					// console.log(response);
					this.message = "";
				})
				.catch(error => {
					console.log(error);
				});
			}
    	}
    },
    mounted(){
    	this.oldMessages();
    	Echo.private('testChannel')
		    .listen('TaskEvent', (e) => {
		        this.chat.message.push(e.message)
		        this.chat.user.push(e.user)
		        this.chat.color.push("warning")
    			this.chat.time.push(this.getTime())
    			axios.post('/saveToSession',{
                    chat : this.chat
                })
					.then(response => {
					})
					.catch(error => {
						console.log(error);
					});
    			
		    })
		    .listenForWhisper('typing', (e) => {
		        if (!e.name.length) {
		        	this.typing = ""
		        }else{this.typing = "typing..."}
		    });
		Echo.join(`testChannel`)
		    .here((users) => {
		        // console.log(users)
		        this.onCount = users.length-1
		    })
		    .joining((user) => {
		        // console.log(user);
		        this.onCount += 1
		        this.$toaster.success(user.login + ' is online')
		    })
		    .leaving((user) => {
		        // console.log(user.name);
		        this.onCount -= 1
		        this.$toaster.warning(user.login + ' leaved messenger')
		    });
	}
});
