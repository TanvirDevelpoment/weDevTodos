<template>
    <div class="item">
        <input type="checkbox" @change="updateCheck()" v-model="item.completed">
        <span :class="[item.completed ? 'completed' : '', 'itemText']" v-show="itemShow" @click="shwoingInput()">{{item.name}}</span>
        <input type="text" class="editInput" v-show="!itemShow" v-model="item.name" @dblclick="removeInput()"  @keyup="updateItemName()">
        <button @click="removeItem()" class="trashcan"><font-awesome-icon icon="times" /></button>
    </div>
</template>
<script>
export default {
    props:['item'],
    data: function(){
        return{
            actvItems: [],
            inActvItems:"",
            itemShow: true,
            
        }
    },
    methods:{
        shwoingInput(){
            this.itemShow = false;
        },
        removeInput(){
            this.itemShow = true;
        },
        updateItemName(){
            axios.put('api/updateItemName/'+this.item.id,{
                item: this.item
            })
            .then(response => {
                if(response.status == 200){
                }
            })
            .catch(error =>{
                console.log(error);
            })
        },
        updateCheck(){
            axios.put('api/item/'+this.item.id,{
                item: this.item
            })
            .then(response => {
                if(response.status == 200){
                    this.$emit('itemchanged');
                    axios.get('api/completedItems')
                    .then(cresponse => {
                        this.inActvItems = cresponse.data;
                        
                    })
                    .catch(error => {
                        console.log(error);
                    })
                    this.activeItems();
                }
            })
            .catch(error =>{
                console.log(error);
            })
        },
        removeItem(){
            axios.delete('api/item/'+this.item.id)
            .then(response => {
                if(response.status == 200){
                    this.$emit('itemchanged');
                    this.activeItems();
                }
            })
            .catch(error =>{
                console.log(error);
            })
        },
        
        activeItems(){
            axios.get('api/inCompletedItems')
            .then(response => {
                this.actvItems = response.data;
                this.$emit('finalActiveItems', response.data.length,this.inActvItems.length);
            })
            .catch(error => {
                console.log(error);
            })
        },
        inActivItems(){
            axios.get('api/completedItems')
            .then(cresponse => {
                this.inActvItems = cresponse.data;
                
            })
            .catch(error => {
                console.log(error);
            })
        }
        
    },
    created(){
        this.activeItems();
        this.inActivItems();
    }
}
</script>
<style scoped>
.completed{
    text-decoration: line-through;
    color:#999999;
}
.itemText{
    width:100%;
    margin-left: 20px;
}
.item{
    display: flex;
    justify-content: center;
    align-items: center;
}
.item:hover .trashcan {
  opacity: 1;
  z-index: 1;
}
.trashcan{
    background: #e6e6e6;
    border:none;
    color:#FF0000;
    outline: none;
    transition: opacity .35s ease;
    z-index: -1;
}
.editInput{
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}
</style>