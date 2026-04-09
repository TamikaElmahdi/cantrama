<template>
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Sidebar -->
        <aside class="w-56 bg-gray-900 text-gray-300 flex flex-col fixed top-0 left-0 h-full z-40">
            <div class="px-5 py-5 border-b border-gray-800">
                <Link :href="route('admin.dashboard')" class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-white text-sm">ContratMA Admin</span>
                </Link>
            </div>

            <nav class="flex-1 px-3 py-4 space-y-1">
                <Link
                    v-for="item in navItems"
                    :key="item.route"
                    :href="route(item.route)"
                    :class="isActive(item.route)
                        ? 'bg-blue-600 text-white'
                        : 'text-gray-400 hover:bg-gray-800 hover:text-white'"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition"
                >
                    <span class="text-base">{{ item.icon }}</span>
                    {{ item.label }}
                </Link>
            </nav>

            <div class="px-4 py-4 border-t border-gray-800">
                <Link :href="route('home')" class="text-xs text-gray-500 hover:text-gray-300 transition flex items-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Retour au site
                </Link>
            </div>
        </aside>

        <!-- Main -->
        <div class="flex-1 ml-56">
            <!-- Top bar -->
            <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between sticky top-0 z-30">
                <h1 class="font-bold text-gray-900 text-lg">{{ title }}</h1>
                <div class="flex items-center gap-3 text-sm text-gray-500">
                    <span>{{ $page.props.auth.user?.name }}</span>
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                        {{ $page.props.auth.user?.name?.charAt(0)?.toUpperCase() }}
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="p-8">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({ title: String });

const page = usePage();

const navItems = [
    { route: 'admin.dashboard', label: 'Tableau de bord', icon: '📊' },
    { route: 'admin.templates', label: 'Modèles', icon: '📄' },
    { route: 'admin.contracts', label: 'Contrats', icon: '📋' },
    { route: 'admin.users', label: 'Utilisateurs', icon: '👥' },
];

function isActive(routeName) {
    return page.url.startsWith('/admin') && route().current(routeName);
}
</script>
