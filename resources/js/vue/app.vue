<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Todo List</h2>
            <add-item-form v-on:reloadlist="shwoItems()"/>
        </div>
        <list-view :items="items" v-on:reloadlist="shwoItems()" @completed="completed"/>
    </div>
</template>
<script>
import addItemForm from './addItemForm.vue'
import ListView from './listView.vue'
export default {
    components: { addItemForm, ListView },
    data: function(){
        return{
            items: [],
            cmpVal:""
        }
    },
    methods:{
        completed(val){
            // this.cmpVal = val;
            this.shwoItems(val);
        },
        shwoItems(flag){
            if(flag == 1){
                axios.get('api/completedItems')
                .then(response => {
                    
                    this.items = response.data;
                    console.log(this.items);
                })
                .catch(error => {
                    console.log(error);
                })
            }else if(flag == 0){
                axios.get('api/inCompletedItems')
                .then(response => {
                    
                    this.items = response.data;
                    console.log(this.items);
                })
                .catch(error => {
                    console.log(error);
                })
            }else{
                 axios.get('api/items')
                .then(response => {
                    
                    this.items = response.data;
                    console.log(this.items);
                })
                .catch(error => {
                    console.log(error);
                })
            }
            
        },
        
    },
    created(){
        // this.cmpVal = '';
        this.shwoItems(2);
    }
}
</script>
<style scoped>
    .todoListContainer {
        width: 350px;
        margin: auto;
    }
    .heading{
        background: #e6e6e6;
        padding: 10px;
    }
    #title{
        text-align: center;
    }
</style>