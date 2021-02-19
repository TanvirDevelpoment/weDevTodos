<template>
    <div>
        <div v-for="(item,index) in items" :key="index">
            <list-item :item="item" v-on:itemchanged="$emit('reloadlist',0)" @finalActiveItems="finalActiveItems" class="item"/>
            <!-- <list-item :item="item" v-on:itemchanged="$emit('reloadlist')" class="item" @updateCheck="updateCheck"/> -->
        </div>
        <div class="items" v-if="actveItems > 0 || items.length > 0 || inActiveItems > 0">
            <span v-if="actveItems === 1"> {{ actveItems }} Item Left</span> <span v-else-if="actveItems > 1"> {{ actveItems }} Items Left</span>
            <button type="button" @click="allItems()">All</button>
            <button type="button" @click="completed()">Completed</button>
            <button type="button" @click="actives()">Active</button>
            <button type="button" @click="clearCmpltd()" v-if="inActiveItems > 0">Clear Completed</button>
        </div>
    </div>
</template>
<script>
import listItem from './listItem.vue'

export default {
  components: { listItem },
    props:['items'],
    data: function(){
        return{
            actveItems: "",
            inActiveItems: ""
        }
    },
    methods:{
        completed(){
            this.$emit('completed',1);
        },
        actives(){
            this.$emit('completed',0);
        },
        allItems(){
            this.$emit('completed',2);
        },
        finalActiveItems(activeLength,inActiveLength){
            this.actveItems = activeLength;
            this.inActiveItems = inActiveLength;
        },
        clearCmpltd(){
            axios.get('api/deleteCompletedItems')
            .then(response => {
                if(response.status == 200){
                    this.$emit('reloadlist');
                }
            })
            .catch(error =>{
                console.log(error);
            })
        }
        // inActvItems(){
        //     axios.get('api/completedItems')
        //     .then(response => {
        //         this.inActiveItems = response.data;
        //     })
        //     .catch(error => {
        //         console.log(error);
        //     })
        // }
    }
    
}
</script>
<style scoped>
.item{
    background: #e6e6e6;
    padding: 5px;
    margin-top: 3px;
}
.items{
    background: #e6e6e6;
    padding: 8px;
    margin-top: 5px;
}


</style>