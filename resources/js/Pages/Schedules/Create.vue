<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Head, Link } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import FlashMessage from '@/Components/FlashMessage.vue';

const props = defineProps({
    course: Object,
    schedule_hours: Array,
});

const form = useForm({
    start_time: '00:00:00',
    end_time: '00:00:00',
    monday: 0,
    tuesday: 0,
    wednesday: 0,
    thursday: 0,
    friday: 0,
    saturday: 0,
    sunday: 0,
});

const submit = () => {
    form.post(route('course.schedules.store', props.course.id), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AppLayout title="Create Schedule">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('courses.index')">Courses</Link>
                <span class="text-indigo-400 font-medium"> / </span>
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('courses.edit', props.course.id)">{{ props.course.id }}</Link>
                <span class="text-indigo-400 font-medium"> / </span>
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('course.schedules.index', props.course.id)">Schedules</Link>
                <span class="text-indigo-400 font-medium"> / </span>Create
            </h2>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

                    <FlashMessage class="mb-4" />

                    <JetValidationErrors class="mb-4" />

                    <form @submit.prevent="submit">
                        <div>
                            <JetLabel value="Schedule" />
                            <div class="input-group checkbox-btn">
                                <input type="checkbox" name="monday" ref="monday" v-model="form.monday"/>
                                <label class="btn btn-light m-1" v-on:click="form.monday = !form.monday">Monday</label>

                                <input type="checkbox" name="tuesday" ref="tuesday" v-model="form.tuesday"/>
                                <label class="btn btn-light m-1" v-on:click="form.tuesday = !form.tuesday">Tuesday</label>

                                <input type="checkbox" name="wednesday" ref="wednesday" v-model="form.wednesday"/>
                                <label class="btn btn-light m-1" v-on:click="form.wednesday = !form.wednesday">Wednesday</label>

                                <input type="checkbox" name="thursday" ref="thursday" v-model="form.thursday"/>
                                <label class="btn btn-light m-1" v-on:click="form.thursday = !form.thursday">Thursday</label>

                                <input type="checkbox" name="friday" ref="friday" v-model="form.friday"/>
                                <label class="btn btn-light m-1" v-on:click="form.friday = !form.friday">Friday</label>

                                <input type="checkbox" name="saturday" ref="saturday" v-model="form.saturday"/>
                                <label class="btn btn-light m-1" v-on:click="form.saturday = !form.saturday">Saturday</label>

                                <input type="checkbox" name="sunday" ref="sunday" v-model="form.sunday"/>
                                <label class="btn btn-light m-1" v-on:click="form.sunday = !form.sunday">Sunday</label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <JetLabel for="lastname" value="Start time" />
                            <div class="w-full">
                                <select class="form-select appearance-none last:block last:w-full last:px-3 last:py-1.5 last:text-base last:font-normal last:text-gray-700 last:bg-white bg-clip-padding bg-no-repeat last:border border-solid border-gray-300 last:rounded last:transition last:ease-in-out last:m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                aria-label="Default select example"
                                v-model="form.start_time"
                                >
                                    <option selected>Select a hour</option>
                                    <option v-for="(item, key) in schedule_hours" :key="key" :value="item.value">{{ item.text }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <JetLabel for="lastname" value="End time" />
                            <div class="w-full">
                                <select class="form-select appearance-none last:block last:w-full last:px-3 last:py-1.5 last:text-base last:font-normal last:text-gray-700 last:bg-white bg-clip-padding bg-no-repeat last:border border-solid border-gray-300 last:rounded last:transition last:ease-in-out last:m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                aria-label="Default select example"
                                v-model="form.end_time"
                                >
                                    <option selected>Select a hour</option>
                                    <option v-for="(item, key) in schedule_hours" :key="key" :value="item.value">{{ item.text }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save
                            </JetButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
