<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Entrar — TopRecomendações" />

    <!-- FontAwesome injetado para os ícones premium -->
    <component :is="'script'" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" async>
    </component>

    <div
        class="min-h-screen bg-slate-950 flex flex-col justify-center items-center px-4 relative overflow-hidden font-sans">
        <!-- Luz decorativa de fundo (Invertida em relação ao registo para dar dinâmica) -->
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-amber-500/10 blur-[120px] rounded-full pointer-events-none">
        </div>
        <div
            class="absolute -bottom-40 -left-40 w-96 h-96 bg-orange-600/10 blur-[120px] rounded-full pointer-events-none">
        </div>

        <!-- Card de Login -->
        <div
            class="w-full max-w-md bg-slate-900/50 border border-slate-800/80 backdrop-blur-xl p-8 rounded-2xl shadow-2xl relative z-10">

            <!-- Header do Card -->
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 bg-amber-500/10 text-amber-500 rounded-xl mb-4 border border-amber-500/20">
                    <i class="fa-solid fa-key text-xl"></i>
                </div>
                <h2 class="text-2xl font-extrabold text-white tracking-tight">Bem-vindo de volta</h2>
                <p class="text-slate-400 text-sm mt-1">Introduz as tuas credenciais para aceder aos teus tops</p>
            </div>

            <!-- Status de Sessão (Se houver algum alerta do Laravel) -->
            <div v-if="status"
                class="mb-4 text-sm font-medium text-emerald-500 bg-emerald-500/10 border border-emerald-500/20 p-3 rounded-xl text-center">
                {{ status }}
            </div>

            <!-- Formulário -->
            <form @submit.prevent="submit" class="space-y-5">
                <!-- Email -->
                <div>
                    <label for="email"
                        class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Endereço de
                        Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </span>
                        <input id="email" type="email" v-model="form.email" required autofocus autocomplete="username"
                            placeholder="seuemail@exemplo.com"
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 pl-10 pr-4 py-3 rounded-xl focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition text-sm placeholder:text-slate-600" />
                    </div>
                    <InputError class="mt-1 text-xs text-rose-500" :message="form.errors.email" />
                </div>

                <!-- Palavra-passe -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password"
                            class="block text-xs font-semibold text-slate-400 uppercase tracking-wider">Palavra-passe</label>
                        <Link v-if="canResetPassword" :href="route('password.request')"
                            class="text-xs text-slate-500 hover:text-amber-500 transition">
                            Esqueste-te?
                        </Link>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                        <input id="password" type="password" v-model="form.password" required
                            autocomplete="current-password" placeholder="••••••••"
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 pl-10 pr-4 py-3 rounded-xl focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition text-sm placeholder:text-slate-600" />
                    </div>
                    <InputError class="mt-1 text-xs text-rose-500" :message="form.errors.password" />
                </div>

                <!-- Lembrar-me -->
                <div class="flex items-center">
                    <label class="flex items-center cursor-pointer select-none">
                        <Checkbox name="remember" v-model:checked="form.remember"
                            class="rounded border-slate-800 bg-slate-950 text-amber-500 focus:ring-amber-500/30 focus:ring-offset-slate-950" />
                        <span class="ms-2 text-xs text-slate-400 font-medium">Lembrar-me neste dispositivo</span>
                    </label>
                </div>

                <!-- Botão de Entrar -->
                <div class="pt-2">
                    <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        class="w-full bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-slate-950 font-bold py-3 px-4 rounded-xl shadow-lg shadow-orange-500/10 transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-slate-950 text-sm">
                        <span v-if="form.processing"><i class="fa-solid fa-circle-notch animate-spin mr-2"></i>A
                            autenticar...</span>
                        <span v-else>Entrar na Minha Conta</span>
                    </button>
                </div>

                <!-- Footer do Card (Link de Registo) -->
                <div class="text-center pt-4 border-t border-slate-800/60 mt-4">
                    <p class="text-xs text-slate-400">
                        Ainda não tens conta?
                        <Link :href="route('register')"
                            class="text-amber-500 hover:text-amber-400 font-semibold transition ml-1 underline underline-offset-4">
                            Cria uma aqui
                        </Link>
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>