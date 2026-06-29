<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

    <Head title="Criar Conta — TopRecomendações" />

    <component :is="'script'" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" async>
    </component>

    <div
        class="min-h-screen bg-slate-950 flex flex-col justify-center items-center px-4 relative overflow-hidden font-sans">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-amber-500/10 blur-[120px] rounded-full pointer-events-none">
        </div>
        <div
            class="absolute -bottom-40 -right-40 w-96 h-96 bg-orange-600/10 blur-[120px] rounded-full pointer-events-none">
        </div>

        <div
            class="w-full max-w-md bg-slate-900/50 border border-slate-800/80 backdrop-blur-xl p-8 rounded-2xl shadow-2xl relative z-10">

            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 bg-amber-500/10 text-amber-500 rounded-xl mb-4 border border-amber-500/20">
                    <i class="fa-solid fa-user-plus text-xl"></i>
                </div>
                <h2 class="text-2xl font-extrabold text-white tracking-tight">Criar uma nova conta</h2>
                <p class="text-slate-400 text-sm mt-1">Junta-te a nós e partilha os teus tops favoritos</p>
            </div>

            <form @submit.prevent="submit" class="space-y-5">
                <div>
                    <label for="name"
                        class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nome
                        Completo</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                            <i class="fa-solid fa-user text-sm"></i>
                        </span>
                        <input id="name" type="text" v-model="form.name" required autofocus autocomplete="name"
                            placeholder="Ex: Samuel Silva"
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 pl-10 pr-4 py-3 rounded-xl focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition text-sm placeholder:text-slate-600" />
                    </div>
                    <InputError class="mt-1 text-xs text-rose-500" :message="form.errors.name" />
                </div>

                <div>
                    <label for="email"
                        class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Endereço de
                        Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </span>
                        <input id="email" type="email" v-model="form.email" required autocomplete="username"
                            placeholder="seuemail@exemplo.com"
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 pl-10 pr-4 py-3 rounded-xl focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition text-sm placeholder:text-slate-600" />
                    </div>
                    <InputError class="mt-1 text-xs text-rose-500" :message="form.errors.email" />
                </div>

                <div>
                    <label for="password"
                        class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Palavra-passe</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                        <input id="password" type="password" v-model="form.password" required
                            autocomplete="new-password" placeholder="••••••••"
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 pl-10 pr-4 py-3 rounded-xl focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition text-sm placeholder:text-slate-600" />
                    </div>
                    <InputError class="mt-1 text-xs text-rose-500" :message="form.errors.password" />
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Confirmar
                        Palavra-passe</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                            <i class="fa-solid fa-shield-check text-sm"></i>
                        </span>
                        <input id="password_confirmation" type="password" v-model="form.password_confirmation" required
                            autocomplete="new-password" placeholder="••••••••"
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 pl-10 pr-4 py-3 rounded-xl focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition text-sm placeholder:text-slate-600" />
                    </div>
                    <InputError class="mt-1 text-xs text-rose-500" :message="form.errors.password_confirmation" />
                </div>

                <div class="pt-2">
                    <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        class="w-full bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-slate-950 font-bold py-3 px-4 rounded-xl shadow-lg shadow-orange-500/10 transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-slate-950 text-sm">
                        <span v-if="form.processing"><i class="fa-solid fa-circle-notch animate-spin mr-2"></i>A
                            processar...</span>
                        <span v-else>Criar Minha Conta</span>
                    </button>
                </div>

                <div class="text-center pt-4 border-t border-slate-800/60 mt-4">
                    <p class="text-xs text-slate-400">
                        Já tens uma conta ativa?
                        <Link :href="route('login')"
                            class="text-amber-500 hover:text-amber-400 font-semibold transition ml-1 underline underline-offset-4">
                            Faz login aqui
                        </Link>
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>