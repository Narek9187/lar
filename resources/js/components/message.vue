<template>
    <div class="clearfix">
        <li class="list-group-item" :class="className">
            <slot></slot>
            <span class="float-right mt-4" style="font-size: 0.5vw">{{time}}</span>
        </li>
        <small class="badge float-right" :class="badgeClass">{{ user }}</small>
    </div>
</template>
 
<script>
    export default {
        props:[
            "color",
            "user",
            "time"
        ],
        computed:{
            className(){
                return "list-group-item-"+this.color
            },
            badgeClass(){
                return "badge-"+this.color
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>