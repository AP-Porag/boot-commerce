<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Category List</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover no-border">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="text-center"
                                        v-for="category in categories"
                                        :key="category.id"
                                    >
                                        <th scope="row">{{ category.id }}</th>
                                        <td>{{ category.name }}</td>
                                        <td>{{ category.slug }}</td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'edit-category',
                                                    params: {
                                                        id: category.id
                                                    }
                                                }"
                                                class="btn btn-warning btn-sm"
                                            >
                                                edit
                                            </router-link>
                                            <a
                                                @click.prevent="
                                                    deleteCategory(category.id)
                                                "
                                                class="btn btn-danger btn-sm"
                                                href="#"
                                            >
                                                delete
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="pagination">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a
                                                class="page-link"
                                                href="#"
                                                aria-label="Previous"
                                            >
                                                <span aria-hidden="true"
                                                    >&laquo;</span
                                                >
                                                <span class="sr-only"
                                                    >Previous</span
                                                >
                                            </a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a
                                                class="page-link"
                                                href="#"
                                                aria-label="Next"
                                            >
                                                <span aria-hidden="true"
                                                    >&raquo;</span
                                                >
                                                <span class="sr-only"
                                                    >Next</span
                                                >
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
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
        loadCategories() {
            axios.get("/api/category").then(response => {
                this.categories = response.data;
            });
        },
        deleteCategory(id) {
            axios.delete("/api/category/${id}").then(response => {
                console.log("Success");
            });
        }
    },
    mounted() {
        this.loadCategories();
    }
};
</script>

<style></style>
