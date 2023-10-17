<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    post: {
        type: Object,
        default: () => ({}),
    },
    CModalEdit: {
        type: Function,
    },
    idPost: {
        type: Number
    }
});

const form = useForm({
    id_post: props.idPost,
    title: props.post.title,
    content: props.post.content,
});


const submit = () => {
    form.put(route("posts.update", props.idPost));
    
};
</script>

<template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="title" value="title" />

                                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required
                                    autofocus autocomplete="username" />

                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>
                            <div class="my-6">
                                <label for="slug"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Content</label>
                                <textarea type="text" v-model="form.content" name="content" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>

                                <div v-if="form.errors.content" class="text-sm text-red-600">
                                    {{ form.errors.content }}
                                </div>
                            </div>
                            <PrimaryButton type="submit" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Submit
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>