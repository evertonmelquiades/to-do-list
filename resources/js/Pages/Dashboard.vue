<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, onMounted } from "vue";
import axios from "axios";

const newTodo = ref("");
const todos = ref([]);

const fetchTodos = async () => {
    const response = await axios.get("/tasks");
    todos.value = response.data.map((task, index) => ({
        ...task,
        number: index + 1,
    }));
};

const addTodo = async () => {
    if (newTodo.value.trim() !== "") {
        const response = await axios.post("/tasks", {
            name: newTodo.value,
            completed: false,
        });
        const newTask = { ...response.data, number: todos.value.length + 1 };
        todos.value.push(newTask);
        newTodo.value = "";
    }
};

const removeTodo = async (id) => {
    await axios.delete(`/tasks/${id}`);
    todos.value = todos.value.filter((todo) => todo.id !== id);
    todos.value.forEach((task, index) => (task.number = index + 1));
};

const updateCompleted = async (id, completed) => {
    await axios.put(`/tasks/${id}`, {
        completed: completed,
    });
};

const sortByNumber = () => {
    todos.value.sort((a, b) => a.number - b.number);
};

const sortByName = () => {
    todos.value.sort((a, b) => a.name.localeCompare(b.name));
};

const sortByCompleted = () => {
    todos.value.sort((a, b) => a.completed - b.completed);
};

onMounted(() => {
    fetchTodos();
});
</script>

<style scoped>
.line-through {
    text-decoration: line-through;
}
</style>

<template>
    <div>
        <AuthenticatedLayout>
            <div
                class="min-h-screen bg-gray-100 flex items-center justify-center p-4"
            >
                <div
                    class="bg-white p-8 rounded shadow-md w-full md:w-2/3 lg:w-1/2 xl:w-1/3"
                >
                    <h1 class="text-2xl font-semibold mb-4">To-Do List</h1>

                    <form @submit.prevent="addTodo" class="mb-4">
                        <div class="flex space-x-2">
                            <input
                                v-model="newTodo"
                                type="text"
                                class="flex-1 border rounded py-2 px-4"
                                placeholder="Add a new task..."
                            />
                            <button
                                type="submit"
                                class="bg-indigo-500 text-white px-4 py-2 rounded"
                            >
                                Add
                            </button>
                        </div>
                    </form>
                    <div class="flex mt-4 mb-3">
                        <button
                            @click="sortByNumber"
                            class="btn btn-primary btn-sm m-2"
                        >
                            Number
                        </button>
                        <button
                            @click="sortByName"
                            class="btn btn-primary btn-sm m-2"
                        >
                            Name
                        </button>
                        <button
                            @click="sortByCompleted"
                            class="btn btn-primary btn-sm m-2"
                        >
                            Completed
                        </button>
                    </div>
                    <ul>
                        <li
                            v-for="todo in todos"
                            :key="todo.id"
                            class="flex items-center justify-between border-b py-2"
                        >
                            <span :class="{ 'line-through': todo.completed }">{{
                                todo.id
                            }}</span>
                            <span :class="{ 'line-through': todo.completed }">{{
                                todo.name
                            }}</span>
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    v-model="todo.completed"
                                    class="form-check-input"
                                    style="margin-right: 8px"
                                    @change="
                                        updateCompleted(todo.id, todo.completed)
                                    "
                                    :checked="todo.completed"
                                />
                                <button
                                    @click="removeTodo(todo.id)"
                                    class="btn btn-danger btn-sm"
                                >
                                    Delete
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>
