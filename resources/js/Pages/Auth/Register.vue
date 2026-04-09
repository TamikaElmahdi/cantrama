<template>
    <Head title="Inscription — ContratMA" />

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/40 to-white flex">

        <!-- Left panel -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-700 flex-col justify-between p-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>

            <Link :href="route('home')" class="flex items-center gap-2 relative z-10">
                <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="font-bold text-xl text-white">ContratMA</span>
            </Link>

            <div class="relative z-10 space-y-5">
                <h2 class="text-3xl font-bold text-white leading-tight">
                    Rejoignez 500+<br>professionnels marocains
                </h2>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 text-sm">✓</div>
                        <span class="text-sm">1 contrat offert dès l'inscription</span>
                    </div>
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 text-sm">✓</div>
                        <span class="text-sm">12+ modèles de contrats marocains</span>
                    </div>
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 text-sm">✓</div>
                        <span class="text-sm">PDF bilingue Français / Arabe</span>
                    </div>
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 text-sm">✓</div>
                        <span class="text-sm">Conforme au droit marocain (D.O.C.)</span>
                    </div>
                </div>
            </div>

            <div class="text-blue-200 text-xs relative z-10">© 2024 ContratMA.ma</div>
        </div>

        <!-- Right panel: form -->
        <div class="flex-1 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">

                <!-- Mobile logo -->
                <Link :href="route('home')" class="flex items-center gap-2 mb-8 lg:hidden">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-lg text-gray-900">Contrat<span class="text-blue-600">MA</span></span>
                </Link>

                <h1 class="text-2xl font-bold text-gray-900 mb-1">Créer votre compte 🚀</h1>
                <p class="text-gray-500 text-sm mb-8">Gratuit · 1 contrat offert · Pas de CB requise</p>

                <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nom complet</label>
                        <input
                            id="name"
                            type="text"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Mohammed Alami"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            :class="form.errors.name ? 'border-red-400 bg-red-50' : ''"
                        />
                        <p v-if="form.errors.name" class="text-xs text-red-500 mt-1.5">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Adresse email</label>
                        <input
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            autocomplete="username"
                            placeholder="vous@exemple.ma"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            :class="form.errors.email ? 'border-red-400 bg-red-50' : ''"
                        />
                        <p v-if="form.errors.email" class="text-xs text-red-500 mt-1.5">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Mot de passe</label>
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
                        class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold text-sm hover:bg-blue-700 transition shadow-md shadow-blue-100 disabled:opacity-60"
                    >
                        {{ form.processing ? 'Création...' : 'Créer mon compte gratuitement' }}
                    </button>

                    <p class="text-center text-xs text-gray-400">
                        En vous inscrivant, vous acceptez nos conditions d'utilisation.
                    </p>
                </form>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Déjà inscrit ?
                    <Link :href="route('login')" class="text-blue-600 font-semibold hover:underline">Se connecter</Link>
                </p>

            </div>
        </div>

    </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({ name: '', email: '', password: '', password_confirmation: '' });
const submit = () => form.post(route('register'), { onFinish: () => form.reset('password', 'password_confirmation') });
</script>
