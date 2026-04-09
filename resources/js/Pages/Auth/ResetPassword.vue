<template>
    <Head title="Nouveau mot de passe — ContratMA" />

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/40 to-white flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">

            <Link :href="route('home')" class="flex items-center gap-2 mb-10">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="font-bold text-lg text-gray-900">Contrat<span class="text-blue-600">MA</span></span>
            </Link>

            <h1 class="text-2xl font-bold text-gray-900 mb-2">Nouveau mot de passe</h1>
            <p class="text-gray-500 text-sm mb-8">Choisissez un nouveau mot de passe sécurisé pour votre compte.</p>

            <form @submit.prevent="submit" class="space-y-5">
                <input type="hidden" v-model="form.token" />

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Adresse email</label>
                    <input
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50"
                        :class="form.errors.email ? 'border-red-400' : ''"
                    />
                    <p v-if="form.errors.email" class="text-xs text-red-500 mt-1.5">{{ form.errors.email }}</p>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Nouveau mot de passe</label>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                        placeholder="Minimum 8 caractères"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        :class="form.errors.password ? 'border-red-400 bg-red-50' : ''"
                    />
                    <p v-if="form.errors.password" class="text-xs text-red-500 mt-1.5">{{ form.errors.password }}</p>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Confirmer le mot de passe</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        :class="form.errors.password_confirmation ? 'border-red-400 bg-red-50' : ''"
                    />
                    <p v-if="form.errors.password_confirmation" class="text-xs text-red-500 mt-1.5">{{ form.errors.password_confirmation }}</p>
                </div>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold text-sm hover:bg-blue-700 transition disabled:opacity-60"
                >
                    {{ form.processing ? 'Réinitialisation...' : 'Réinitialiser le mot de passe' }}
                </button>
            </form>

        </div>
    </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ email: String, token: String });

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => form.post(route('password.store'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
});
</script>
