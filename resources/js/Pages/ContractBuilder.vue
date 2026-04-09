<template>
    <Head :title="template.name_fr + ' — ContratMA'" />

    <div class="min-h-screen bg-gray-50">
        <!-- Nav -->
        <nav class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
            <Link :href="route('home')" class="font-bold text-xl text-gray-900">
                ContratMA<span class="text-blue-600">.ma</span>
            </Link>
            <div class="flex items-center gap-4 text-sm">
                <template v-if="$page.props.auth.user">
                    <Link :href="route('contracts.history')" class="text-gray-600 hover:text-gray-900">Mes contrats</Link>
                </template>
                <template v-else>
                    <Link :href="route('login')" class="text-gray-600 hover:text-gray-900">Connexion</Link>
                    <Link :href="route('register')" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">S'inscrire</Link>
                </template>
            </div>
        </nav>

        <div class="max-w-6xl mx-auto px-6 py-8">
            <!-- Title -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">{{ template.name_fr }}</h1>
                <p class="text-gray-500 text-sm mt-1" dir="rtl">{{ template.name_ar }}</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left: Form -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h2 class="font-semibold text-gray-800 mb-5">Remplissez le formulaire</h2>

                    <form @submit.prevent class="space-y-4">
                        <template v-for="field in template.fields" :key="field.name">
                            <div>
                                <label :for="field.name" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ field.label_fr }}
                                    <span v-if="field.required" class="text-red-500 ml-0.5">*</span>
                                    <span class="text-gray-400 font-normal ml-2 text-xs" dir="rtl">{{ field.label_ar }}</span>
                                </label>

                                <!-- Textarea -->
                                <textarea
                                    v-if="field.type === 'textarea'"
                                    :id="field.name"
                                    v-model="formData[field.name]"
                                    :placeholder="field.label_fr"
                                    dir="auto"
                                    rows="3"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                ></textarea>

                                <!-- Select -->
                                <select
                                    v-else-if="field.type === 'select'"
                                    :id="field.name"
                                    v-model="formData[field.name]"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                >
                                    <option value="">Choisir...</option>
                                    <option v-for="opt in field.options" :key="opt" :value="opt">{{ opt }}</option>
                                </select>

                                <!-- Date -->
                                <input
                                    v-else-if="field.type === 'date'"
                                    :id="field.name"
                                    type="date"
                                    v-model="formData[field.name]"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                />

                                <!-- Number -->
                                <input
                                    v-else-if="field.type === 'number'"
                                    :id="field.name"
                                    type="number"
                                    v-model="formData[field.name]"
                                    :placeholder="field.label_fr"
                                    min="0"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                />

                                <!-- Text (default) -->
                                <input
                                    v-else
                                    :id="field.name"
                                    type="text"
                                    v-model="formData[field.name]"
                                    :placeholder="field.label_fr"
                                    dir="auto"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                />
                            </div>
                        </template>
                    </form>

                    <!-- Action buttons -->
                    <div class="mt-6 space-y-3">
                        <button
                            @click="previewPdf"
                            :disabled="previewLoading"
                            class="w-full bg-gray-100 text-gray-800 py-2.5 rounded-lg font-medium hover:bg-gray-200 transition text-sm disabled:opacity-50"
                        >
                            {{ previewLoading ? 'Génération...' : '👁 Aperçu PDF' }}
                        </button>

                        <button
                            @click="downloadPdf"
                            :disabled="downloadLoading"
                            class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-medium hover:bg-blue-700 transition text-sm disabled:opacity-50"
                        >
                            {{ downloadLoading ? 'En cours...' : '⬇ Télécharger (9 MAD)' }}
                        </button>
                    </div>

                    <!-- Error / Info message -->
                    <div v-if="message" :class="messageClass" class="mt-4 text-sm p-3 rounded-lg">
                        {{ message }}
                    </div>
                </div>

                <!-- Right: Live Preview Card -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 sticky top-6 self-start">
                    <h2 class="font-semibold text-gray-800 mb-5">Aperçu des données</h2>

                    <div class="space-y-3">
                        <template v-for="field in template.fields" :key="field.name">
                            <div v-if="formData[field.name]" class="flex gap-3">
                                <span class="text-xs text-gray-400 w-36 flex-shrink-0 pt-0.5">{{ field.label_fr }}</span>
                                <span class="text-sm text-gray-800 font-medium break-words" dir="auto">{{ formData[field.name] }}</span>
                            </div>
                        </template>

                        <p v-if="!hasAnyData" class="text-sm text-gray-400 italic">
                            Remplissez le formulaire pour voir l'aperçu ici...
                        </p>
                    </div>

                    <div class="mt-6 border-t border-gray-100 pt-4 text-xs text-gray-400">
                        <p>📋 Template : {{ template.name_fr }}</p>
                        <p class="mt-1" dir="rtl">{{ template.name_ar }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, reactive, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    template: Object,
});

// Initialize form data from fields
const formData = reactive({});
props.template.fields.forEach((field) => {
    formData[field.name] = '';
});

const previewLoading = ref(false);
const downloadLoading = ref(false);
const message = ref('');
const messageType = ref('info');

const messageClass = computed(() => ({
    'bg-red-50 text-red-700': messageType.value === 'error',
    'bg-green-50 text-green-700': messageType.value === 'success',
    'bg-blue-50 text-blue-700': messageType.value === 'info',
}));

const hasAnyData = computed(() => Object.values(formData).some((v) => v !== ''));

async function previewPdf() {
    previewLoading.value = true;
    message.value = '';
    try {
        const response = await axios.post('/api/contracts/preview', {
            template_id: props.template.id,
            data: { ...formData },
        });
        const base64 = response.data.pdf;
        const blob = base64ToBlob(base64, 'application/pdf');
        const url = URL.createObjectURL(blob);
        window.open(url, '_blank');
    } catch (err) {
        messageType.value = 'error';
        message.value = err.response?.data?.message || 'Erreur lors de la génération de l\'aperçu.';
    } finally {
        previewLoading.value = false;
    }
}

async function downloadPdf() {
    downloadLoading.value = true;
    message.value = '';
    try {
        const response = await axios.post(
            '/api/contracts/download',
            {
                template_id: props.template.id,
                data: { ...formData },
            },
            { responseType: 'blob' }
        );
        const url = URL.createObjectURL(new Blob([response.data], { type: 'application/pdf' }));
        const a = document.createElement('a');
        a.href = url;
        a.download = props.template.name_fr.toLowerCase().replace(/\s+/g, '-') + '.pdf';
        a.click();
        URL.revokeObjectURL(url);
        messageType.value = 'success';
        message.value = 'PDF téléchargé avec succès !';
    } catch (err) {
        const status = err.response?.status;
        if (status === 401) {
            messageType.value = 'info';
            message.value = 'Veuillez vous connecter pour télécharger le contrat.';
            setTimeout(() => (window.location.href = '/register'), 1500);
        } else if (status === 402) {
            messageType.value = 'info';
            message.value = 'Crédits insuffisants. Redirection vers le paiement...';
            setTimeout(() => initiatePayment(), 1500);
        } else {
            messageType.value = 'error';
            message.value = err.response?.data?.message || 'Erreur lors du téléchargement.';
        }
    } finally {
        downloadLoading.value = false;
    }
}

async function initiatePayment() {
    try {
        const response = await axios.post('/api/payment/initiate', {
            template_id: props.template.id,
            data: { ...formData },
            plan: 'single',
        });
        window.location.href = response.data.mock_payment_url;
    } catch (err) {
        messageType.value = 'error';
        message.value = 'Erreur lors de l\'initiation du paiement.';
    }
}

function base64ToBlob(base64, type) {
    const binary = atob(base64);
    const bytes = new Uint8Array(binary.length);
    for (let i = 0; i < binary.length; i++) {
        bytes[i] = binary.charCodeAt(i);
    }
    return new Blob([bytes], { type });
}
</script>
