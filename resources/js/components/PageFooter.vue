<template>
    <tr class="table-warning">
        <td colspan="8" class="text-right">
            <button type="button" class="btn btn-danger mr-4" @click="deleteSelected()">Delete Selected</button>
            <button class="btn btn-danger" @click="deleteAll()">Delete All</button>
        </td>
    </tr>
</template>

<script>
export default {
    name: "PageFooter",
    methods: {
        deleteSelected() {
            this.$emit('delete-selected');
        },
        deleteAll() {
            this.$emit('delete-all');
        },
    }
}
</script>

<style scoped>
td {
    padding: 10px 30px 5px;
}
</style>
