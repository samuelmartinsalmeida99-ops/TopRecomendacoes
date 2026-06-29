<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// Estado para controlar o tipo selecionado: 'none', 'restaurant' ou 'hotel'
const selectionType = ref('none');

// Formulário para Restaurante
const restaurantForm = useForm({
    name: '',
    cuisine_type: '',
    rating: 5.0,
    review: '',
});

// Formulário para Hotel
const hotelForm = useForm({
    name: '',
    location: '',
    rating: 5.0,
    review: '',
});

// Submeter Restaurante
const submitRestaurant = () => {
    restaurantForm.post(route('restaurants.store'), {
        onSuccess: () => restaurantForm.reset(),
    });
};

// Submeter Hotel
const submitHotel = () => {
    hotelForm.post(route('hotels.store'), {
        onSuccess: () => hotelForm.reset(),
    });
};
</script>

<template>

    <Head title="Nova Avaliação — TopRecomendações" />
    <component :is="'script'" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" async>
    </component>

    <div class="min-h-screen bg-slate-950 text-slate-100 font-sans antialiased relative overflow-hidden py-12 px-4">
        <!-- Luz de fundo -->
        <div
            class="absolute -top-40 left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-amber-500/10 blur-[120px] rounded-full pointer-events-none">
        </div>

        <div class="max-w-xl mx-auto relative z-10">

            <!-- Voltar para a Dashboard -->
            <Link :href="route('dashboard')"
                class="inline-flex items-center gap-2 text-xs text-slate-500 hover:text-amber-500 transition mb-6 font-semibold uppercase tracking-wider">
                <i class="fa-solid fa-arrow-left"></i> Voltar ao Painel
            </Link>

            <!-- TÍTULO -->
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-black text-white tracking-tight">Nova Avaliação</h1>
                <p class="text-slate-400 text-sm mt-1">Partilha a tua experiência no teu top pessoal.</p>
            </div>

            <!-- SELEÇÃO DO TIPO -->
            <div v-if="selectionType === 'none'" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Opção Restaurante -->
                <button @click="selectionType = 'restaurant'"
                    class="bg-slate-900/40 border border-slate-800 p-6 rounded-2xl text-center hover:border-amber-500/50 hover:bg-slate-900/80 transition duration-300 group">
                    <div
                        class="w-12 h-12 bg-amber-500/10 text-amber-500 rounded-xl flex items-center justify-center mx-auto mb-4 border border-amber-500/10 group-hover:scale-110 transition">
                        <i class="fa-solid fa-utensils text-xl"></i>
                    </div>
                    <h3 class="text-base font-bold text-white mb-1">Restaurante / Café</h3>
                    <p class="text-slate-500 text-xs">Avaliar ementa, espaço ou atendimento.</p>
                </button>

                <!-- Opção Hotel -->
                <button @click="selectionType = 'hotel'"
                    class="bg-slate-900/40 border border-slate-800 p-6 rounded-2xl text-center hover:border-blue-500/50 hover:bg-slate-900/80 transition duration-300 group">
                    <div
                        class="w-12 h-12 bg-blue-500/10 text-blue-400 rounded-xl flex items-center justify-center mx-auto mb-4 border border-blue-500/10 group-hover:scale-110 transition">
                        <i class="fa-solid fa-hotel text-xl"></i>
                    </div>
                    <h3 class="text-base font-bold text-white mb-1">Hotel / Estadia</h3>
                    <p class="text-slate-500 text-xs">Avaliar alojamento, quarto ou localização.</p>
                </button>
            </div>

            <!-- CARD DO FORMULÁRIO SELECIONADO -->
            <div v-else class="bg-slate-900/50 border border-slate-800/80 backdrop-blur-xl p-8 rounded-2xl shadow-2xl">

                <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-800/60">
                    <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-2"
                        :class="selectionType === 'restaurant' ? 'text-amber-500' : 'text-blue-400'">
                        <i :class="selectionType === 'restaurant' ? 'fa-solid fa-utensils' : 'fa-solid fa-hotel'"></i>
                        Formulário de {{ selectionType === 'restaurant' ? 'Restaurante' : 'Hotel' }}
                    </span>
                    <button @click="selectionType = 'none'"
                        class="text-xs text-slate-500 hover:text-slate-300 transition underline">
                        Alterar tipo
                    </button>
                </div>

                <!-- FORMULÁRIO: RESTAURANTE -->
                <form v-if="selectionType === 'restaurant'" @submit.prevent="submitRestaurant" class="space-y-5">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nome do
                            Restaurante</label>
                        <input type="text" v-model="restaurantForm.name" required placeholder="Ex: Tasca do Ó"
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition text-sm" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tipo de
                            Cozinha</label>
                        <input type="text" v-model="restaurantForm.cuisine_type" required
                            placeholder="Ex: Italiana, Tradicional"
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition text-sm" />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Pontuação
                            (0 a 5)</label>
                        <input type="number" step="0.1" min="0" max="5" v-model="restaurantForm.rating" required
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition text-sm" />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Comentário
                            / Crítica</label>
                        <textarea rows="3" v-model="restaurantForm.review" placeholder="O que achaste do espaço?"
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:border-amber-500 focus:ring-1 focus:ring-amber-500/30 transition text-sm resize-none"></textarea>
                    </div>
                    <button type="submit" :disabled="restaurantForm.processing"
                        class="w-full bg-gradient-to-r from-amber-500 to-orange-600 text-slate-950 font-bold py-3 px-4 rounded-xl shadow-lg transition text-sm">
                        Submeter Avaliação de Restaurante
                    </button>
                </form>

                <!-- FORMULÁRIO: HOTEL -->
                <form v-if="selectionType === 'hotel'" @submit.prevent="submitHotel" class="space-y-5">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nome do
                            Hotel</label>
                        <input type="text" v-model="hotelForm.name" required placeholder="Ex: Hotel Melia"
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500/30 transition text-sm" />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Localização
                            / Cidade</label>
                        <input type="text" v-model="hotelForm.location" required placeholder="Ex: Braga, Porto"
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500/30 transition text-sm" />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Pontuação
                            (0 a 5)</label>
                        <input type="number" step="0.1" min="0" max="5" v-model="hotelForm.rating" required
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500/30 transition text-sm" />
                    </div>
                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Comentário
                            / Crítica</label>
                        <textarea rows="3" v-model="hotelForm.review" placeholder="Detalhes sobre a tua estadia..."
                            class="w-full bg-slate-950/60 border border-slate-800 text-slate-100 px-4 py-3 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500/30 transition text-sm resize-none"></textarea>
                    </div>
                    <button type="submit" :disabled="hotelForm.processing"
                        class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition text-sm">
                        Submeter Avaliação de Hotel
                    </button>
                </form>

            </div>

        </div>
    </div>
</template>