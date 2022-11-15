<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import JetButton from '@/Jetstream/Button.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import JetDangerButton from '@/Jetstream/DangerButton.vue';
import { useForm } from '@inertiajs/inertia-vue3'

const form = useForm();

const props = defineProps({
    courses: Object,
});

function create() {
    form.get(route('courses.create'));
}

function edit(id) {
    form.get(route('courses.edit', id));
}

function destroy(id) {
    if (confirm("Are you sure you want to delete the record?")) {
        form.delete(route('courses.destroy', id));
    }
}

function schedules(id) {
    form.get(route('course.schedules.index', id));
}
</script>

<template>
    <AppLayout title="Courses">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Courses
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-3">
                            <JetButton @click="create()">
                                Add Record
                            </JetButton>
                        </div>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-900 uppercase bg-gray-5">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Start date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            End date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="course in courses.data"
                                        :key="course.id"
                                        class="bg-white border-b"
                                    >
                                        <th class="px-6 py-4 font-medium">
                                            {{ course.id }}
                                        </th>
                                        <th class="px-6 py-4 font-medium">
                                            {{ course.name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ course.start_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ course.end_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <JetButton class="m-1" @click="schedules(course.id)">
                                                Schedules
                                            </JetButton>
                                            <JetSecondaryButton class="m-1" @click="edit(course.id)">
                                                Edit
                                            </JetSecondaryButton>
                                            <JetDangerButton class="m-1" @click="destroy(course.id)">
                                                Delete
                                            </JetDangerButton>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <Pagination :data="courses"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
