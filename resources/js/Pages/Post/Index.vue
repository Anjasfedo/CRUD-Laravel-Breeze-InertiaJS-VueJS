<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

import CreateModal from './Create.vue';

import EditModal from './Edit.vue';

import DeleteModal from './Delete.vue'

import Modal from '@/Components/Modal.vue';

import { ref, onMounted } from 'vue';

const props = defineProps({
    posts: {
        type: Object,
        default: () => ({}),
    },
});
const form = useForm({});

// function destroy(id_post) {
//     if (confirm("Are you sure you want to Delete")) {
//         form.delete(route("posts.destroy", id_post));
//     }
// }

const modalCreate = ref(false);

const cModalCreate = () => {
    modalCreate.value = false
}

// 

const modalDelete = ref(false)

const deleteModal = (idPost) => {
    postId.value = idPost;
    modalDelete.value = true;
}

const cModalDelete = () => {
    modalDelete.value = false
}

// 

const modalEdit = ref(false)

const openEditModal = (idPost) => {
    postId.value = idPost;
    modalEdit.value = true
}

const cModalEdit = () => {
    modalEdit.value = false
}

const postId = ref({});


// // Inisialisasi DataTable setelah tampilan Inertia selesai dimuat
// const initDataTable = () => {
//     $('#example').DataTable();
// };

// // Panggil initDataTable ketika komponen telah dimuat sepenuhnya
// onMounted(() => {
//     initDataTable();
// });

</script>

<template>
    <Head title="Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                posts Index
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-2">
                            <PrimaryButton @click="modalCreate = true">Add post</PrimaryButton>
                            <Modal :show="modalCreate" @close="modalCreate = true">
                                <CreateModal :modalCreate="modalCreate" :cModalCreate="cModalCreate"/>
                            </Modal>
                        </div>
                        <div class="relative shadow-md sm:rounded-lg">
                            <div class="overflow-hidden">
                                <table id="example" style="width:100%" class="ui celled table w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="">#</th>
                                        <th scope="col" class="">
                                            Title
                                        </th>
                                        <th scope="col" class="">
                                            Content
                                        </th>
                                        <th scope="col" class="">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="post, index in posts" :key="post.id_post"
                                        class="bg-white border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ index + 1 }}
                                        </th>
                                        <th scope="row"
                                            class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ post.title }}
                                        </th>

                                        <th scope="row"
                                            class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ post.content }}
                                        </th>
                                        <td class="px-3 py-4">
                                            <PrimaryButton class="px-4 py-2 text-white bg-blue-600 rounded-lg" @click="openEditModal(post)">Edit</PrimaryButton>
                                            <PrimaryButton class="bg-red-700 ml-4" @click="deleteModal(post)">
                                                Delete
                                            </PrimaryButton>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Modal :show="modalEdit" @close="modalEdit = true">
            <EditModal :modalEdit="modalEdit" :idPost="postId" :cModalEdit="cModalEdit" />
          </Modal>

          <Modal :show="modalDelete" @close="modalDelete = true" :maxWidth="'sm'" :position="'relative top-48'">
            <DeleteModal :modalDelete="modalDelete" :idPost="postId" :cModalDelete="cModalDelete" />
          </Modal>
    </AuthenticatedLayout>
</template>