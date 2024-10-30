<template>
    <Head title="Dashboard"></Head>
    <div
        class="shadow-xs mt-6 flex flex-col justify-between rounded-md border border-skin-neutral-4 bg-skin-neutral-2 px-4 py-2 md:flex-row"
    >
        <div>
            <i class="ri-megaphone-line"></i>
            Welcome
            <span class="font-bold">{{ $page.props.auth.user.name }}</span> !
        </div>
    </div>

    <div class="my-6 grid grid-cols-1 gap-6 md:grid-cols-3">
        <!-- User Count Card -->
        <div
            class="shadow-xs flex items-center rounded-lg border border-skin-neutral-4 bg-skin-neutral-2 p-4 hover:cursor-pointer hover:bg-skin-neutral-1"
            @click="$inertia.visit(route('user.index'))"
            v-if="can('Acl')"
        >
            <div
                class="mr-4 rounded-full bg-green-100 px-3 py-2 text-green-500 dark:bg-green-500 dark:text-green-100"
            >
                <i class="ri-user-fill text-2xl"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium">Users</p>
                <p class="text-lg font-semibold">
                    {{ props.count['users'] }}
                </p>
            </div>
        </div>

        <!-- Role Count Card -->
        <div
            class="shadow-xs flex items-center rounded-lg border border-skin-neutral-4 bg-skin-neutral-2 p-4 hover:cursor-pointer hover:bg-skin-neutral-1"
            @click="$inertia.visit(route('aclRole.index'))"
            v-if="can('Acl')"
        >
            <div
                class="mr-4 rounded-full bg-blue-100 px-3 py-2 text-blue-500 dark:bg-blue-500 dark:text-blue-100"
            >
                <i class="ri-user-settings-line text-2xl"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium">Roles</p>
                <p class="text-lg font-semibold">
                    {{ props.count['roles'] }}
                </p>
            </div>
        </div>

        <!-- Permission Count Card -->
        <div
            class="shadow-xs flex items-center rounded-lg border border-skin-neutral-4 bg-skin-neutral-2 p-4 hover:cursor-pointer hover:bg-skin-neutral-1"
            @click="$inertia.visit(route('aclPermission.index'))"
            v-if="can('Acl')"
        >
            <div
                class="mr-4 rounded-full bg-orange-100 px-3 py-2 text-orange-500 dark:bg-orange-500 dark:text-orange-100"
            >
                <i class="ri-key-fill text-2xl"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium">Permissions</p>
                <p class="text-lg font-semibold">
                    {{ props.count['permissions'] }}
                </p>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import useAuthCan from '@/Composables/useAuthCan'

const { can } = useAuthCan()

const props = defineProps({
    count: {
        type: Object
    }
})
</script>
