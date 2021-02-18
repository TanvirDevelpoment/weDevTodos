<template>
    <div>
        <div v-for="(item,index) in items" :key="index">
            <list-item :item="item" v-on:itemchanged="$emit('reloadlist')" class="item"/>
        </div>
        <div class="items" v-if="items.length > 0">
            {{ items.length }} <span v-if="items.length === 1"> Item Left</span> <span v-else-if="items.length > 1"> Items Left</span>
        </div>
    </div>
</template>
<script>
import listItem from './listItem.vue'

export default {
  components: { listItem },
    props:['items'],   
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