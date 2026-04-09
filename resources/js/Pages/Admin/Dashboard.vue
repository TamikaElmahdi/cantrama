<template>
    <Head title="Admin — Tableau de bord" />
    <AdminLayout title="Tableau de bord">

        <!-- Stats grid -->
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
            <div v-for="card in statCards" :key="card.label"
                 class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-start justify-between mb-3">
                    <div class="text-2xl">{{ card.icon }}</div>
                    <span v-if="card.trend" class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">
                        {{ card.trend }}
                    </span>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-1">{{ card.value }}</div>
                <div class="text-sm text-gray-500">{{ card.label }}</div>
            </div>
        </div>

        <!-- Recent contracts -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-bold text-gray-900">Derniers contrats</h2>
                <Link :href="route('admin.contracts')" class="text-sm text-blue-600 hover:underline">Voir tout →</Link>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Utilisateur</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Modèle</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Statut</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="c in recent_contracts" :key="c.id"
                        class="border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">
                        <td class="px-6 py-3 text-sm text-gray-800">{{ c.user_name }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ c.template_name }}</td>
                        <td class="px-6 py-3">
                            <span :class="statusClass(c.payment_status)"
                                  class="text-xs font-semibold px-2.5 py-1 rounded-full">
                                {{ statusLabel(c.payment_status) }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-xs text-gray-400">{{ formatDate(c.created_at) }}</td>
                    </tr>
                    <tr v-if="recent_contracts.length === 0">
                        <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-400">Aucun contrat encore.</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </AdminLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import AdminLayout from './Layout.vue';

const props = defineProps({
    stats: Object,
    recent_contracts: Array,
});

const statCards = computed(() => [
    { icon: '👥', label: 'Utilisateurs inscrits', value: props.stats.users, trend: null },
    { icon: '📄', label: 'Modèles actifs', value: props.stats.templates, trend: null },
    { icon: '📋', label: 'Contrats générés', value: props.stats.contracts, trend: '+12%' },
    { icon: '💰', label: 'Contrats payés', value: props.stats.paid_contracts, trend: null },
    { icon: '💵', label: 'Revenus estimés (MAD)', value: props.stats.revenue_mad + ' MAD', trend: null },
    { icon: '⭐', label: 'Abonnés Pro', value: props.stats.pro_users, trend: null },
]);

function statusLabel(s) {
    return { free: 'Gratuit', paid: 'Payé', subscription: 'Abonnement' }[s] ?? s;
}
function statusClass(s) {
    return {
        free: 'bg-gray-100 text-gray-600',
        paid: 'bg-green-100 text-green-700',
        subscription: 'bg-blue-100 text-blue-700',
    }[s] ?? 'bg-gray-100 text-gray-500';
}
function formatDate(iso) {
    return new Date(iso).toLocaleDateString('fr-MA', { day: '2-digit', month: 'short', year: 'numeric' });
}
</script>
