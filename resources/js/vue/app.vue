<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Todos</h2>
            <p class="note">[Single Click for Edit and Double Click for Remove Input]</p>
            <add-item-form v-on:reloadlist="shwoItems(2)"/>
        </div>
        <list-view :items="items" v-on:reloadlist="shwoItems(2)" @completed="completed"/>
    </div>
</template>
<script>
import addItemForm from './addItemForm.vue'
import ListView from './listView.vue'
export default {
    components: { addItemForm, ListView },
    data: function(){
        return{
            items: []
        }
    },
    methods:{
        completed(val){
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
            }else if(flag == 2){
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
        this.shwoItems(2);
    }
}
</script>
<style scoped>
    .todoListContainer {
        width: 405px;
        margin: auto;
    }
    .heading{
        background: #e6e6e6;
        padding: 10px;
    }
    #title{
        text-align: center;
    }
    .note{
        color: red;
    }
</style>