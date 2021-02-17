<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Todo List</h2>
            <add-item-form/>
            <button type="button" @click="shwoItems()"><font-awesome-icon icon="trash" /></button>
        </div>
        <list-view :items="items"/>
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
        shwoItems(){
            axios.get('api/items')
            .then(response => {
                
                this.items == response.data;
                console.log(this.items);
            })
            .catch(error => {
                console.log(error);
            })
        },
        created(){
            console.log(this.items);
        }
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