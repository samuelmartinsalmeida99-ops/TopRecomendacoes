<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    item: Object,
    type: String
});

// Inicializar o formulário com os dados existentes obtidos do Laravel
const form = useForm({
    name: props.item.name,
    cuisine_type: props.item.cuisine_type || '',
    location: props.item.location || '',
    rating: props.item.rating,
    review: props.item.review || '',
});

const submit = () => {
    // Dispara um pedido PUT para a rota correspondente (restaurants.update ou hotels.update)
    form.put(route(`${props.type}s.update`, props.item.id));
};
</script>

<template>

    <Head :title="'Editar ' + form.name + ' — TopRecomendações'" />
    <component :is="'script'" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" async>
    </component>

    <div class="min-h-screen bg-slate-950 text-slate-100 font-sans antialiased relative overflow-hidden py-12 px-4">
        <div
            class="absolute -top-40 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-blue-500/10 blur-[120px] rounded-full pointer-events-none">
        </div>

        <div class="max-w-xl mx-auto relative z-10">

            <Link :href="route('dashboard')"
                class="inline-flex items-center gap-2 text-xs text-slate-500 hover:text-amber-500 transition mb-6 font-semibold uppercase tracking-wider">
                <i class="fa-solid fa-arrow-left"></i> Cancelar e Voltar
            </Link>

            <div class="mb-8 text-center">
                <h1 class="text-3xl font-black text-white tracking-tight">Editar Avaliação</h1>
                <p class="text-slate-400 text-sm mt-1">Atualiza os detalhes do teu spot selecionado.</p>
            </div>

            <div class="bg-slate-900/50 border border-slate-800/80 backdrop-blur-xl p-8 rounded-2xl shadow-2xl">

                <div class="mb-6 pb-4 border-b border-slate-800/60">
                    <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-2"
                        :class="type === 'restaurant' ? 'text-amber-500' : 'text-blue-400'">
                        <i :class="type === 'restaurant' ? 'fa-solid fa-utensils' : 'fa-solid fa-hotel'"></i>
                        A Editar {{ type === 'restaurant' ? 'Restaurante' : 'Hotel' }}
                    </span>
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nome</label>
                        <input type="text" v-model="form.name" required
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:ring-1 transition text-sm"
                            :class="type === 'restaurant' ? 'focus:border-amber-500 focus:ring-amber-500/30' : 'focus:border-blue-500 focus:ring-blue-500/30'" />
                    </div>

                    <div v-if="type === 'restaurant'">
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tipo de
                            Cozinha</label>
                        <input type="text" v-model="form.cuisine_type" required
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition text-sm" />
                    </div>

                    <div v-if="type === 'hotel'">
                        <label
                            class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Localização
                            / Cidade</label>
                        <input type="text" v-model="form.location" required
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500/30 transition text-sm" />
                    </div>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Pontuação
                            (0 a 5)</label>
                        <input type="number" step="0.1" min="0" max="5" v-model="form.rating" required
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:ring-1 transition text-sm"
                            :class="type === 'restaurant' ? 'focus:border-amber-500 focus:ring-amber-500/30' : 'focus:border-blue-500 focus:ring-blue-500/30'" />
                    </div>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Comentário
                            / Crítica</label>
                        <textarea rows="3" v-model="form.review"
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:ring-1 transition text-sm resize-none"
                            :class="type === 'restaurant' ? 'focus:border-amber-500 focus:ring-amber-500/30' : 'focus:border-blue-500 focus:ring-blue-500/30'"></textarea>
                    </div>

                    <button type="submit" :disabled="form.processing"
                        class="w-full font-bold py-3 px-4 rounded-xl shadow-lg transition text-sm text-slate-950"
                        :class="type === 'restaurant' ? 'bg-gradient-to-r from-amber-500 to-orange-600' : 'bg-gradient-to-r from-blue-500 to-indigo-600 !text-white'">
                        Salvar Alterações
                    </button>
                </form>

            </div>
        </div>
    </div>
</template>