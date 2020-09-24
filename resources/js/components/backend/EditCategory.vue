<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add Category</h5>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="createCategory">
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        :class="{
                                            'is-invalid': categoryForm.errors.has(
                                                'name'
                                            )
                                        }"
                                        v-model="categoryForm.name"
                                        name="name"
                                        placeholder="Category Name"
                                    />
                                    <has-error
                                        :form="categoryForm"
                                        field="name"
                                    ></has-error>
                                </div>
                                <div class="form-group">
                                    <button
                                        type="submit"
                                        class="btn btn-success"
                                    >
                                        Save Category
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Form } from "vform";
export default {
    data() {
        return {
            categoryForm: new Form({
                name: ""
            }),
            categoryName: "",
            categories: []
        };
    },
    methods: {
        createCategory() {
            //axios.post("/api/category", { name: this.categoryName }).then(response => {console.log(response);});

            this.categoryForm.post("/api/category").then(({ data }) => {
                this.categoryForm.name = "";
            });
        },
        loadCategory() {
            let id = this.$route.params.id;
            axios
                .get("/api/category/${id}/edit")
                .then(response => {
                    this.categoryForm.name = response.data.id;
                })
                .catch(error => {
                    console.log(error.response);
                });
        }
    },
    mounted() {
        this.loadCategory();
    }
};
</script>

<style></style>
