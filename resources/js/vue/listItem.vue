<template>
    <div class="item">
        <input type="checkbox" @change="updateCheck()" v-model="item.completed">
        <span :class="[item.completed ? 'completed' : '', 'itemText']">{{item.name}}</span>
        <button @click="removeItem()" class="trashcan"><font-awesome-icon icon="times" /></button>
    </div>
</template>
<script>
export default {
    props:['item'],
    data: function(){
        return{
            actvItems: [],
            inActvItems:""
        }
    },
    methods:{
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
            // this.$emit('updateCheck', this.item.id,1);
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
                // this.$emit('itemchanged');
                
                this.actvItems = response.data;
                this.$emit('finalActiveItems', response.data.length,this.inActvItems.length);
            })
            .catch(error => {
                console.log(error);
            })
        }
        
    },
    created(){
        this.activeItems();
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
.trashcan{
    background: #e6e6e6;
    border:none;
    color:#FF0000;
    outline: none;
}
</style>