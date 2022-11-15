<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import JetButton from '@/Jetstream/Button.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import JetDangerButton from '@/Jetstream/DangerButton.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3'

const form = useForm();

const props = defineProps({
    course: Object,
    schedules: Object,
});

function create() {
    form.get(route('course.schedules.create', props.course.id));
}

function edit(id) {
    form.get(route('course.schedules.edit', [props.course.id, id]));
}

function destroy(id) {
    if (confirm("Are you sure you want to delete the record?")) {
        form.delete(route('course.schedules.destroy', [props.course.id, id]));
    }
}
</script>

<template>
    <AppLayout title="Schedules">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('courses.index')">Courses</Link>
                <span class="text-indigo-400 font-medium"> / </span>
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('courses.edit', props.course.id)">{{ props.course.id }}</Link>
                <span class="text-indigo-400 font-medium"> / </span>Schedules
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
                                            Days
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Range of hours
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="schedule in schedules"
                                        :key="schedule.id"
                                        class="bg-white border-b"
                                    >
                                        <th class="px-6 py-4 font-medium">
                                            {{ schedule.id }}
                                        </th>
                                        <th class="px-6 py-4 font-medium">
                                            {{ schedule.days }}
                                        </th>
                                        <th class="px-6 py-4 font-medium">
                                            {{ schedule.range_of_hours }}
                                        </th>
                                        <td class="px-6 py-4">

                                            <JetSecondaryButton class="m-1" @click="edit(schedule.id)">
                                                Edit
                                            </JetSecondaryButton>
                                            <JetDangerButton class="m-1" @click="destroy(schedule.id)">
                                                Delete
                                            </JetDangerButton>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
