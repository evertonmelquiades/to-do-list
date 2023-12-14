<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, onMounted } from "vue";
import axios from "axios";

const { users } = defineProps(["users"]);

const fetchUsers = async () => {
    try {
        const response = await axios.get("/users");
        users.value = response.data;
    } catch (error) {
        console.error("Error fetching users:", error);
    }
};

onMounted(() => {
    fetchUsers();
});
</script>

<template>
    <div>
        <AuthenticatedLayout>
            <div
                class="min-h-screen bg-gray-100 flex items-center justify-center p-4"
            >
                <div
                    class="bg-white p-8 rounded shadow-md w-full md:w-2/3 lg:w-1/2 xl:w-1/3"
                    >
                    <a
                    href="/register"
                    style="float: right;"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-9"
                    >Register</a>
                    <h1 class="text-2xl font-semibold mb-4">Users</h1>

                    <div class="overflow-x-auto">
                        <table class="table table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Perfil</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.role }}</td>
                                    <td>

                                        <div class="flex items-center">
                                            <a
                                                :href="`/profile/${user.id}`"
                                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-9"
                                                >Edit </a
                                            >
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>
